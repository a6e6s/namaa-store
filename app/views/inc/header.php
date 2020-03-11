<!DOCTYPE html>
<html lang="ar" dir="rtl">
<!--
Copyright (C) 2020 Easy CMS Framework Ahmed Elmahdy

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License
@license    https://opensource.org/licenses/GPL-3.0

@package    Easy CMS MVC framework
@author     Ahmed Elmahdy
@link       https://ahmedx.com

For more information about the author , see <http://www.ahmedx.com/>.
-->

<head>
    <!-- Primary Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="keywords" content="<?php echo $this->meta->keywords; ?>">
    <meta name="title" content="<?php echo $this->meta->title; ?>">
    <meta name="description" content="<?php echo $this->meta->description; ?>">
    <meta name="author" content="Ahmed Elmahdy">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    <meta property="og:title" content="<?php echo $this->meta->title; ?>">
    <meta property="og:description" content="<?php echo $this->meta->description; ?>">
    <meta property="og:image" content="<?php echo $this->meta->image; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    <meta property="twitter:title" content="<?php echo $this->meta->title; ?>">
    <meta property="twitter:description" content="<?php echo $this->meta->description; ?>">
    <meta property="twitter:image" content="<?php echo $this->meta->image; ?>">

    <?php echo $this->meta->headerCode; ?>
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/templates/default/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo URLROOT; ?>/templates/default/images/favicon.ico" type="image/x-icon">
    <title><?php echo ($data['pageTitle']) ?? SITENAME; ?></title>
    <!--- Bootstrap 4  --->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/templates/default/css/bootstrap.min.css">
    <!--- Icofont file --->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/templates/default/css/icofont.min.css">

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/templates/default/vendors/owlcarousel/assets/owl.carousel.min.css">
    <!--- Google fonts -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/templates/default/css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <!--- CSS style --->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/templates/default/css/style.css">
</head>

<body style="background:<?php echo $this->meta->background; ?>;">
    <div class="preloader text-center">
        <div class="text-center">
            <img src="<?php echo URLROOT; ?>/templates/default/images/icon.gif" alt="">
        </div>
    </div>
    <div class="container">
        <section class="row py-2" id="top-bar">
            <div class="col-2 col-md-1 pt-2">
                <nav class="navbar navbar-light main-menu">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler" aria-controls="navbar-toggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
            </div>
            <div class="col-5 col-md-7">
                <a href="<?php echo URLROOT; ?>" class="logo float-right">
                    <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-logo.png" height="60" alt="Namaa logo" class="img-fluid">
                </a>
            </div>
            <div class="col-5 col-md-4 pt-3">
                <div class="user float-left">
                    <div class="nav">
                        <li class="nav-item">
                            <a title="Profile" class="nav-link text-dark border-left border-dark" href="#"><i class="icofont-user"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#"> <i class="icofont-cart cart-icon "></i> <span class="d-none d-sm-inline">السلة (2) منتج</span> </a>
                        </li>
                    </div>
                </div>
            </div>
            <?php require APPROOT . '/app/views/inc/navbar.php'; ?>
        </section>
        <!--- carousel  Start --->