<?php
error_reporting(-1);
require_once 'db_params.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase);
if (!$db) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
function db_login_check($db,$log,$pass) {
    $query = "SELECT login,password FROM test_users WHERE login=\"$log\" AND password=\"$pass\"";
    return mysqli_fetch_array(mysqli_query($db,$query)); //or trigger_error(mysqli_error($db)." in ". $query);
};
function db_update_secret_key($db,$key,$log,$pass) {
    $query = "UPDATE `test_users` SET `secret_key`=\"$key\" WHERE `login`=\"$log\" AND `password`=\"$pass\"";
    mysqli_query($db,$query);
};
function db_session_check($db,$key) {
    $query = "SELECT secret_key FROM test_users WHERE secret_key=\"$key\"";
    return mysqli_fetch_array(mysqli_query($db,$query));
}
?>