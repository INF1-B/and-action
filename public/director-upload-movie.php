<?php
include('../utils/authentication.php');

checkLoggedIn();
?>
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
          <p class="spacetextupload">Category</p>
            <div class="multi-selector">
              <div class="select-field">
              <input type="text" name="Category" placeholder="Choose Category" id="Category" class="input-selector" disabled>
              <span class="down-arrow">&blacktriangledown;</span>
              </div>
              <div class="list">
                <label for="Action" class="task"><input type="checkbox" name="Category[]" id="Action" value="Action"/> Action</label>
                <label for="Comedy" class="task"><input type="checkbox" name="Category[]" id="Comedy" value="Comedy"/> Comedy</label>
                <label for="Drama" class="task"><input type="checkbox" name="Category[]" id="Drama" value="Drama"/> Drama</label>
                <label for="Documentary" class="task"><input type="checkbox" name="Category[]" id="Documentary" value="Documentary"/> Documentary</label>
                <label for="Fantasy" class="task"><input type="checkbox" name="Category[]" id="Fantasy" value="Fantasy"/> Fantasy</label>
                <label for="Horror" class="task"><input type="checkbox" name="Category[]" id="Horror" value="Horror"/> Horror</label>
                <label for="Mystery" class="task"><input type="checkbox" name="Category[]" id="Mystery" value="Mystery"/> Mystery</label>
                <label for="Romance" class="task"><input type="checkbox"  name="Category[]" id="Romance" value="Romance"/> Romance</label>
                <label for="Science-fiction" class="task"><input type="checkbox"  name="Category[]" id="Science-fiction" value="Science-fiction"/> Science fiction</label>
                <label for="Thriller" class="task"><input type="checkbox" name="Category[]" id="Thriller" value="Thriller"/> Thriller</label>
                <label for="Western" class="task"><input type="checkbox" name="Category[]" id="Western" value="Western"/> Western</label>
                <label for="Other" class="task"><input type="checkbox" name="Category[]" id="Other" value="Other"/> Other</label>
              </div>
            </div>
          </div>
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
          </div>  
          <div class="spaceupload">
          <p class="spacetextupload">Film guide</p>
            <div class="multi-selector">
              <div class="select-fieldFilmguide">
                <input type="text" name="Filmguide" placeholder="Choose Film guide" id="Filmguide" class="input-selector" disabled>
                <span class="down-arrow" id="downArrow2"> &blacktriangledown;</span>
              </div>
              <div class="listFilmguide">
                <label for="Violence" class="task"><input type="checkbox" name="Filmguide[]" id="Violence" value="Violence"> Violence</label>
                <label for="Sex" class="task"><input type="checkbox" name="Filmguide[]" id="Sex" value="Sex"> Sex</label>
                <label for="Drugs" class="task"><input type="checkbox" name="Filmguide[]" id="Drugs" value="Horror"> Drugs</label>
                <label for="Discrimination" class="task"><input type="checkbox" name="Filmguide[]" id="Discrimination" value="Discrimination"> Discrimination</label>
                <label for="Fear" class="task"><input type="checkbox" name="Filmguide[]" id="Fear" value="Fear"> Fear</label>
                <label for="Foul-language" class="task"><input type="checkbox" name="Filmguide[]" id="Foul-language" value="Foul-language"> Foul language</label>
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
    document.querySelector('.select-fieldFilmguide').addEventListener('click',()=>{
        document.querySelector('.listFilmguide').classList.toggle('show');
        document.getElementById('downArrow2').classList.toggle('rotate180'); 
      });  

   </script>
   <!-- end of script -->
  </body>
</html>