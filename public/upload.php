<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <?php include "../templates/head.php" ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container">
        <p class="uploadtitle">Upload movie</p>
        <form>
          <div class="spaceupload">
            <label for="MovieTitle" class="spacetextupload">Movie title</label>
            <input type="text" id="MovieTitle" name="MovieTitle" placeholder="Type here your movie title"><br>
          </div>
          <div class="spaceupload">
            <label for="Category" class="spacetextupload">Category</label>
            <select name="Category" id="Category" class="styleselect">
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
             </select>
          </div>
          <div class="spaceupload">
            <label for="AgeRating" class="spacetextupload">Age rating</label>
            <select name="AgeRating" id="Age-rating" class="styleselect">
              <option value="null">Choose age rating</option>
              <option value="0">AL</option>
              <option value="6">6</option>
              <option value="9">9</option>
              <option value="12">12</option>
              <option value="14">14</option>
              <option value="16">16</option>
              <option value="18">18</option>
            </select> 
          </div>  
          <div class="spaceupload">
            <p class="spacetextupload">Movie</p>
            <div class="file-upload">
               <label for="Movie">Select movie</label><br>
               <input type="file" id="Movie" name="Movie" class="file" >
            </div>
          </div>
          <div class="spaceupload">
            <p class="spacetextupload">Thumbnail</p>
            <div class="file-upload">
              <label for="Thumbnail">Thumbnail</label>
              <input type="file" id="Thumbnail" name="Thumbnail" class="file"><br>
            </div>
          </div> 
          <div class="spaceupload">
            <label for="Description" class="spacetextupload">Description</label>
            <textarea id="Description" name="Description" rows="5" cols="70" placeholder="Type here your description of the movie"></textarea><br>
          </div>  
          <div class="spaceupload">
            <input type="submit" value="Upload movie" class="supload">
          </div>  
        </form>
    </div>

    <!-- end main container  -->
    
  </body>
</html>