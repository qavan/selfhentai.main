<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
//print_r($_COOKIE);
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (!empty(db_session_check($db,$_COOKIE['SESSION']))) {
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
    <link rel="shortcut icon" href="/images/icon2407.png" type="image/png">
    <link rel="stylesheet" href="/styles/reset.css" type="text/css">
    <link rel="stylesheet" href="/styles/index.css" type="text/css">
    <title>Главная страница</title>
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