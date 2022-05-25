<?php

//require_once("helpers/posts.php");
include("INC/functions.php");

session_start();

$clanekID = -1;
$clanek = FALSE;

if (  isset( $_GET["id"]  )  ) {
    $clanekID = $_GET["id"];
    $clanek = getArticle( $_GET["id"] );

    $clanekObj = getArticleObj( $_GET["id"] );

}

$username = "";
$loginOK = 0;
if (  isset($_SESSION['loginUserName']) && !empty($_SESSION['loginUserName'])  ) {
    $loginOK = 1;
    $username = $_SESSION['loginUserName'];
} else {

}

//echo "Pokaži clanekID: $clanekID";

//if ( $clanek ) {
if ( $clanekObj ) {
    //echo "Članek obstaja";
    /*
    $value = $clanek;
    $image = $value["image"];
    $imageURL = $image["url"];
    $imageAlt = $image["alt"];
    $clanekTitle = $value["title"];
    $clanekVsebina = $value["content"];
    $clanekAvtor = $value["authored by"];
    $dateTime = date('d-m-Y', $value["authored on"]);
    $dateTimeLastUpdate = date('d-m-Y', $value["lastUpdate"]);
    */

    $image = $clanekObj->getImage();
    $imageURL = $image["url"];
    $imageAlt = $image["alt"];
    $clanekTitle = $clanekObj->getTitle();
    $clanekVsebina = $clanekObj->getContent();
    $clanekAvtor = $clanekObj->getAuthoredBy();
    $dateTime = date('d-m-Y', $clanekObj->getAuthoredOn());
    $dateTimeLastUpdate = date('d-m-Y', $clanekObj->getLastUpdate());


} else {
    //echo "Članek NE obstaja";
    header("Location: error404.php");
    die();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo $clanekAvtor; ?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet"/>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Agiledrop PHP-Masterclass <?php echo  $username; ?> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
        class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Page content-->
<div class="container">
    <div class="row">
    <?php
        echo '<div class="col-sm-12">';
        //echo "<H1> " . $clanekTitle . " </H1>";

        $clanekObj->izpisiNaslov();
        echo '<img src=' . $imageURL . ' alt="'. $imageAlt . '">';

        //echo "<br>$clanekVsebina<br>";
        $clanekObj->izpisiCeloto();

        //echo "<H3>$clanekAvtor</H3>";
        $clanekObj->izpisiAvtor();

        //echo "<H5>$dateTime</H5>";
        $clanekObj->izpisiObjavaDatum();

        echo "<H5>$dateTimeLastUpdate</H5>";

        if ( $loginOK ) {
            echo '<a href="editPost.php?postID=' . $clanekID . '">Edit Post</a>';
        }

        echo '</div>';
    ?>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>