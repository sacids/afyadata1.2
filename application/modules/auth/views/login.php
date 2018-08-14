<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Afyadata - Login</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="<?= base_url('global_assets/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap.min.css" rel="stylesheet') ?>" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap_limitless.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/layout.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/components.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/colors.min.css') ?>" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

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
            <img src="<?= base_url('global_assets/images/logo_light.png') ?>" alt="">
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

            <!-- Login form -->
            <?= form_open("auth/login", 'class="login-form"'); ?>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Login to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <?php if ($message != "") {
                        echo '<div class="alert alert-danger">' . $message . '</div>';
                    } ?>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <?= form_input($identity); ?>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <?= form_input($password); ?>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <div class="checkbox">
                            <?= lang('login_remember_label', 'remember'); ?>
                            <?= form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><?= lang('login_submit_btn') ?> <i
                                    class="icon-circle-right2 ml-2"></i></button>
                    </div>

                    <div class="text-center">
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
            <!-- /login form -->
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
