<?php
// imports
require_once("../utils/auth.php");
require_once("../utils/database.php");
require_once("../utils/filter.php");
require_once("../utils/movies.php");
require_once("../utils/functions.php");
?>

<?php
checkSessionLoggedIn();

checkAuthorization($_SESSION['rol'], array("Admin", "Director"));

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

?>
<?php
require("../src/database/constants.php");

$userId = $_SESSION["id"];
$uploadDir = __DIR__ . DS . "uploads" . DS . "user_" . $userId;
$frontEndPath = "/and-action/public/uploads/user_" . $userId;

// check if all text values are set
if (isset($_POST['upload'])) {
  if (!empty($_POST['MovieTitle'])) {
    $title = $_POST['MovieTitle'];
  } else {
    $titlemess = "Please add a title";
  }
  if (!empty($_POST['genres'])) {
    $genre = $_POST['genres'];
  } else {
    $genremess = "Please select genres.";
  }
  if (!empty($_POST['AgeRating'])) {
    $ageRating = $_POST['AgeRating'];
  } else {
    $ageRatemess = "Please select an age rating.";
  }
  if (!empty($_POST['filmguides'])) {
    $filmGuide = $_POST['filmguides'];
  } else {
    $filmGuidemess = "Please select film guides.";
  }
  // check if the movie contains any errors, if not continue.
  /*
  * First compare the mime type and if it 
  *
  */
  if (!($_FILES['Movie']['error'] > 0)) {
    $allowedext = VIDEOEXTENSIONS;
    $moviename = $_FILES['Movie']['name'];
    $ext = "." . pathinfo($moviename, PATHINFO_EXTENSION);
    $videoMimeType = filterFileMimeType($_FILES["Movie"]["tmp_name"], VIDEOMIMETYPES);
    if (!in_array($ext, $allowedext) or !$videoMimeType) {
      $filetypemoviemess = "filetype not allowed, must be .mp4";
      $movie = FALSE;
    } 
    // else if (getVideoLength($_FILES["Movie"]["tmp_name"]) < 60 * 20) {
    //   $filetypemoviemess = "Your movie has to be atleast 20 minutes in order to be uploaded!"; // to be tested on server
    //   $movie = FALSE;
    // } 
    else {
      if (strlen($_FILES['Movie']['name']) < 70) {
        $tmpFileName = $_FILES['Movie']['tmp_name'];
        $path = $frontEndPath . "/premium/" . $moviename;
        $movie = true;
      }
    }
  } else {
    $moviemess = "Please add a movie file.";
    $movie = FALSE;
  }

  if (!($_FILES['Thumbnail']['error'] > 0)) {
    $allowedext = IMAGEEXTENSIONS;
    $thumbnailname = $_FILES['Thumbnail']['name'];
    $ext = "." . pathinfo($thumbnailname, PATHINFO_EXTENSION);
    $imageMimeType = filterFileMimeType($_FILES["Thumbnail"]["tmp_name"], IMAGEMIMETYPES);
    if (!in_array($ext, $allowedext) or !$imageMimeType) {
      $filetypethumbmess = "filetype not allowed, must be .png, ,jpeg or .jpg";
      $thumbnail = FALSE;
    } else {
      if (strlen($_FILES['Thumbnail']['name']) < 70) {
        $tmpFileName2 = $_FILES['Thumbnail']['tmp_name'];
        $thumbnailPath = $frontEndPath . "/thumbnail/" . $thumbnailname;
        $thumbnail = true;
      }
    }
  } else {
    $thumbnailmess = "Please add a thumbnail.";
    $thumbnail = FALSE;
  }
  if (!empty($_POST['Description'])) {
    $description = $_POST['Description'];
  } else {
    $descriptionmess = "Please add a description.";
  }
  if (isset($title) and isset($genre) and isset($ageRating) and isset($filmGuide) and $movie and $thumbnail and isset($description)) {
    if (!file_exists($uploadDir . "/premium") && !file_exists($uploadDir . "/standard") && !file_exists($uploadDir . "/thumbnail")) {
      mkdir($uploadDir . "/premium", 0777, true);
      mkdir($uploadDir . "/standard", 0777, true);
      mkdir($uploadDir . "/thumbnail", 0777, true);
      moveUploadedFile($uploadDir . "/premium", $tmpFileName, $moviename);
      //thumbnail
      moveUploadedFile($uploadDir . "/thumbnail", $tmpFileName2, $thumbnailname);
    } else {
      moveUploadedFile($uploadDir, $tmpFileName, $moviename);
      //thumbnail
      moveUploadedFile($uploadDir, $tmpFileName2, $thumbnailname);
    }
    uploadMovie($userId, $title, $path, $thumbnailPath, $description, $ageRating, $filmGuide, $genre);
    changeVideoQuality($path, "200x200", str_replace("premium", "standard", $path));
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php"; ?>
  <link rel="stylesheet" href="./assets/css/multiselect.css">
  <link rel="stylesheet" href="./assets/css/styleupload.css">
  <script src="assets/js/multiselect.min.js">
  document.multiselect('#genre-select').setIsEnabled(true);;
  document.multiselect('#filmguide-select').setIsEnabled(true);;
  </script>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container container-movie-upload">
    <div>
      <p class="uploadtitle">Upload movie</p>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <div class="spaceupload">
          <label for="MovieTitle" class="spacetextupload">Movie title</label>
          <input type="text" id="MovieTitle" name="MovieTitle" placeholder="Type here your movie title">
        </div>
        <div class="upload-error-message">
          <?php
          if (isset($titlemess)) {
            echo "<span class=\"upload-error-message\"> " . $titlemess . "</span>";
          }
          ?>
        </div>
        <div class="flexbox-upload-container">
          <div class="spaceupload">
            <p class="spacetextupload">Category</p>
            <div class="multi-selector">
              <div>
                <?php
                $genres = getTableRecords("SELECT id, naam FROM genre");
                echo "<select id=\"genre-select\" name=\"genres[]\" multiple placeholder=\"category\">";
                foreach ($genres as $genre) {
                  echo "<option value=" . $genre['id'] . ">" . $genre["naam"] . "</option>";
                }
                echo "</select>";
                ?>
                <script>
                document.multiselect('#genre-select').setCheckBoxClick(true);
                </script>
              </div>
              <?php
              if (isset($genremess)) {
                echo "<p class=\"upload-error-message\">" . $genremess . "</p>";
              }
              ?>
            </div>
          </div>
          <div class="spaceupload">
            <p class="spacetextupload">Film guide</p>
            <div class="multi-selector">

              <?php
              $filmGuides = getTableRecords("SELECT id, naam FROM kijkwijzer_geschiktheid");
              echo "<select id=\"filmguide-select\" name=\"filmguides[]\" multiple>";
              foreach ($filmGuides as $filmguide) {
                echo "<option value=" . $filmguide['id'] . ">" . $filmguide["naam"] . "</option>";
              }
              echo "</select>";
              ?>
              <script>
              document.multiselect('#filmguide-select').setCheckBoxClick(true);
              </script>
            </div>
            <?php
            if (isset($filmGuidemess)) {
              echo "<p class=\"upload-error-message\">" . $filmGuidemess . "</p>";
            }
            ?>
          </div>
        </div>
        <div class="spaceupload">
          <label for="AgeRating" class="spacetextupload">Age rating</label>
          <select name="AgeRating" id="AgeRating" class="styleselect">
            <option disabled selected hidden> age rating </option>
            <option value="0">ALL</option>
            <option value="6">6</option>
            <option value="9">9</option>
            <option value="12">12</option>
            <option value="14">14</option>
            <option value="16">16</option>
            <option value="18">18</option>
          </select>
        </div>
        <div class="flexbox-upload-container">
          <div class="spaceupload">
            <p class="spacetextupload">Movie</p>
            <div class="file-upload">
              <label for="Movie">Select movie</label>
              <input type="file" id="Movie" name="Movie" class="file">
            </div>
            <?php
            if (isset($moviemess)) {
              echo "<p class=\"upload-error-message\">" . $moviemess . "</p>";
            }

            if (isset($filetypemoviemess)) {
              echo "<p class=\"upload-error-message\">" . $filetypemoviemess . "</p>";
            }
            ?>
          </div>
          <div class="spaceupload">
            <p class="spacetextupload">Thumbnail</p>
            <div class="file-upload">
              <label for="Thumbnail">Thumbnail</label>
              <input type="file" id="Thumbnail" name="Thumbnail" class="file">
            </div>
            <?php
            if (isset($thumbnailmess)) {
              echo "<p class=\"upload-error-message\">" . $thumbnailmess . "</p>";
            }
            if (isset($filetypethumbmess)) {
              echo "<p class=\"upload-error-message\">" . $filetypethumbmess . "</p>";
            }
            ?>
          </div>
        </div>
        <div class="spaceupload">
          <label for="Description" class="spacetextupload">Description</label>
          <textarea id="Description" name="Description" rows="5" cols="70"
            placeholder="Type here your description of the movie"></textarea>
        </div>
        <?php
        if (isset($descriptionmess)) {
          echo "<p class=\"upload-error-message\">" . $descriptionmess . "</p>";
        }
        ?>
        <div class="upload-error-message">
          <div class="spaceupload">
            <input type="submit" name='upload' value="upload" class="supload">
          </div>
      </form>
    </div>
  </div>
  <div class="right-side">
    <div class="director-image">
      <img src="assets/img/logo.png">
    </div>
  </div>
  </div>
  <?php include('../templates/footer.php') ?>
</body>

</html>