<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Edit User</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active"> Edit User</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <!-- Form inputs -->
        <div class="card">
            <div class="card-body">
                <?= form_open(uri_string(), 'role="form"'); ?>
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold"> Edit User</legend>

                    <?php if (validation_errors() != "") {
                        echo '<div class="alert alert-danger">' . validation_errors() . '</div>';
                    } else if ($this->session->flashdata('message') != "") {
                        echo $this->session->flashdata('message');
                    } ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First name <span style="color: red;">*</span></label>
                                        <?= form_input($first_name); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Last name <span style="color: red;">*</span></label>
                                        <?= form_input($last_name); ?>
                                    </div>
                                </div>
                            </div><!--./row -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email <span style="color: red;">*</span></label>
                                        <?= form_input($email); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone <span style="color: red;">*</span></label>
                                        <?= form_input($phone); ?>
                                    </div>
                                </div>
                            </div><!--./row -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Organization</label>
                                        <?= form_input($organization); ?>
                                    </div>
                                </div>
                            </div><!--./row -->


                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class="page-header">Login Credentials</h6>
                                </div>
                            </div> <!-- /.row -->

                            <div class="row">
                                <div class=" col-lg-6">
                                    <div class="form-group">&nbsp;
                                        <label>User Groups <span style="color: red;">*</span></label><br/>
                                        <?php foreach ($groups as $group) { ?>
                                            <?php
                                            $gID = $group['id'];
                                            $checked = null;
                                            $item = null;
                                            foreach ($currentGroups as $grp) {
                                                if ($gID == $grp->id) {
                                                    $checked = ' checked="checked"';
                                                    break;
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" name="groups[]"
                                                   value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                            <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>&nbsp;&nbsp;
                                        <?php } ?>
                                    </div>
                                </div><!--./col-lg-6 -->
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Username <span style="color: red;">*</span></label>
                                        <?= form_input($identity); ?>
                                    </div>
                                </div>
                            </div><!--./row -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Password <span style="color: red;">*</span></label>
                                        <?= form_password($password); ?>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span style="color: red;">*</span></label>
                                        <?= form_password($password_confirm); ?>
                                    </div>
                                </div>
                            </div><!--./row -->
                        </div><!--./col-lg-6 -->
                    </div><!--./row -->

                    <?= form_hidden('id', $user->id); ?>
                    <?= form_hidden($csrf); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?= form_submit('submit', 'Save', array('class' => "btn btn-primary")); ?>
                                <?= anchor('auth/users_lists', 'Cancel', 'class="btn btn-warning"') ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?= form_close() ?>
            </div>
        </div>
        <!-- /form inputs -->
    </div>
    <!-- /content area -->