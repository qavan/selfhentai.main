<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/mysql.php';
if (isset($_POST['login']) and isset($_POST['password'])) {
    if (strlen($_POST['login']) > 1 and strlen($_POST['password']) > 1) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (!empty(db_login_check($db, $login, $password))) {
            $key = md5($login.$password.time());
            db_update_secret_key($db,$key,$login,$password);
            setcookie('SESSION',$key);
            header('Location: index.php');
        }
    }
    unset($_POST['login'],$_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/icon2407.png" type="image/png">
    <link rel="stylesheet" href="/styles/reset.css" type="text/css">
    <link rel="stylesheet" href="/styles/login.css" type="text/css">
    <title>Auth page</title>
</head>
<body id="bg">
<div id="formparent">
    <div id="form">
        <form action="" method="post">
            <div id="subform">
                <div id="text">Auth 0.1</div>
                <p>
                    <input type="text" name="login" id="loginp" placeholder="Login" class="b1">
                    <label  for="manufacturer" class="label1">*Enter login</label>
                </p>
                <p>
                    <input type="text" name="password" id="passinp" placeholder="Password" class="b1">
                    <label class="label2" for="model">*Password required</label>
                </p>
                <button type="submit" id="confirm-button">Login</button>
            </div>
        </form>
        <div class="footer">Powered by qavan</div>
    </div>
</div>
</body>
</html>
<?php
mysqli_close($db);
?>