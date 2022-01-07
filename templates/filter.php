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
                    $selectedGenres = isset($_GET['genres']) ? $_GET['genres'] : array();
                    foreach ($genres as $genre) {
                        if (in_array($genre['naam'], $selectedGenres)){
                            echo "
                            <li>
                                <label> 
                                    <input name=\"genres[]\" type=\"checkbox\" value=\"".$genre["naam"]."\" checked>
                                    ".$genre["naam"]." 
                                </label> 
                            </li>";
                        } else {
                            echo "
                            <li>
                                <label> 
                                    <input name=\"genres[]\" type=\"checkbox\" value=\"".$genre["naam"]."\">
                                    ".$genre["naam"]." 
                                </label> 
                            </li>";
                        }
                    }

                ?>
                </ul>
                <input type="submit" class="button" value="Filter">
            </form>

        </div>
    </div>
</div>