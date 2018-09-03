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
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Registration form -->
            <?= form_open("auth/login", 'class="flex-fill"'); ?>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Create account</h5>
                                <span class="d-block text-muted">All fields are required</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>First name <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($first_name); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Last name <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($last_name); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($email); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-address-book2 text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Phone <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($phone); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-phone text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Password <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($password); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Confirm Password <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($password_confirm); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Organization <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($organization); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-briefcase text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback-left">
                                <div class="checkbox">
                                    <label class="form-check-label">
                                        <?= form_checkbox('accept_terms', '1', FALSE, 'class="form-input-styled"'); ?>
                                        Accept <a href="#">terms of service</a>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i
                                            class="icon-plus3"></i></b> Create account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
            <!-- /registration form -->
        </div>
        <!-- /content area -->

        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                        data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2016 - <?= date('Y') ?>. <a href="#">Afyadata</a>
					</span>
            </div>
        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
