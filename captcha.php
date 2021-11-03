<?php
session_start();
$random_number = rand(11111, 99999);
$_SESSION['CODE'] = $random_number;
$layer = imagecreatetruecolor(60, 30);
$captcha_bg = imagecolorallocate($layer, 147, 71, 66);
imagefill($layer, 0, 0, $captcha_bg);
$captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
imagestring($layer, 5, 5, 5, $random_number, $captcha_text_color);
header('Content-Type:image/jpeg');
imagejpeg($layer);
?>