<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
//print_r($_COOKIE);
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (!empty(db_session_check($db,$_COOKIE['SESSION']))) {
//        echo '<pre>';var_dump($_SERVER);echo '</pre>';
//        die;
    }
    else {
        header('refresh:3;url="http://selfhentai.ru/login.php";');
        die;
    }
}
else {
    header('refresh:3;url="http://selfhentai.ru/login.php";');
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/16.jpg" type="image/jpg">
    <link rel="stylesheet" href="/styles/reset.scss" type="text/css">
    <link rel="stylesheet" href="/styles/index.css" type="text/css">
    <link rel="stylesheet" href="/styles/index.css" type="text/">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <title>Index</title>
</head>
<body class="bg">
<div class="gigaForm">
    <div class="container">
        <div class="goToLogin">
            <img class="L" src="images/login1.png" type="image/png" alt="L0">
            <a href="login.php" class="text textL" style="display: none">SIGN IN</a>
        </div>
        <div class="goToRegister">
            <img class="R" src="images/register0.png" type="image/png" alt="R0">
            <a href="register.php" class="text textR" style="display: none">SIGN UP</a>
        </div>
</div>
</div>
<div class="flaticon codeStyle">Icons made by <a href="https://www.flaticon.com/authors/srip" title="Freepik">Freepik</a> and <a href="https://www.flaticon.com/authors/srip" title="smashicons">smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com </a></div>
</body>
</html>
<?php
mysqli_close($db);
?>