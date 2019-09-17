<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
//print_r($_COOKIE);
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (!empty(db_session_check($db,$_COOKIE['SESSION']))) {
        echo '<pre>';var_dump($_SERVER);echo '</pre>';
        die;
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
    <title>SelfHentai</title>
</head>
<body class="backGround">
<div class="gigaForm">
    <div class="gifH">
            <img src="/images/h.gif" alt="h gif">
    </div>
</div>
</body>
</html>
<?php
mysqli_close($db);
?>