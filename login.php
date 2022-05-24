<?php
require_once("INC/functions.php");
$database = databaseConnection();
if ( $database ) {

} else {
    header("Location: index.php");
    die();
}
session_start();
//$_SESSION['enterTime'] = time();
//$_SESSION['loginUserName'] = NULL;
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
if (  isset($_SESSION['loginUserName']) && !empty($_SESSION['loginUserName'])  ) {
    header("Location: index.php"); die();
} else {
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $error = 0;
        if( empty( trim( $_POST["username"] ) ) ){
            $username_err = "Please enter a username.";
            $error = 1;
        }
        if( empty( trim( $_POST["password"] ) ) ){
            $password_err = "Please enter a password.";
            $error = 2;
        }
        if (!$error) {
            $username = $_POST["username"];
            $passwordSha = sha1($_POST["password"]);
            //echo $passwordSha; // 123 = 40bd001563085fc35165329ea1ff5c5ecbdbbeef

            $stmt = $database->prepare("SELECT * FROM users WHERE users.username = :username AND users.password = :password");
            $stmt->execute( ['username' => $username, 'password' => $passwordSha] );
            $rowCount = $stmt->rowCount();
            //echo $rowCount;

            $loginOK = 0;
            if ($userData = $stmt->fetch() && $rowCount == 1) {
                $loginOK = 1;
                $_SESSION['loginUserName'] = $_POST["username"];
                header("Location: index.php"); die();
            } else {
                $_SESSION['loginUserName'] = NULL;
                $username_err = "Username and password not ok.";
                $password_err = "Username and password not ok.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Login</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>

</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"> PHP-Masterclass</a>
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

        <h2>Login</h2>
        <p>By logging in you agree to the ridiculously long terms that you didn't bother to read.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>

    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>