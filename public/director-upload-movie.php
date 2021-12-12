<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <link rel="stylesheet" href="./assets/css/styleupload.css">
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
            <input type="text" id="MovieTitle" name="MovieTitle" placeholder="Type here your movie title">
          </div>
          <div class="spaceupload">
            <div class="multi-selector">
              <div class="select-field">
              <input type="text" name="" placeholder="Choose Category" id="Category" class="input-selector">
              <span class="down-arrow">&blacktriangledown;</span>
              </div>
              <div class="list">
                <label for="Action" class="selection"><input type="checkbox" name="Action" id="Action">Action</label>
                <label for="Comedy" class="selection"><input type="checkbox" name="Comedy" id="Comedy">Comedy</label>
                <label for="Drama" class="selection"><input type="checkbox" name="Drama" id="Drama">Drama</label>
                <label for="Documentary" class="selection"><input type="checkbox" name="Documentary" id="Documentary">Documentary</label>
                <label for="Fantasy" class="selection"><input type="checkbox" name="Fantasy" id="Fantasy">Fantasy</label>
                <label for="Horror" class="selection"><input type="checkbox" name="Horror" id="Horror">Horror</label>
                <label for="Mystery" class="selection"><input type="checkbox" name="Mystery" id="Mystery">Mystery</label>
                <label for="Romance" class="selection"><input type="checkbox" name="Romance" id="Romance">Romance</label>
                <label for="Sci-if" class="selection"><input type="checkbox" name="Sci-if" id="Sci-if">Sci-if</label>
                <label for="Thriller" class="selection"><input type="checkbox" name="Thriller" id="Thriller">Thriller</label>
                <label for="Western" class="selection"><input type="checkbox" name="Western" id="Western">Western</label>
                <label for="Other" class="selection"><input type="checkbox" name="Other" id="Other">Other</label>
              </div>
            </div>
          </div>
          <div class="spaceupload">
            <label for="AgeRating" class="spacetextupload">Age rating</label>
            <select name="AgeRating" id="AgeRating" class="styleselect">
              <option value="null">Choose age rating</option>
              <option value="0">ALL</option>
              <option value="6">6</option>
              <option value="9">9</option>
              <option value="12">12</option>
              <option value="14">14</option>
              <option value="16">16</option>
              <option value="18">18</option>
            </select> 
          </div>  
          <div class="spaceupload">
            <div class="multi-selector">
              <div class="select-field">
              <input type="text" name="" placeholder="Choose Kijkwijzer" id="Kijkwijzer" class="input-selector">
              <span class="down-arrow">&blacktriangledown;</span>
              </div>
              <div class="list">
                <label for="Voilence" class="selection"><input type="checkbox" name="Voilence" id="Voilence">Voilence</label>
                <label for="Sex" class="selection"><input type="checkbox" name="Sex" id="Sex">Sex</label>
                <label for="Discrimnation" class="selection"><input type="checkbox" name="Discrimnation" id="Discrimnation">Discrimnation</label>
                <label for="Fear" class="selection"><input type="checkbox" name="Fear" id="Fear">Fear</label>
                <label for="Foul launguage" class="selection"><input type="checkbox" name="Foul launguage" id="Foul launguage">Foul launguage</label>
              </div>
            </div>
          </div>
          <div class="spaceupload">
            <p class="spacetextupload">Movie</p>
            <div class="file-upload">
               <label for="Movie">Select movie</label>
               <input type="file" id="Movie" name="Movie" class="file" >
            </div>
          </div>
          <div class="spaceupload">
            <p class="spacetextupload">Thumbnail</p>
            <div class="file-upload">
              <label for="Thumbnail">Thumbnail</label>
              <input type="file" id="Thumbnail" name="Thumbnail" class="file">
            </div>
          </div> 
          <div class="spaceupload">
            <label for="Description" class="spacetextupload">Description</label>
            <textarea id="Description" name="Description" rows="5" cols="70" placeholder="Type here your description of the movie"></textarea>
          </div>  
          <div class="spaceupload">
            <input type="submit" value="Upload movie" class="supload">
          </div>  
        </form>
    </div>
    <!-- end main container  -->
  
  <!--script for the multiple select-field -->
  <script>
    document.querySelector('.select-field').addEventListener('click',()=>{
        document.querySelector('.list').classList.toggle('show');
        document.querySelector('.down-arrow').classList.toggle('rotate180'); });
   </script>
   <script>
    document.querySelector('.select-field').addEventListener('click',()=>{
        document.querySelector('.list').classList.toggle('show');
        document.querySelector('.down-arrow').classList.toggle('rotate180'); });
   </script>
   <!-- end of script -->
  </body>
</html>