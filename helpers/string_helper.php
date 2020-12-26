<?php

/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

/**
 * generate Random string
 * @param integer $length
 * @return string
 */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * display and die
 * @param [var or object or array] $var
 */
function dd($var)
{
    var_dump($var);
    die();
}

/**
 * view array content
 *
 * @param [array] $var
 * @return void
 */
function pr($var)
{
    echo "<pre class='text-left ltr'>";
    print_r($var);
    echo "</pre>";
}

/**
 * Sending SMS message
 *
 * @param [type] $username
 * @param [type] $password
 * @param [type] $messageContent
 * @param [type] $mobileNumber
 * @param [type] $sendername
 * @param [type] $server
 * @param string $return
 * @return void
 */
function sendSMS($username, $password, $messageContent, $mobileNumber, $sendername, $server, $return = 'json')
{
    // built url
    $post = 'username=' . urlencode($username) . '&password=' . urlencode($password) . '&numbers=' . urlencode($mobileNumber)
        . '&message=' . urlencode($messageContent) . '&sender=' . urlencode($sendername) . '&unicode=E&return=' . urlencode($return);
    //open connection
    $ch = curl_init();
    // API URL     
    curl_setopt($ch, CURLOPT_URL, $server);
    //Sending through $_POST request    
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // excution    
    $respond = curl_exec($ch);
    // close connection    
    curl_close($ch);
    //using the return as a PHP array
    return json_decode($respond);
}

/**
 * repeat string using seprator with incrising value
 *
 * @param string $var
 * @param integer $count
 * @param string $seprator
 * @return string
 */
function strIncRepeat($var, $count, $seprator = ',')
{
    $text = '';
    for ($i = 0; $i < $count; $i++) {
        $text .= $var . $i . $seprator;
    }
    return rtrim($text, ',');
}

/**
 * print variable if exist
 *
 * @param string $var
 * @return void
 */
function printIsset($var)
{
    if (isset($var)) {
        echo $var;
    } else {
        return false;
    }
}

/**
 * print variable if exist
 *
 * @param string $var
 * @return void
 */
function returnIsset($var)
{
    if (isset($var)) {
        return $var;
    } else {
        return false;
    }
}
/**
 * clean Search Var
 *
 * @param string $var
 * @return string
 */
function cleanSearchVar($var)
{
    if (isset($_SESSION['search']['bind'][":$var"])) {
        return str_replace('%', '', $_SESSION['search']['bind'][":$var"]);
    }
}


function imgWrite($source, $text, $outputPath, $x = 800, $y = 800)
{
    // header('Content-type: image/jpeg');
    $is_arabic = preg_match('/\p{Arabic}/u', $text);
    if ($is_arabic) {
        require_once(APPROOT . '/helpers/arabic/Arabic.php');
        $Arabic = new I18N_Arabic('Glyphs');

        $text = $Arabic->utf8Glyphs($text);

        // Set Path to Font File
        $font_path = APPROOT . '/public/templates/default/css/fonts/Droid.ttf';
    } else {

        $font_path = APPROOT . '/public/templates/default/css/fonts/cairo.ttf';
    }

    // Create Image From Existing File
    $jpg_image = imagecreatefromjpeg($source);

    // Allocate A Color For The Text
    $white = imagecolorallocate($jpg_image, 255, 255, 255);
    $black = imagecolorallocate($jpg_image, 0, 0, 0);

    if (imagettftext($jpg_image, 12, 0, $x, $y, $black, $font_path, $text)) {

        // Send Image to Browser
        imagejpeg($jpg_image, $outputPath);

        // Clear Memory
        imagedestroy($jpg_image);
        return $outputPath;
    }
}
