<?php
error_reporting(-1);
function ishuman($calledvalue) {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LeUY7QUAAAAAHBKppKz63u6yoqlydxZm_kAXn8U';
    $recaptcha_response = $calledvalue;
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    if ($recaptcha->score >= 0.5) {
        return 0;}
    return -1;}
?>