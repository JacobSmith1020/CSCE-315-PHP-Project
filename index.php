<html>

<!-- HEAD section ............................................................................ -->
<head>
  <title> Jacob's Programming Studio Project 1 Web Site </title>

  <!-- javascript functions -->
  <script>
  function randText() {
      let randomBits = ["hello world", "random thoughts", "pinky and the brain"];
      document.getElementById("demo").innerHTML = randomBits[Math.floor(Math.random()*3)];
  }
  </script>

  <!-- style -->
 
  <style>
    div.defaultFont {
        font-family: Helvetica, Arial, sans-serif;
    }
    
    div.secondaryFont {
        font-family: serif;
    }

    h3 {
        color: maroon;
    }
    h4 {
        text-align:left;
        color: blue;
    }
    h5 {
        text-align:center;
    }
    h6 {
        text-align:right;
    }
    <!-- link href="default.css" rel="stylesheet" type="text/css -->
  </style>

  

</head>

<!-- BODY section ............................................................................. -->
<body>
<div class="defaultFont">
<h1> Jacob's Programming Studio Project 1 Web Site </h1>

<!--Search input handling-------------------------------------------------------------------------->
<p/>
<form action="search.php" method="post">
Search all pages: <input type="text" name="name"> 
<input type="submit">
</form>
<p/>

<!-- PHP testing area ................................ --> 
<?php
    include 'proc_wikitext.php';
    proc_wikitext("mainpagetext.txt");
    include 'proc_csv.php';
    proc_csv("Programminglanguages.csv",",","\"", "ALL");
?>

<hr>
<div class="secondaryFont">
<h3>Page Links</h3>
<h4><a href="http://jacobscsce315domain.freecluster.eu/index.php">Main Page</a><br></h4>
<h4><a href="http://jacobscsce315domain.freecluster.eu/gallery.php">Gallery Page</a><br></h4>
<h4><a href="http://jacobscsce315domain.freecluster.eu/blog.php">Blog Page</a><br></h4>
<h4><a href="http://jacobscsce315domain.freecluster.eu/tips.php">Tips Page</a><br></h4>
<h4><a href="http://jacobscsce315domain.freecluster.eu/resources.php">Resources Page</a><br></h4>
</div>
</div> <!-- end of big div --> 

</body>

</html>

