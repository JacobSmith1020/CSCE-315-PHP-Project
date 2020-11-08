<?php
    echo "<h1> Gallery </h1>";
    echo "<h4> This page shows a gallery of images sorted and displayed in serveral formats </h4><hr>";
    include 'proc_gallery.php';
    //test list mode and all sorting combinations
    echo "<h1> list orig </h1>";
    proc_gallery("gallery.csv", "list", "orig");
    echo "<h1> list date_newest </h1>";
    proc_gallery("gallery.csv", "list", "date_newest");
    echo "<h1> list date_oldest </h1>";
    proc_gallery("gallery.csv", "list", "date_oldest");
    echo "<h1> list size_largest </h1>";
    proc_gallery("gallery.csv", "list", "size_largest");
    echo "<h1> list size_smallest </h1>";
    proc_gallery("gallery.csv", "list", "size_smallest");
    echo "<h1> list rand </h1>";
    proc_gallery("gallery.csv", "list", "rand");

    //test matrix mode and all sorting combinations
    echo "<h1> matrix orig </h1>";
    proc_gallery("gallery.csv", "matrix", "orig");
    echo "<h1> matrix date_newest </h1>";
    proc_gallery("gallery.csv", "matrix", "date_newest");
    echo "<h1> matrix date_oldest </h1>";
    proc_gallery("gallery.csv", "matrix", "date_oldest");
    echo "<h1> matrix size_largest </h1>";
    proc_gallery("gallery.csv", "matrix", "size_largest");
    echo "<h1> matrix size_smallest </h1>";
    proc_gallery("gallery.csv", "matrix", "size_smallest");
    echo "<h1> matrix rand </h1>";
    proc_gallery("gallery.csv", "matrix", "rand");

    //test details mode and all sorting combinations
    echo "<h1> details orig </h1>";
    proc_gallery("gallery.csv", "details", "orig");
    echo "<h1> details date_newest </h1>";
    proc_gallery("gallery.csv", "details", "date_newest");
    echo "<h1> details date_oldest </h1>";
    proc_gallery("gallery.csv", "details", "date_oldest");
    echo "<h1> details size_largest </h1>";
    proc_gallery("gallery.csv", "details", "size_largest");
    echo "<h1> details size_smallest </h1>";
    proc_gallery("gallery.csv", "details", "size_smallest");
    echo "<h1> details rand </h1>";
    proc_gallery("gallery.csv", "details", "rand");
?>
<html>
    <style>
        h3 {
            color: maroon;
        }
        h4 {
            text-align:left;
        }
    </style>
    <hr>
    <h3>Page Links</h3>
    <h4><a href="http://jacobscsce315domain.freecluster.eu/index.php">Main Page</a><br></h4>
    <h4><a href="http://jacobscsce315domain.freecluster.eu/gallery.php">Gallery Page</a><br></h4>
    <h4><a href="http://jacobscsce315domain.freecluster.eu/blog.php">Blog Page</a><br></h4>
    <h4><a href="http://jacobscsce315domain.freecluster.eu/tips.php">Tips Page</a><br></h4>
    <h4><a href="http://jacobscsce315domain.freecluster.eu/resources.php">Resources Page</a><br></h4>
</html>