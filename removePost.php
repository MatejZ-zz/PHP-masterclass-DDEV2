<?php

include("INC/functions.php");

session_start();

$username = "";
$loginOK = 0;
$msg = "";
if (  isset($_SESSION['loginUserName']) && !empty($_SESSION['loginUserName'])  ) {
    $loginOK = 1;
    $username = $_SESSION['loginUserName'];

    if (  isset( $_GET["postID"]  )  ) {
        $postID =$_GET["postID"];


        $database = databaseConnection();

        $date = new DateTime();
        //echo $date->getTimestamp();


        $data = [
            'removed' => $date->getTimestamp(),
            'id' => $postID
        ];
        $sql = "UPDATE posts SET removed=:removed WHERE id=:id";
        $stmt= $database->prepare($sql);

        // ALI $postsFromDb->execute([ 'removed' => null ]);

        if ( $stmt->execute($data) ) {
            $msg = "Post disabled successfully";
        } else {
            $msg = "ERROR 123";
        }



    } else {
        header("Location: index.php");
        die("");
    }

} else {
    header("Location: index.php");
    die("");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Proceduralni CMS - Agiledrop PHP-Masterclass</title>
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
        echo "<h4> $msg  by user: $username</h4>";
    ?>

</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
