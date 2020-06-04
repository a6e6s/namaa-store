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
 * handling file upload
 * @param string $field_name input upload name
 * @param string $path
 * @param int $max_size
 * @param boolen $check_image
 * @param boolen $random_name
 * @return array @example $out['filepath'], $out['error'], $out['filename']
 */
function uploadImage($field_name = null, $path = 'media/', $max_size = 5000000, $check_image = true, $random_name = true)
{

    //Config Section
    //Set max file size in bytes
    //Set default file extension whitelist
    $whitelist_ext = array('jpeg', 'jpg', 'png', 'gif', 'pdf');
    //Set default file type whitelist
    $whitelist_type = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf');

    //The Validation
    // Create an array to hold any output
    $out['error'] = [];

    if (!$field_name) {
        $out['error'][] = "Please specify a valid form field name";
    }

    if (!$path) {
        $out['error'][] = "Please specify a valid upload path";
    }

    if (count($out['error']) > 0) {
        return $out;
    }

    //Make sure that there is a file
    if ((!empty($_FILES[$field_name])) && ($_FILES[$field_name]['error'] == 0)) {

        // Get filename
        $file_info = pathinfo($_FILES[$field_name]['name']);
        $name = $file_info['filename'];
        $ext = $file_info['extension'];

        //Check file has the right extension
        if (!in_array($ext, $whitelist_ext)) {
            $out['error'][] = "امتداد غير مدعوم";
        }

        //Check that the file is of the right type
        if (!in_array($_FILES[$field_name]["type"], $whitelist_type)) {
            $out['error'][] = "نوع الملف غير مدعوم";
        }

        //Check that the file is not too big
        if ($_FILES[$field_name]["size"] > $max_size) {
            $out['error'][] = "حجم الملف اكبر من اللازم";
        }

        //If $check image is set as true
        if ($check_image) {
            if (!getimagesize($_FILES[$field_name]['tmp_name'])) {
                $out['error'][] = "الملف المرفوع ليس صورة";
            }
        }

        //Create full filename including path
        // Generate random filename
        $tmp = '_' . substr(md5(mt_rand()), 0, 5);
        if ($random_name) {

            if (!$tmp || $tmp == '') {
                $out['error'][] = "File must have a name";
            }
            $newname = 'image' . $tmp . '.' . $ext;
            $storename = iconv('utf-8', 'windows-1256', str_replace('ی', 'ي', $newname));
        } else {
            if (file_exists($path . $name . '.' . $ext)) {
                $newname = $name . '_' . rand(1, 20) . '.' . $ext;

                $storename = iconv('utf-8', 'windows-1256', str_replace('ی', 'ي', $newname));
            } else {
                $newname = $name . '.' . $ext;

                $storename = iconv('utf-8', 'windows-1256', str_replace('ی', 'ي', $newname));
            }
        }

        //Check if file already exists on server
        if (file_exists($path . $newname)) {
            $out['error'][] = "A file with this name already exists";
        }

        if (count($out['error']) > 0) {
            //The file has not correctly validated
            return $out;
        }

        if (move_uploaded_file($_FILES[$field_name]['tmp_name'], $path . $storename)) {
            //creating thumbnail
            createThumbnail($path . $storename, $path . "../thumbs/" . $storename, 160);
            //Success
            $out['filepath'] = $path;
            $out['filename'] = $newname;
            $out['storename'] = $storename;
            return $out;
        } else {
            $out['error'][] = "Server Error!";
        }
    } else {
        $out['error']['nofile'] = "No file uploaded";
        return $out;
    }
}

// Link image type to correct image loader and saver
// - makes it easier to add additional types later on
// - makes the function easier to read
const IMAGE_HANDLERS = [
    IMAGETYPE_JPEG => [
        'load' => 'imagecreatefromjpeg',
        'save' => 'imagejpeg',
        'quality' => 100,
    ],
    IMAGETYPE_PNG => [
        'load' => 'imagecreatefrompng',
        'save' => 'imagepng',
        'quality' => 0,
    ],
    IMAGETYPE_GIF => [
        'load' => 'imagecreatefromgif',
        'save' => 'imagegif',
    ],
];

/**
 * @param $src - a valid file location
 * @param $dest - a valid file target
 * @param $targetWidth - desired output width
 * @param $targetHeight - desired output height or null
 */
function createThumbnail($src, $dest, $targetWidth, $targetHeight = null)
{

    // 1. Load the image from the given $src
    // - see if the file actually exists
    // - check if it's of a valid image type
    // - load the image resource

    // get the type of the image
    // we need the type to determine the correct loader
    if (!function_exists('exif_imagetype')) {
        function exif_imagetype($filename)
        {
            if ((list($width, $height, $type, $attr) = getimagesize($filename)) !== false) {
                return $type;
            }
            return false;
        }
    }
    $type = exif_imagetype($src);

    // if no valid type or no handler found -> exit
    if (!$type || !IMAGE_HANDLERS[$type]) {
        return null;
    }

    // load the image with the correct loader
    $image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);

    // no image found at supplied location -> exit
    if (!$image) {
        return null;
    }

    // 2. Create a thumbnail and resize the loaded $image
    // - get the image dimensions
    // - define the output size appropriately
    // - create a thumbnail based on that size
    // - set alpha transparency for GIFs and PNGs
    // - draw the final thumbnail

    // get original image width and height
    $width = imagesx($image);
    $height = imagesy($image);

    // maintain aspect ratio when no height set
    if ($targetHeight == null) {

        // get width to height ratio
        $ratio = $width / $height;

        // if is portrait
        // use ratio to scale height to fit in square
        if ($width > $height) {
            $targetHeight = floor($targetWidth / $ratio);
        }
        // if is landscape
        // use ratio to scale width to fit in square
        else {
            $targetHeight = $targetWidth;
            $targetWidth = floor($targetWidth * $ratio);
        }
    }

    // create duplicate image based on calculated target size
    $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

    // set transparency options for GIFs and PNGs
    if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {

        // make image transparent
        imagecolortransparent(
            $thumbnail,
            imagecolorallocate($thumbnail, 0, 0, 0)
        );

        // additional settings for PNGs
        if ($type == IMAGETYPE_PNG) {
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);
        }
    }

    // copy entire source image to duplicate image and resize
    imagecopyresampled(
        $thumbnail,
        $image,
        0,
        0,
        0,
        0,
        $targetWidth,
        $targetHeight,
        $width,
        $height
    );

    // 3. Save the $thumbnail to disk
    // - call the correct save method
    // - set the correct quality level

    // save the duplicate version of the image to disk
    return call_user_func(
        IMAGE_HANDLERS[$type]['save'],
        $thumbnail,
        $dest,
        IMAGE_HANDLERS[$type]['quality']
    );
}
