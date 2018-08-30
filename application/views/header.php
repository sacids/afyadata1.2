<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Afyadata - <?= isset($title) ? $title : "Taarifa kwa Wakati!" ?></title>

    <!-- Global stylesheets
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">-->

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
    <link href="<?= base_url('global_assets/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
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
    <script src="<?= base_url('global_assets/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('global_assets/js/plugins/forms/selects/select2.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('global_assets/js/demo_pages/datatables_basic.js') ?>"></script>
    <script src="<?= base_url('global_assets/js/demo_pages/form_select2.js') ?>"></script>
    <!-- /theme JS files -->
</head>

<body>
<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-light navbar-static">

    <!-- Header with logos -->
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="index.html" class="d-inline-block">
                <img src="<?= base_url('global_assets/images/logo_light.png') ?>" alt="">
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs">
            <a href="index.html" class="d-inline-block">
                <img src="<?= base_url('global_assets/images/logo_icon_light.png') ?>" alt="">
            </a>
        </div>
    </div>
    <!-- /header with logos -->


    <!-- Mobile controls -->
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="index.html" class="d-inline-block">
                <img src="<?= base_url('global_assets/images/logo_dark.png') ?>" alt="">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <!-- /mobile controls -->


    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-people"></i>
                    <span class="d-md-none ml-2">Users</span>
                    <span class="badge badge-mark border-pink-400 ml-auto ml-md-0"></span>
                </a>

                <div class="dropdown-menu dropdown-content wmin-md-300">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Users online</span>
                        <a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3">
                                    <img src="<?= base_url('') ?>global_assets/images/demo/users/face18.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Jordana Ansley</a>
                                    <span class="d-block text-muted font-size-sm">Lead web developer</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                            class="badge badge-mark border-success"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="<?= base_url('global_assets/images/demo/users/face24.jpg') ?>" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Will Brason</a>
                                    <span class="d-block text-muted font-size-sm">Marketing manager</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-danger"></span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="<?= base_url('global_assets/images/demo/users/face17.jpg') ?>" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Hanna Walden</a>
                                    <span class="d-block text-muted font-size-sm">Project manager</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                            class="badge badge-mark border-success"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="<?= base_url('global_assets/images/demo/users/face19.jpg') ?>" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Dori Laperriere</a>
                                    <span class="d-block text-muted font-size-sm">Business developer</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                            class="badge badge-mark border-warning-300"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="<?= base_url('global_assets/images/demo/users/face16.jpg') ?>" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Vanessa Aurelius</a>
                                    <span class="d-block text-muted font-size-sm">UX expert</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                            class="badge badge-mark border-grey-400"></span></div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-light">
                        <a href="#" class="text-grey mr-auto">All users</a>
                        <a href="#" class="text-grey"><i class="icon-gear"></i></a>
                    </div>
                </div>
            </li>
        </ul>

        <span class="navbar-text ml-md-3 mr-md-auto"></span>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url('global_assets/images/lang/gb.png') ?>" class="img-flag mr-2" alt="">
                    English
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item english active"><img
                                src="<?= base_url('global_assets/images/lang/gb.png') ?>" class="img-flag" alt="">
                        English</a>
                    <a href="#" class="dropdown-item swahili"><img
                                src="<?= base_url('global_assets/images/lang/gb.png') ?>" class="img-flag" alt="">
                        Swahili</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="d-md-none ml-2">Messages</span>
                    <span class="badge badge-mark border-pink-400 ml-auto ml-md-0"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Messages</span>
                        <a href="#" class="text-default"><i class="icon-compose"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="<?= base_url('global_assets/images/demo/users/face10.jpg') ?>" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">James Alexander</span>
                                            <span class="text-muted float-right font-size-sm">04:58</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-light">
                        <a href="#" class="text-grey mr-auto">All messages</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url('global_assets/images/demo/users/face11.jpg') ?>" class="rounded-circle"
                         alt="">
                    <span>Victoria</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
                    <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span
                                class="badge badge-pill bg-indigo-400 ml-auto">58</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
    <!-- /navbar content -->

</div>
<!-- /main navbar -->
