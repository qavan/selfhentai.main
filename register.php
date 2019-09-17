<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
require_once 'engine/https.php';
require_once 'engine/mysql.php';
require_once 'engine/reCAPTCHA.php';
if (isset($_COOKIE['SESSION']) and !empty($_COOKIE['SESSION'])) {
    if (db_session_check($db, $_COOKIE['SESSION'])) {
        header('Location:index.php');
        die;
    }
}
//else {
//    echo '<html lang="en"><head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="shortcut icon" href="/images/16.jpg" type="image/jpg"> <link rel="stylesheet" href="/styles/error-reset.css" type="text/css"> <link rel="stylesheet" href="/styles/error.css?v=4" type="text/css"> <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow&display=swap" rel="stylesheet"> <title>Регистрация</title></head><body class="backGround" style="background: #484848;"><div class="gigaForm"> <div class="errorGif"><div class="errorLabel">Регистрация отключена!<br>Registration disabled!</div></div></div></body></html>';
//    die;
//}
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['login']) ) {
    $check_result=ishuman($_POST['recaptcha_response']);
    if ($check_result===0) {
        $loginPattern = "/[a-zA-Z][a-zA-Z0-9]{4,32}/";
        $passwordPattern = "/[a-zA-Z0-9]{7,32}/";
        $emailPattern = "/[a-z0-9._%+-].*\@[a-z0-9.-].*\.[a-z]{2,4}/";
        if (isset($_POST['password'],$_POST['passwordRepeat'], $_POST['email'], $_POST['emailRepeat'])) {
            if ($_POST['password'] != $_POST['passwordRepeat']) {
                header('Location:register.php?errorState=0;');//Пароли не совпадают
            } elseif ($_POST['email'] != $_POST['emailRepeat']) {
                header('Location:register.php?errorState=1');//Почты не совпадают
            } elseif (!(bool)preg_match($loginPattern, $_POST['login'])) {
                header('Location:register.php?errorState=2');//Недопустимый формат логина
            } elseif (!(bool)preg_match($passwordPattern, $_POST['password'])) {
                header('Location:register.php?errorState=3');//Недопустимый формат пароля
            } elseif (!(bool)preg_match($emailPattern, $_POST['email']) and strlen($_POST['email']) <= 254) {
                header('Location:register.php?errorState=4');//Недопустимый формат почты
            } else {
                if (db_check_nickname_email($db,$_POST['login'],$_POST['email'])==False) {
                    db_register($db, $_POST['login'], $_POST['password'], $_POST['email']);
                    header('Location: register.php?success=1');
                }
                else {
                    header('Location: register.php?errorState=6');
                }
            }
        }
        else {
            header('Location: register.php?errorState=5');
        }
    }
    else {
        header('Location: register.php?errorState=-1');
    }
};
if (isset($_GET['success']) && $_GET['success']==1) {
    echo '<html lang="en"><head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="shortcut icon" href="/images/16.jpg" type="image/jpg"> <link rel="stylesheet" href="/styles/error-reset.css" type="text/css"> <link rel="stylesheet" href="/styles/error.css?v=4" type="text/css"> <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow&display=swap" rel="stylesheet"> <title>Регистрация</title></head><body class="backGround" style="background: #484848;"><div class="gigaForm"> <div class="errorGif"><div class="errorLabel">Вы успешно зарегистрировались.<br>Идет перенаправление  на страницу авторизации.</div></div></div></body></html>';
    header('refresh:5;url="http://selfhentai.ru/login.php";');
    mysqli_close($db);
    die;
}
//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/16.jpg" type="image/jpg">
    <link rel="stylesheet" href="/styles/reset.scss" type="text/css">
    <link rel="stylesheet" href="/styles/register.css?v=4" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/register.js?v=3"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Alegreya+Sans:800&display=swap" rel="stylesheet">
    <?php require_once 'engine/reCAPTCHA_site.php'; ?>
    <title>Регистрация</title>
</head>
<body class="bg">
<div class="gigaForm">
    <div class="formBorder">
        <div class="middleForm">
            <form action="register.php" method="post">
                <div class="microForm">
                    <div class="regText">Регистрация</div>
                    <p>
                        <input type="text" name="login" id="login" placeholder="Логин длиною от 5 до 32 букв и цифр" pattern="[a-zA-Z]+[a-zA-Z0-9]{4,32}" required>
                        <label class="loginLabel placeLabel" for="login">*Введите логин</label>
                        <label class="loginLabel filledInput" for="login" id="first_warn_label">Логин:</label>
                    </p>
                    <p>
                        <input type="password" name="password" id="password" placeholder="Пароль длиною от 6 до 32 букв и цифр" pattern="[a-zA-Z0-9]{6,32}" required>
                        <label class="passwordLabel placeLabel" for="password">*Введите пароль</label>
                        <label class="passwordLabel filledInput" for="password" id="second_warn_label_0">Пароль:</label>
                    </p>
                    <p>
                        <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Повторите пароль" pattern="[a-zA-Z0-9]{6,32}" required>
                        <label class="passwordRepeatLabel placeLabel" for="passwordRepeat">*Введите пароль ещё раз</label>
                        <label class="passwordRepeatLabel filledInput" for="passwordRepeat" id="second_warn_label_1">Повтор пароля:</label>
                    </p>
                    <p>
                        <input type="email" name="email" id="email" placeholder="myemail@youremail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required>
                        <label class="emailLabel placeLabel" for="email">*Введите электронную почту</label>
                        <label class="emailLabel filledInput" for="email" id="third_warn_label_0">Электронная почта:</label>
                    </p>
                    <p>
                        <input type="email" name="emailRepeat" id="emailRepeat" placeholder="myemail@youremail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required>
                        <label class="emailRepeatLabel placeLabel" for="emailRepeat">*Введите электронную почту ещё раз</label>
                        <label class="emailRepeatLabel filledInput" for="emailRepeat" id="third_warn_label_1">Повтор электронной почты:</label>
                    </p>
                        <?php
                        if (isset($_GET['errorState'])) {
                            if ($_GET['errorState']==0) {
                                $errStr = "ОШИБКА: Пароли не совпадают!";
                            }
                            elseif ($_GET['errorState']==-1) {
                                $errStr = "ОШИБКА: CAPTCHA check fail!";
                            }
                            elseif ($_GET['errorState']==6) {
                                $errStr = "ОШИБКА: Логин/почта занят(ы)!";
                            }
                            elseif ($_GET['errorState']==1) {
                                $errStr = "ОШИБКА: Почты не совпадают!";
                            }
                            elseif ($_GET['errorState']==2) {
                                $errStr = "ОШИБКА: Недопустимый логин!";
                            }
                            elseif ($_GET['errorState']==3) {
                                $errStr = "ОШИБКА: Недопустимый пароль!";
                            }
                            elseif ($_GET['errorState']==4) {
                                $errStr = "ОШИБКА: Недопустимая почты!";
                            }
                            elseif ($_GET['errorState']==5) {
                                $errStr = "ОШИБКА: Поля не были заполнены!";
                            };
                            echo "<label class='errorLabel' for='emailRepeat'>$errStr</label>";
                        };
                        ?>
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse"">
                    <div class="goToRulesBlock codeStyle">Регистрируясь, вы принимаете <a href="rules.php">правила</a></div>
                    <button type="submit" class="register-button" onclick="check()">Зарегистрироваться</button>
                    <div class="captchaProtect codeStyle">Protected by Google ReCaptcha v3</div>
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