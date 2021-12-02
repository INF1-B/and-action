<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <?php include "../head.php" ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container">
        <p>Upload movie</p>
        <form>
          <label for="MovieTitle">Movie title</label><br>
          <input type="text" id="MovieTitle" name="MovieTitle"><br>
        
          <label for="Category">Category</label><br>
          <select name="Category">
                <option value="null">Choose category</option>
                <option value="">Action</option>
                <option value="">Comedy</option>
                <option value="">Drama</option>
                <option value="">Documentary</option>
                <option value="">Fantasy</option>
                <option value="">Horror</option>
                <option value="">Mystery</option>
                <option value="">Romance</option>
                <option value="">Thriller</option>
          </select> <br>      

          <label for="AgeRating">Age rating</label><br>
          <select name="AgeRating">
                <option value="null">Choose age ratting</option>
                <option value="0">AL</option>
                <option value="6">6</option>
                <option value="9">9</option>
                <option value="12">12</option>
                <option value="14">14</option>
                <option value="16">16</option>
                <option value="18">18</option>
          </select> <br>

          <div>
             <label for="Movie">Movie</label><br>
             <input type="file" id="Movie" name="Movie" >
          </div>
          <label for="Thumbnail">Thumbnail</label><br>
          <input type="file" id="Thumbnail" name="Thumbnail"><br>
          
          <label for="Description">Description</label><br>
          <textarea id="Description" name="Description" rows="5" cols="70" placeholder="Type here your description of the movie"></textarea><br>

          <label for="UploadMovie">Upload Movie</label><br>
          <input type="submit" value="Upload movie">

        </form>
      <div></div>
      <div></div>

    </div>

    <!-- end main container  -->
    
  </body>

</html>