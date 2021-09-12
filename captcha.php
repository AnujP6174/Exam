<?php
    session_start();
    $random_number=rand(11111,99999);
    $_SESSION['CODE']=$random_number;
    $layer=imagecreatetruecolor(70,30);
    $captcha_bg=imagecolorallocate($layer,255,160,120);
    imagefill($layer,0,0,$captcha_bg);
    $captcha_text_color=imagecolorallocate($layer,0,0,0);
    imagestring($layer,5,5,5,$random_number,$captcha_text_color);
    header('Content-Type:image/jpeg');
    imagejpeg($layer);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

<body>

</body>

</html>