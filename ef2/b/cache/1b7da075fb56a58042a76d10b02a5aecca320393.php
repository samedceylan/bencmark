<?php

use EF2\Ef;

?>

<!DOCTYPE html>
<!-- Template by Quackit.com -->
<!-- Images by various sources under the Creative Commons CC0 license and/or the Creative Commons Zero license.
Although you can use them, for a more unique website, replace these images with your own. -->
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Business 2</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=EF::app()->baseUrl;?>/front/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="<?=EF::app()->baseUrl;?>/front/css/custom.css" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Logo and responsive toggle -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <span class="glyphicon glyphicon-fire"></span>
                LOGO
            </a>
        </div>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active">
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Products</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="about-us">
                        <li><a href="#">Engage</a></li>
                        <li><a href="#">Pontificate</a></li>
                        <li><a href="#">Synergize</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>

<!-- Header -->
<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Dramatically Engage</h1>
            <p>Objectively innovate empowered manufactured products whereas parallel platforms.</p>
            <a href="#" class="btn btn-primary btn-lg">Engage Now</a>
        </div>
    </div>
</header>

<!-- Intro Section -->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <span class="glyphicon glyphicon-apple" style="font-size: 60px"></span>
                <h2 class="section-heading">Completely synergize resource taxing relationships</h2>
                <p class="text-light">Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
            </div>
        </div>
    </div>
</section>

<!-- Content 1 -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img class="img-responsive img-circle center-block" src="<?=EF::app()->baseUrl;?>/front/images/microphone.jpg" alt="">
            </div>
            <div class="col-sm-6">
                <h2 class="section-header">Best in Class</h2>
                <p class="lead text-muted">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
                <a href="#" class="btn btn-primary btn-lg">Classify It</a>
            </div>

        </div>
    </div>
</section>

<!-- Content 2 -->
<section class="content content-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="section-header">Superior Quality</h2>
                <p class="lead text-light">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
                <a href="#" class="btn btn-default btn-lg">Test It</a>
            </div>
            <div class="col-sm-6">
                <img class="img-responsive img-circle center-block" src="<?=EF::app()->baseUrl;?>/front/images/iphone.jpg" alt="">
            </div>

        </div>
    </div>
</section>

<!-- Promos -->
<div class="container-fluid">
    <div class="row promo">
        <a href="#">
            <div class="col-md-4 promo-item item-1">
                <h3>
                    Unleash
                </h3>
            </div>
        </a>
        <a href="#">
            <div class="col-md-4 promo-item item-2">
                <h3>
                    Synergize
                </h3>
            </div>
        </a>

        <a href="#">
            <div class="col-md-4 promo-item item-3">
                <h3>
                    Procrastinate
                </h3>
            </div>
        </a>
    </div>
</div><!-- /.container-fluid -->



<?php echo $__env->yieldContent('content'); ?>


<!-- Footer -->
<footer class="page-footer">

    <!-- Contact Us -->
    <div class="contact">
        <div class="container">
            <h2 class="section-heading">Contact Us</h2>
            <p><span class="glyphicon glyphicon-earphone"></span><br> +1(23) 456 7890</p>
            <p><span class="glyphicon glyphicon-envelope"></span><br> info@example.com</p>
        </div>
    </div>

    <!-- Copyright etc -->
    <div class="small-print">
        <div class="container">
            <p>Copyright &copy; Example.com 2015</p>
        </div>
    </div>

</footer>

<!-- jQuery -->
<script src="<?=EF::app()->baseUrl;?>/front/js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=EF::app()->baseUrl;?>/front/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?=EF::app()->baseUrl;?>/front/js/jquery.easing.min.js"></script>

<!-- Custom Javascript -->
<script src="<?=EF::app()->baseUrl;?>/front/js/custom.js"></script>

</body>

</html>
