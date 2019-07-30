<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (db_session_check($db, $_COOKIE['SESSION'])) {
        header('Location:index.php');
        die;
    }
}
else {
    $loginPattern = "/[a-zA-Z][a-zA-Z0-9]{4,32}/";
    $passwordPattern = "/[a-zA-Z0-9]{7,32}/";
    $emailPattern = "/[a-z0-9._%+-].*\@[a-z0-9.-].*\.[a-z]{2,4}/";
    if (  isset($_POST['login'],$_POST['password'],$_POST['passwordRepeat'],$_POST['email'],$_POST['emailRepeat']) ) {
        if ( $_POST['password']!=$_POST['passwordRepeat'] ) {
            header('Location:register.php?errorState=0;');//Пароли не совпадают
        }
        elseif ( $_POST['email']!=$_POST['emailRepeat'] ) {
            header('Location:register.php?errorState=1');//Почты не совпадают
        }
        elseif (!(bool) preg_match($loginPattern,$_POST['login'])) {
            header('Location:register.php?errorState=2');//Недопустимый формат логина
        }
        elseif (!(bool) preg_match($passwordPattern,$_POST['password'])) {
            header('Location:register.php?errorState=3');//Недопустимый формат пароля
        }
        elseif (!(bool) preg_match($emailPattern,$_POST['email']) and strlen($_POST['email'])<=254 ) {
            header('Location:register.php?errorState=4');//Недопустимый формат почты
        }
        else {
            db_register($db,$_POST['login'],$_POST['password'],$_POST['email']);
            echo 'Успешная регистрация!';
            die;
        }
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
    <link rel="stylesheet" href="/styles/register.css?v=4" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/register.js?v=3"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Alegreya+Sans:800&display=swap" rel="stylesheet">
    <title>Регистрация</title>
</head>
<body class="backGround">
<div class="gigaForm">
    <div class="formBorder">
        <div class="middleForm">
            <form action="register.php" method="post">
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
                        <?php
                        if (isset($_GET['errorState'])) {
                            if ($_GET['errorState']==0) {
                                $errStr = "Введенные пароли не совпадают!";
                            }
                            elseif ($_GET['errorState']==1) {
                                $errStr = "Введенные почты не совпадают!";
                            }
                            elseif ($_GET['errorState']==2) {
                                $errStr = "Недопустимый формат логина!";
                            }
                            elseif ($_GET['errorState']==3) {
                                $errStr = "Недопустимый формат пароля!";
                            }
                            elseif ($_GET['errorState']==4) {
                                $errStr = "Недопустимый формат почты!";
                            };
                            echo "<label class='errorLabel' for='emailRepeat'>$errStr</label>";
                        };
                        ?>
                    </p>
                    <button type="submit" class="register-button" >Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
mysqli_close($db);
?>