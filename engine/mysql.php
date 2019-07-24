<?php
require_once 'db_params.php';
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase);
if (!$db) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_close($db);
?>