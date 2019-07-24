<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(-1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/icon2407.png" type="image/png">
    <link rel="stylesheet" href="/styles/reset.css" type="text/css">
    <link rel="stylesheet" href="/styles/login.css" type="text/css">
    <title>Pseudo Engine</title>
</head>
<body id="bg">
<div id="formparent">
    <div id="form">
        <form action="" method="post">
            <div id="subform">
                <div id="text">Balthazar</div>
                <p>
                    <input type="text" name="manufacturer" id="manufacturer" placeholder="Manufacturer" class="b1">
                    <label  for="manufacturer" class="label1">*Enter manufacturer name</label>
                </p>
                <p>
                    <input type="text" name="manufacturer" id="model" placeholder="Model" class="b1">
                    <label class="label2" for="model">*Model name required</label>
                </p>
                <button type="submit" id="confirm-button">Check it!</button>
            </div>
        </form>
        <div class="footer">Powered by qavan</div>
    </div>
</div>
</body>
</html>