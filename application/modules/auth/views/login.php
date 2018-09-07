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
                        <button type="submit" class="btn btn-maroon btn-block"><?= lang('login_submit_btn') ?> <i
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