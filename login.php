<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
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
    <link rel="stylesheet" href="/styles/login.css?v=2" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
<!--    <script type="text/javascript" src="js/login.js"></script>-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto|Roboto+Slab|Rubik&display=swap" rel="stylesheet">
    <title>Вход в систему</title>
</head>
<body class="bg">
<div class="gigaForm">
    <div class="middleForm">
        <form action="" method="post">
            <div class="microForm">
                <div class="logText">Логин</div>
                <p>
                    <input type="text" name="login" id="login" placeholder="Логин" class="b1"  pattern="[a-zA-Z]+[a-zA-Z0-9]{4,32}" required>
                    <label class="loginLabel placeLabel" for="login">*Введите логин</label>
                    <label class="loginLabel filledInput" for="login">Логин:</label>
                </p>
                <p>
                    <input type="password" name="password" id="password" placeholder="Пароль" class="b1" pattern="[a-zA-Z0-9]{6,32}" required>
                    <label class="passwordLabel placeLabel" for="password">*Введите пароль</label>
                    <label class="passwordLabel filledInput" for="password">Пароль:</label>
                </p>
                <button type="submit" class="login-button">Войти</button>
            </div>
        </form>
<!--        <div class="footer">Powered by qavan</div>-->
    </div>
</div>
</body>
</html>
<?php
mysqli_close($db);
?>