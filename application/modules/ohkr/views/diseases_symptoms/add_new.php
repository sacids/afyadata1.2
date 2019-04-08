<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Add New Disease Symptoms</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Add New Disease Symptoms</span>
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
                    <legend class="text-uppercase font-size-sm font-weight-bold">Add New Disease</legend>

                    <?php if ($this->session->flashdata('message') != "") {
                        echo $this->session->flashdata('message');
                    } ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Disease<span style="color: red;">*</span></label>
                                <?php
                                $diseases_options = [];

                                if (isset($diseases) && $diseases) {
                                    foreach ($diseases as $v) {
                                        $diseases_options[$v->id] = $v->title_sw;
                                    }
                                    $diseases_options = ['' => 'Select disease'] + $diseases_options;
                                }
                                echo form_dropdown('disease_id', $diseases_options, set_value('disease_id'), 'class="form-control"'); ?>
                                <span class="form-text text-danger"><?= form_error('disease_id') ?></span>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Species <span style="color: red;">*</span></label><br/>
                                <?php
                                $serial = 1;
                                if (isset($species) && $species) {
                                    foreach ($species as $v) { ?>
                                        <input type="checkbox" name="specie_id[]"
                                               value="<?= $v->id; ?>" <?= set_checkbox('specie_id[]', $v->id); ?>>
                                        <?= $v->title_sw . '<br />';
                                        $serial++;
                                    }
                                } ?>
                                <span class="form-text text-danger"><?= form_error('specie_id[]') ?></span>
                            </div>
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Symptom <span style="color: red;">*</span></label>
                                <?php
                                $symptoms_options = [];

                                if (isset($symptoms) && $symptoms) {
                                    foreach ($symptoms as $v) {
                                        $symptoms_options[$v->id] = $v->code . '. ' . $v->title_sw;
                                    }
                                    $symptoms_options = ['' => 'Select symptom'] + $symptoms_options;
                                }
                                echo form_dropdown('symptom_id', $symptoms_options, set_value('symptom_id'), 'class="form-control"'); ?>
                                <span class="form-text text-danger"><?= form_error('symptom_id') ?></span>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Importance <span style="color: red;">*</span></label>
                                <?= form_input($importance); ?>
                                <span class="form-text text-danger"><?= form_error('importance') ?></span>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo form_submit('submit', 'Save', array('class' => "btn btn-primary")); ?>
                                <?= anchor('ohkr/diseases_symptoms/lists', 'Cancel', 'class="btn btn-warning"') ?>
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