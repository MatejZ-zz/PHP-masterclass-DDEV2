<?php

require_once("helpers/posts.php");

$clanekID = -1;
$clanekObstaja = FALSE;

function checkClanekObstaja( $cID, $posts ) {
    if (is_numeric($cID)) {
        if ( array_key_exists($cID, $posts) ) {
            global $clanekID;
            $clanekID = $cID;
            return TRUE;
        }
    }
    return FALSE;
}


if (  isset( $_GET["id"]  )  ) {
    $clanekObstaja = checkClanekObstaja( $_GET["id"], $posts );
}

//echo "Pokaži clanekID: $clanekID";

if ( $clanekObstaja ) {
    //echo "Članek obstaja";

    $value = $posts[$clanekID];
    $image = $value["image"];
    $imageURL = $image["url"];
    $imageAlt = $image["alt"];
    $clanekTitle = $value["title"];
    $clanekVsebina = $value["content"];
    $clanekAvtor = $value["authored by"];
    $dateTime = date('d-m-Y', $value["authored on"]);


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
  <title><?php echo"asdf"; ?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet"/>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Agiledrop PHP-Masterclass</a>
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
    <?php

        echo "<H1> " . $clanekTitle . " </H1>";
        echo '<img src=' . $imageURL . ' alt="'. $imageAlt . '">';

        echo "<br>$clanekVsebina<br>";
        echo "<H3> " . $clanekAvtor . " </H3>";

        echo "<H5> " . $dateTime. " </H5>";

    ?>

</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>