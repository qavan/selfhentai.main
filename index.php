<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/mysql.php';
//print_r($_COOKIE);
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (!empty(db_session_check($db,$_COOKIE['SESSION']))) {
        header('refresh:3;url="http://natribu.org";');
        echo "authorized, redirect to main in 3 seconds";
        die;
    }
    else {
        header('refresh:3;url="http://selfhentai.ru/login.php";');
        echo "token not actual, redirect in 3 seconds to auth page";
        die;
    }

}
else {
    header('refresh:3;url="http://selfhentai.ru/login.php";');
    echo "non authorized, redirect in 3 seconds to auth page";
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
    <title>Index</title>
</head>
<body id="bg">
<?php
echo '<div id="formparent">';
//    echo "<div id=\"form\">";
//        <div class="footer">Powered by qavan</div>
//    echo "</div>";
echo '</div>';
?>
</body>
</html>
<?php
mysqli_close($db);
?>