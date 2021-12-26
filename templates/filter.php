<div class="filter">
    <div class="menu">
        <i id="close" class="close fas fa-times"></i>
        <div class="menu_items">
            <h1>Filter</h1>
            <h2>Category</h2>
            <form action="homepage.php" method="GET">

                <ul class="list">
                <?php 
                
                $genres = getTableRecords("SELECT naam FROM genre");
                foreach ($genres as $genre) {
                    echo "
                    <li>
                        <label> 
                            <input name=\"genres[]\" type=\"checkbox\" value=\"".$genre["naam"]."\">
                            ".$genre["naam"]." 
                        </label> 
                    </li>";
                }

                if (isset($_GET['search-movie'])){
                    echo "<li><input type=\"hidden\" value=\"" . $_GET['search-movie'] . "\" name=\"search-movie\"></li>";
                }

                ?>
                </ul>
                <input type="submit" class="button" value="Filter">
            </form>

        </div>
    </div>
</div>