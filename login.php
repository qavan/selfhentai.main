<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
require_once 'engine/reCAPTCHA.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
    $check_result=ishuman($_POST['recaptcha_response']);
    if ($check_result===0) {
        header('Location: login.php?error=0');
    } else {
        header('Location: login.php?error=-1');}} #reCAPTCHA v3 check
else if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    if (strlen($_POST['login']) > 1 and strlen($_POST['password']) > 1) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (db_login($db, $login, $password)) {
            $key = md5($_SERVER['REMOTE_ADDR'])."$".md5($_SERVER['REMOTE_ADDR'].$login.time().$password);
            db_update_secret_key($db,$key,$login,$password);
            setcookie('SESSION',$key);
            header('Location: index.php');
        }
        else {
            header('Location: login.php?error=1');
        }
    }
} #authorization
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/16.jpg" type="image/jpg">
    <link rel="stylesheet" href="/styles/reset.scss" type="text/css">
    <link rel="stylesheet" href="/styles/login.css?v=3" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto|Roboto+Slab|Rubik&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Alegreya+Sans:800&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=6LeUY7QUAAAAANDvTK8peaGgh-mtMy_Q-2JfODb8"></script>
    <script>grecaptcha.ready(function(){grecaptcha.execute('6LeUY7QUAAAAANDvTK8peaGgh-mtMy_Q-2JfODb8',{action: 'homepage'}).then(function(token){var recaptchaResponse=document.getElementById('recaptchaResponse');recaptchaResponse.value=token;});});</script>
    <title>Вход</title>
</head>
<body class="bg">
<div class="gigaForm">
    <div class="middleForm">
        <form action="login.php" method="post">
            <div class="microForm">
                <div class="logText">Вход</div>
                <p>
                    <input type="text" name="login" id="login" placeholder="Логин" class="b1"  pattern="^[a-zA-Z]+[a-zA-Z0-9]{4,32}" required>
                    <label class="loginLabel placeLabel" for="login">*Введите логин</label>
                    <label class="loginLabel filledInput" for="login" id="first_warn_label">Логин:</label>
                </p>
                <p>
                    <input type="password" name="password" id="password" placeholder="Пароль" class="b1" pattern="^[a-zA-Z0-9]{6,32}" required>
                    <label class="passwordLabel placeLabel" for="password">*Введите пароль</label>
                    <label class="passwordLabel filledInput" for="password" id="second_warn_label">Пароль:</label>
                    <?php  if (isset($_GET['error'])) {
                            if ($_GET['error']==='0')
                                {echo '<label class="errorLabel" for="password" style="color:#24c93c;left:90px;">Успешный вход!</label>';}
                            else if ($_GET['error']==='1')
                                {echo '<label class="errorLabel" for="password">Неправильный логин/пароль!</label>';}
                            else if ($_GET['error']==='-1')
                                {echo '<label class="errorLabel" for="password" style="left:33px;">Your reCAPTCHA check failed!</label>';}} #error labels
                    ?>
                </p>
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                <button type="submit" class="login-button" onclick="check()">Войти</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php
mysqli_close($db);
?>