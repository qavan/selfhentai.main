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
};
function db_login($db,$log,$pass) {
    $query = "SELECT `login`,`password` FROM `users` WHERE `login`=\"$log\" AND `password`=\"".md5($pass)."\"";
    $data = mysqli_fetch_array(mysqli_query($db,$query));
    if (!empty($data)) {
        $id = mysqli_fetch_array(mysqli_query($db, "SELECT `id` FROM `users` WHERE `login`=\"$log\""))['id'];
        $query = "INSERT INTO `users_log`(`user_id`, `log_ip`, `log_date`) VALUES (\"$id\",\"" . $_SERVER['REMOTE_ADDR'] . "\",now())";
        mysqli_query($db, $query);
        return True;
    };
    return False;
};
function db_register($db,$log,$pass,$email) {
    $query = "INSERT INTO `users`(`login`, `password`, `email`) VALUES (\"$log\",\"".md5($pass)."\",\"$email\")";//,\"user\",\"".date ("Y-m-d H:i:s", time())."\")";
    mysqli_query($db,$query);
    $id = mysqli_fetch_array(mysqli_query($db,"SELECT `id` FROM `users` WHERE `login`=\"$log\""))['id'];
    $query = "INSERT INTO `users_reg`(`user_id`, `reg_ip`, `reg_date`) VALUES (\"$id\",\"".$_SERVER['REMOTE_ADDR']."\",now())";
    mysqli_query($db,$query);
};
function db_update_secret_key($db,$key,$log,$pass) {
    $query = "UPDATE `users` SET `secret_key`=\"$key\" WHERE `login`=\"$log\" AND `password`=\"".md5($pass)."\"";
    mysqli_query($db,$query);
};
function db_session_check($db,$key) {
    $query = "SELECT `secret_key` FROM `users` WHERE `secret_key`=\"$key\"";
    return (!empty(mysqli_fetch_array(mysqli_query($db,$query))));
};
?>