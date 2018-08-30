<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Deactivate User</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active"> Deactivate User</span>
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
                    <legend class="text-uppercase font-size-sm font-weight-bold"> <?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></legend>

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
                                        <?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
                                        <input type="radio" name="confirm" value="yes" checked="checked"/><br/>
                                        <?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
                                        <input type="radio" name="confirm" value="no"/>
                                    </div>
                                </div>
                            </div><!--./row -->
                        </div><!--./col-lg-6 -->
                    </div><!--./row -->

                    <?= form_hidden($csrf); ?>
                    <?= form_hidden(array('id' => $user->id)); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?= form_submit('submit', 'Deactivate', array('class' => "btn btn-primary")); ?>
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