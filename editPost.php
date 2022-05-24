<?php

include("INC/functions.php");

session_start();

$username = "";
$loginOK = 0;
$post = null;
$postID = -1;
$msg = "";

$clanekTitle_err = $clanekVsebina_err = $clanekAvtor_err = $imageURL_err = $imageAlt_err = "";

if (  isset($_SESSION['loginUserName']) && !empty($_SESSION['loginUserName'])  ) {
    $loginOK = 1;
    $username = $_SESSION['loginUserName'];

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $error = 0;
        if( empty( $_POST["clanekTitle"]  ) ){
            $clanekTitle_err = "Please enter a clanekTitle.";
            $error = 1;
        }
        if( empty( $_POST["clanekVsebina"]  ) ){
            $clanekVsebina_err = "Please enter a clanekVsebina.";
            $error = 2;
        }
        /*
        if( empty( $_POST["clanekAvtor"]  ) ){
            $clanekAvtor_err = "Please enter a clanekAvtor.";
            $error = 2;
        }
        if( empty( $_POST["imageURL"]  ) ){
            $imageURL_err = "Please enter a imageURL.";
            $error = 2;
        }
        if( empty( $_POST["imageAlt"]  ) ){
            $imageAlt_err = "Please enter a imageAlt.";
            $error = 2;
        }
        */

        if( empty( $_POST["postID"]  ) ){
            $error = 2;
        }
        if (!$error) {
            $postIDTre = $_POST["postID"];
            $clanekTitleUpdate = $_POST["clanekTitle"];
            $clanekVsebinaUpdate = $_POST["clanekVsebina"];
            //$clanekAvtorUpdate = $_POST["clanekAvtor"];
            //$imageURLUpdate = $_POST["imageURL"];
            //$imageAltUpdate = $_POST["imageAlt"];

            $date = new DateTime();
            $database = databaseConnection();
            $data = [
                'title' => $clanekTitleUpdate,
                'content' => $clanekVsebinaUpdate,
                'updated' => $date->getTimestamp(),
                'id' => $postIDTre
            ];
            $sql = "UPDATE posts SET title=:title, content=:content, updated=:updated WHERE ID=:id";
            $stmt= $database->prepare($sql);
            // ALI $postsFromDb->execute([ 'removed' => null ]);

            if ( $stmt->execute($data) ) {
                $msg = "Updated OK.";
            } else {
                $msg = "Update FAIL.";
            }

        } else {
            //echo "<br>TUKAJ 1<br>";
        }

    }



    if (  isset( $_GET["postID"] ) || isset( $_POST["postID"] ) )  {

        if ( isset( $_GET["postID"] ) ) {
            $postID = $_GET["postID"];
            //echo "<br>TUKAJ 2<br>";
        } else {
            $postID = $_POST["postID"];
            //echo "<br>TUKAJ 3<br>";
        }

        $post = getArticle( $postID );
        //echo $post;
    } else {
        //header("Location: index.php");
        //die("");
    }

} else {
    header("Location: index.php");
    die("");
}

//echo "Pokaži clanekID: $clanekID";

if ( $post ) {
    //echo "Članek obstaja";

    $value = $post;
    $image = $value["image"];
    $imageURL = $image["url"];
    $imageAlt = $image["alt"];
    $clanekTitle = $value["title"];
    $clanekVsebina = $value["content"];
    $clanekAvtor = $value["authored by"];
    $dateTime = date('d-m-Y', $value["authored on"]);
    $dateTimeLastUpdate = date('d-m-Y', $value["lastUpdate"]);


} else {
    //echo "Članek NE obstaja";
    //header("Location: error404.php");
    //die();
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
        <div class="col-sm-12">


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <input type="hidden" name="postID" class="form-control " value="<?php echo $postID; ?>">
                </div>
                <div class="form-group">
                    <label>clanekTitle</label>
                    <input type="text" name="clanekTitle" class="form-control <?php echo (!empty($clanekTitle_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $clanekTitle; ?>">
                    <span class="invalid-feedback"><?php echo $clanekTitle_err; ?></span>
                </div>
                <div class="form-group">
                    <label>clanekVsebina</label>
                    <input type="text" name="clanekVsebina" class="form-control <?php echo (!empty($clanekVsebina_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $clanekVsebina; ?>">
                    <span class="invalid-feedback"><?php echo $clanekVsebina_err; ?></span>
                </div>
                <!--
                <div class="form-group">
                    <label>clanekAvtor</label>
                    <input type="text" name="clanekAvtor" class="form-control <?php echo (!empty($clanekAvtor_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $clanekAvtor; ?>">
                    <span class="invalid-feedback"><?php echo $clanekAvtor_err; ?></span>
                </div>
                <div class="form-group">
                    <label>imageURL</label>
                    <input type="text" name="imageURL" class="form-control <?php echo (!empty($imageURL_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $imageURL; ?>">
                    <span class="invalid-feedback"><?php echo $imageURL_err; ?></span>
                </div>
                <div class="form-group">
                    <label>imageAlt</label>
                    <input type="text" name="imageAlt" class="form-control <?php echo (!empty($imageAlt_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $imageAlt; ?>">
                    <span class="invalid-feedback"><?php echo $imageAlt_err; ?></span>
                </div>
                -->
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>

            <div>
                <p>
                    <?php
                        echo $msg;
                    ?>
                </p>
            </div>

        <?php
        if ( $loginOK ) {
            echo '<a href="removePost.php?postID=' . $postID . '">Disable Post</a>';
        }
        ?>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>