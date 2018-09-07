<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Registration form -->
            <?= form_open("auth/register", 'class="flex-fill"'); ?>

            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Create account</h5>
                                <span class="d-block text-muted">All fields are required</span>
                            </div>

                            <?php if ($this->session->flashdata('message') != "") {
                                echo $this->session->flashdata('message');
                            } ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>First name <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($first_name); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text text-danger"><?= form_error('first_name') ?></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Last name <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($last_name); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text text-danger"><?= form_error('last_name') ?></span>
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
                                        <span class="form-text text-danger"><?= form_error('email') ?></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Phone <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($phone); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-phone text-muted"></i>
                                        </div>
                                        <span class="form-text text-danger"><?= form_error('phone') ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Username <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($identity); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                        <span class="form-text text-danger"><?= form_error('identity') ?></span>
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
                                        <span class="form-text text-danger"><?= form_error('password') ?></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Confirm Password <span style="color: red;">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <?= form_input($password_confirm); ?>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                        <span class="form-text text-danger"><?= form_error('password_confirm') ?></span>
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
                                        <span class="form-text text-danger"><?= form_error('organization') ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback-left">
                                <div class="checkbox">
                                    <label class="form-check-label">
                                        <?= form_checkbox('accept_terms', set_checkbox('accept_terms', 1), TRUE, 'class="form-input-styled"'); ?>
                                        Accept <a href="#">terms of service</a>
                                    </label>
                                </div>
                                <span class="form-text text-danger"><?= form_error('accept_terms') ?></span>
                            </div>

                            <?= form_hidden('group_id[]', 3) ?>

                            <button type="submit" class="btn bg-maroon btn-labeled btn-labeled-right"><b><i
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