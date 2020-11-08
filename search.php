<html>
<body>

<h1>Search Links</h1>

<?php
function search($string, $filename)  {
    $searchKeyword = $_POST["name"];//user input phrase to search for
    //since file_get_contents will run a function that is called on one of these pages, must call the source files that are being used in the function to see if there are matching keywords
    if($filename == "blog.php") {
        $string .= file_get_contents("blogwikitextformat.txt");
    }
    else if($filename == "index.php") {
        $string .= file_get_contents("mainpagetext.txt");
        $string .= file_get_contents("Programminglanguages.csv");
    }
    else if($filename == "gallery.php") {
        $string .= file_get_contents("gallery.csv");
    }
    else if($filename == "tips.php") {
        $string .= file_get_contents("tips.txt");
    }
    //if strpos() returns false then the keyword is not in that file
    if($keywordpos = strpos($string, $searchKeyword) != false) {
        echo "Keyword found on the page '".$filename."': ".'<a href=http://jacobscsce315domain.freecluster.eu/'.$filename.'>http://jacobscsce315domain.freecluster.eu/'.$filename.'?highlight='.$searchKeyword.'</a><br>';
    }
    else {
        echo "Keyword not found on page '".$filename."'<br>";
    }
    
}
search(file_get_contents("index.php"), "index.php");
search(file_get_contents("gallery.php"), "gallery.php");
search(file_get_contents("blog.php"), "blog.php");
search(file_get_contents("tips.php"), "tips.php");
search(file_get_contents("resources.php"), "resources.php");
?>

</html>
</body>
