<?php
// include('../utils/authentication.php');

// checkLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <link rel="stylesheet" href="./assets/css/styleupload.css">
    <?php include "../templates/head.php";
          require("../utils/movies.php");
          require("../utils/filter.php");
          DEFINE('DS', DIRECTORY_SEPARATOR); 
          
          $userId = 2;

          if(isset($_POST['upload'])){
            if(!empty($_POST['MovieTitle']) AND !empty($_POST['Category']) AND !empty($_POST['AgeRating']) AND !empty($_POST['filmGuide'])  AND  !($_FILES['Movie']['error'] > 0) AND !($_FILES['Thumbnail']['error'] > 0) AND !empty($_POST['Description'])){  
              $title = $_POST['MovieTitle'];
              $genre = $_POST['Category'];
              $ageRating = $_POST['AgeRating'];
              $filmGuide = $_POST['filmGuide'];
              $description = $_POST['Description'];
              $moviefile = $_FILES['Movie'];
              $thumbnailfile = $_FILES['Thumbnail'];
              $allowed = array("mp4","mp3");
              $moviename = $_FILES['Movie']['name'];
              $ext = pathinfo($moviename, PATHINFO_EXTENSION);
              if(!in_array($ext, $allowed)){
                  echo "filetype not allowed, must be .mp4";
              }else{
                if(strlen($_FILES['Movie']['name']) < 70){
                  $upload2_dir = __DIR__.DS."uploads".DS."user_".$userId;
                  $tmpFileName = $_FILES['Movie']['tmp_name'];
                  moveUploadedFile($upload2_dir, $tmpFileName, $moviename);
                  $path = "$upload2_dir".DS."$moviename";
                  $movie = TRUE;
                }else{
                  $movie = FALSE;
                }
              }
              $allowed = array("jpeg", "jpg","png","gif");
              $thumbnailname = $_FILES['Thumbnail']['name'];
              $ext = pathinfo($thumbnailname, PATHINFO_EXTENSION);
              if(!in_array($ext, $allowed)){
                  echo "filetype not allowed, must be .png, ,jpeg or .jpg";
              }else{
                if(strlen($_FILES['Thumbnail']['name']) < 70){
                  $upload_dir = __DIR__.DS."uploads".DS."user_".$userId;
                  $tmpFileName = $_FILES['Thumbnail']['tmp_name'];
                  moveUploadedFile($upload_dir, $tmpFileName, $thumbnailname);
                  $thumbnailPath = "$upload_dir".DS."$thumbnailname";
                  $thumbnail = TRUE;
                }else{
                  $thumbnail = FALSE;
                }
              }
              if ($movie == TRUE AND $thumbnail == TRUE){
                uploadMovie($userId, $title, $path, $thumbnailPath, $description, $ageRating, $filmGuide, $genre);  
              }
            }else{
              $titlemess = "Please add a title";
              $genremess = "Please select genres.";
              $ageRatemess = "Please select an age rating.";
              $filmGuidemess = "Please select film guides.";
              $descriptionmess = "Please add a description.";
              $moviemess = "Please add a movie file.";
              $thumbnailmess = "Please add a thumbnail.";
            }
          }
          ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container upload">
        <p class="uploadtitle">Upload movie</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
          <div class="spaceupload">
            <label for="MovieTitle" class="spacetextupload">Movie title</label>
            <input type="text" id="MovieTitle" name="MovieTitle" placeholder="Type here your movie title">
          </div>
          <?php if(isset($titlemess)){
                  echo "<p>".$titlemess."</p>";
                }?>
          <div class="spaceupload">
          <p class="spacetextupload">Category</p>
            <div class="multi-selector">
              <div class="select-field">
              <input type="text" name="Category" placeholder="Choose Category" id="Category" class="input-selector" disabled>
              <span class="down-arrow">&blacktriangledown;</span>
              </div>
              <div class="list">
              <?php
                $genres = getTableRecords("SELECT id, naam FROM genre");
                foreach($genres as $key => $genre){
                  echo "<label for=".$genre['naam']." class=\"task\"><input type=\"checkbox\" name=\"Category[]\" id=". $genre['naam']." value='". $genre['id'] ."'/> ".$genre['naam']."</label>";
                }

              ?>
              </div>
            </div>
          </div>
          <?php if(isset($genremess)){
                  echo "<p>".$genremess."</p>";
                }?>
          <div class="spaceupload">
            <label for="AgeRating" class="spacetextupload">Age rating</label>
            <select name="AgeRating" id="AgeRating" class="styleselect">
              <option value="" disabled selected> Select your age </option>
              <option value="0">ALL</option>
              <option value="6">6</option>
              <option value="9">9</option>
              <option value="12">12</option>
              <option value="14">14</option>
              <option value="16">16</option>
              <option value="18">18</option>
            </select> 

            <?php 
               if(isset($ageRatemess)){
                echo "<p>".$ageRatemess."</p>";
              }
            ?>
          </div>  
          <div class="spaceupload">
          <p class="spacetextupload">Film guide</p>
            <div class="multi-selector">
              <div class="select-fieldFilmguide">
                <input type="text" name="Filmguide" placeholder="Choose Film guide" id="Filmguide" class="input-selector" disabled>
                <span class="down-arrow" id="downArrow2"> &blacktriangledown;</span>
              </div>
              <div class="listFilmguide">
              <?php
                $filmGuides = getTableRecords("SELECT id, naam FROM kijkwijzer_geschiktheid");
                foreach($filmGuides as $key => $filmGuide){
                  echo "<label for=".$filmGuide['naam']." class=\"task\"><input type=\"checkbox\" name=\"filmGuide[]\" id=". $filmGuide['naam']." value='". $filmGuide['id']."'/> ".$filmGuide['naam']."</label>";
                }

                ?>
              </div>
            </div>
          </div>
          <?php
          if(isset($filmGuidemess)){
                  echo "<p>".$filmGuidemess."</p>";
                } ?>
          <div class="spaceupload">
            <p class="spacetextupload">Movie</p>
            <div class="file-upload">
               <label for="Movie">Select movie</label>
               <input type="file" id="Movie" name="Movie" class="file" >
            </div>
            <?php 
                 if(isset($moviemess)){
                  echo "<p>".$moviemess."</p>";
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
                 if(isset($thumbnailmess)){
                  echo "<p>".$thumbnailmess."</p>";
                }
            ?>
          </div> 
          <div class="spaceupload">
            <label for="Description" class="spacetextupload">Description</label>
            <textarea id="Description" name="Description" rows="5" cols="70" placeholder="Type here your description of the movie"></textarea>
          </div>  
          <?php 
                 if(isset($descriptionmess)){
                  echo "<p>".$descriptionmess."</p>";
                }
            ?>
          <div class="spaceupload">
            <input type="submit" name='upload' value="upload" class="supload">
          </div>  
        </form>
    </div>
    <!-- end main container  -->
 
  <!--script for the multiple select-field -->
  <script>
    document.querySelector('.select-field').addEventListener('click',()=>{
        document.querySelector('.list').classList.toggle('show');
        document.querySelector('.down-arrow').classList.toggle('rotate180'); });
    document.querySelector('.select-fieldFilmguide').addEventListener('click',()=>{
        document.querySelector('.listFilmguide').classList.toggle('show');
        document.getElementById('downArrow2').classList.toggle('rotate180'); 
      });  

   </script>
   <!-- end of script -->
  </body>
</html>