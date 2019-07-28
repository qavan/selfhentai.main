<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (!empty(db_session_check($db, $_COOKIE['SESSION']))) {
        header('Location:index.php');
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/icon2407.png" type="image/png">
    <link rel="stylesheet" href="/styles/reset.css" type="text/css">
    <link rel="stylesheet" href="/styles/register.css?v=2" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/register.js?v=2"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto|Roboto+Slab|Rubik&display=swap" rel="stylesheet">
    <title>Регистрация</title>
</head>
<body class="backGround">
<div class="gigaForm">
    <div class="middleForm">
        <form action="" method="post">
            <div class="microForm">
                <div class="regText">Регистрация</div>
                <p>
                    <input type="text" name="login" id="login" placeholder="Логин длиною от 5 до 32 букв и цифр" pattern="[a-zA-Z]+[a-zA-Z0-9]{4,32}" required>
                    <label class="loginLabel placeLabel" for="login">*Введите логин</label>
                    <label class="loginLabel filledInput" for="login">Логин:</label>
                </p>
                <p>
                    <input type="password" name="password" id="password" placeholder="Пароль длиною от 6 до 32 букв и цифр" pattern="[a-zA-Z0-9]{6,32}" required>
                    <label class="passwordLabel placeLabel" for="password">*Введите пароль</label>
                    <label class="passwordLabel filledInput" for="password">Пароль:</label>
                </p>
                <p>
                    <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Повторите пароль" pattern="[a-zA-Z0-9]{6,32}" required>
                    <label class="passwordRepeatLabel placeLabel" for="passwordRepeat">*Введите пароль ещё раз</label>
                    <label class="passwordRepeatLabel filledInput" for="passwordRepeat">Повтор пароля:</label>
                </p>
                <p>
                    <input type="email" name="email" id="email" placeholder="myemail@youremail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required>
                    <label class="emailLabel placeLabel" for="email">*Введите электронную почту</label>
                    <label class="emailLabel filledInput" for="email">Электронная почта:</label>
                </p>
                <p>
                    <input type="email" name="emailRepeat" id="emailRepeat" placeholder="myemail@youremail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required>
                    <label class="emailRepeatLabel placeLabel" for="emailRepeat">*Введите электронную почту ещё раз</label>
                    <label class="emailRepeatLabel filledInput" for="emailRepeat">Повтор электронной почты:</label>
                </p>
                <button type="submit" class="register-button" >Зарегистрироваться</button>
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