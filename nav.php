<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        
        
        if ($path_parts['filename'] == "master") {
            print '<li class="activePage"><a href="master.php">Master</a></li>';
        } else {
            print '<li><a href="master.php">Master</a></li>';
        }
        if ($path_parts['filename'] == "batting") {
            print '<li class="activePage"><a href="batting.php">Batting</a></li>';
        } else {
            print '<li><a href="batting.php">Batting</a></li>';
        }
        if ($path_parts['filename'] == "pitching") {
            print '<li class="activePage"><a href="pitching.php">Pitching</a></li>';
        } else {
            print '<li><a href="pitching.php">Pitching</a></li>';
        }
        if ($path_parts['filename'] == "fielding") {
            print '<li class="activePage"><a href="fielding.php">Fielding</a></li>';
        } else {
            print '<li><a href="fielding.php">Fielding</a></li>';
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

