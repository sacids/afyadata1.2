<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Afyadata - Create Account</title>

    <!-- Global stylesheets
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">-->

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
    <link href="<?= base_url('global_assets/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('global_assets/css/icons/fontawesome/styles.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap.min.css" rel="stylesheet') ?>" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap_limitless.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/layout.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/components.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/colors.min.css') ?>" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom.css') ?>"/>

    <!-- Core JS files -->
    <script src="<?= base_url('global_assets/js/main/jquery.min.js') ?>"></script>
    <script src="<?= base_url('global_assets/js/main/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('global_assets/js/plugins/loaders/blockui.min.js') ?>"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="#" class="d-inline-block">
            <img src="<?= base_url('assets/img/logo_white.png') ?>" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
    </div>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="" class="navbar-nav-link">About AfyaData</a></li>
            <li class="nav-item"><a href="" class="navbar-nav-link">Features</a></li>
            <li class="nav-item"><a href="" class="navbar-nav-link">How it Works</a></li>
            <li class="nav-item"><a href="" class="navbar-nav-link">Help</a></li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="<?= site_url('auth/register') ?>" class="navbar-nav-link bg-maroon"><i
                        class="fa fa-user-plus"></i> Sign Up</a></li>
            <li class="nav-item"><a href="<?= site_url('auth/login') ?>" class="navbar-nav-link bg-orange"><i
                        class="fa fa-sign-in"></i> Sign In</a></li>
        </ul>
    </div>
    <!-- /navbar content -->
</div>
<!-- /main navbar -->