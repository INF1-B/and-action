<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <link rel="stylesheet" href="./assets/css/styleupload.css">
    <link rel=
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
            <label for="Category" class="spacetextupload">Category</label>
            <select name="Category" id="Category" class="styleselect">
              <option value="null">Choose category</option>
              <option value="Action">Action</option>
              <option value="Comedy">Comedy</option>
              <option value="Drama">Drama</option>
              <option value="Documentary">Documentary</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Horror">Horror</option>
              <option value="Mystery">Mystery</option>
              <option value="Romance">Romance</option>
              <option value="Sci-if">Sci-if</option>
              <option value="Thriller">Thriller</option>
              <option value="Western">Western</option>
              <option value="Other">Other</option>
             </select>
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
            <label for="kijkwijzer_geschiktheid" class="spacetextupload">Kijkwijzer geschikheid</label>
            <select name="kijkwijzer_geschiktheid" id="kijkwijzer_geschiktheid" class="styleselect">
              <option value="null">Choose kijkwijzer</option>
              <option value="Voilence">Voilence</option>
              <option value="Sex">Sex</option>
              <option value="Discrimnation">Discrimnation</option>
              <option value="Fear">Fear</option>
              <option value="Foul launguage">Foul launguage</option>
            </select>
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

    <div class="multi-selector">

     <div class="select-field">
<input type="text" name="" placeholder="Choose tasks" id="" class="input-selector">
     <span class="down-arrow">&blacktriangledown;</span>
     </div>
<!---------List of checkboxes and options----------->
     <div class="list">
       <label for="Action" class="task">
            <input type="checkbox" name="" id="Action">Action
     </label>
       <label for="task2" class="task">
            <input type="checkbox" name="" id="task2">
            Task 2
     </label>
       <label for="task3" class="task">
            <input type="checkbox" name="" id="task3">
            Task 3
     </label>
       <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     <label for="task4" class="task">
            <input type="checkbox" name="" id="task4">
            Task 4
     </label>
     </div>
    </div>






    <!-- end main container  -->
    
     <!--script for the multiple select-field -->
  <script>
    document.querySelector('.select-field').addEventListener('click',()=>{
        document.querySelector('.list').classList.toggle('show');
        document.querySelector('.down-arrow').classList.toggle('rotate180');

    });
   </script>
   <!-- end of script -->
  </body>
</html>