<?php
session_start();

// Generate a random CAPTCHA code (you can customize the length and characters)
$captchaCode = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

// Store the CAPTCHA code in the session for validation
$_SESSION['captcha_code'] = $captchaCode;

// Set the content type to PNG image
header('Content-Type: image/png');

// Create a blank image with a white background
$image = imagecreatetruecolor(100, 40);
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

// Add the CAPTCHA text to the image
$textColor = imagecolorallocate($image, 0, 0, 0);
imagettftext($image, 20, 0, 10, 30, $textColor, 'path/to/your/font.ttf', $captchaCode); // Specify the path to a TrueType font file

// Output the image as PNG
imagepng($image);

// Clean up the image resources
imagedestroy($image);
?>
