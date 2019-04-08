<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Add New Disease</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Add New Disease</span>
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
                <?= form_open('ohkr/diseases/add_new', 'role="form"'); ?>
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Add New Disease</legend>

                    <?php if ($this->session->flashdata('message') != "") {
                        echo $this->session->flashdata('message');
                    } ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Disease Title <span style="color: red;">*</span></label>
                                <?= form_input($name); ?>
                                <span class="form-text text-danger"><?= form_error('name') ?></span>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Species <span style="color: red;">*</span></label>
                                <?php
                                $specie_options = array();
                                if (isset($species_lists)) {
                                    foreach ($species_lists as $v) {
                                        $specie_options[$v->id] = $v->title;
                                    }
                                }
                                echo form_dropdown('specie[]', $specie_options, set_value('specie[]'), 'class="form-control select" data-placeholder="Select specie ..."  multiple="multiple" data-fouc'); ?>
                                <span class="form-text text-danger"><?= form_error('specie[]') ?></span>
                            </div>
                        </div>
                    </div> <!-- /.row -->


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description</label>
                                <?= form_textarea($description); ?>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo form_submit('submit', 'Save', array('class' => "btn btn-primary")); ?>
                                <?= anchor('ohkr/diseases/lists', 'Cancel', 'class="btn btn-warning"') ?>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->
                </fieldset>
                <?= form_close() ?>
            </div>
        </div>
        <!-- /form inputs -->

    </div>
    <!-- /content area -->