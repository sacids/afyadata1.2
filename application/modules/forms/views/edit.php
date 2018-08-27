<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Edit Form</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="<?= site_url('projects/details/' . $project->id) ?>"
                       class="breadcrumb-item"> <?= isset($project) ? $project->title : 'Project Details' ?></a>
                    <span class="breadcrumb-item active">Edit Form</span>
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
                    <legend class="text-uppercase font-size-sm font-weight-bold">Edit Form</legend>

                    <?php if (validation_errors() != "") {
                        echo '<div class="alert alert-danger">' . validation_errors() . '</div>';
                    } else if ($this->session->flashdata('message') != "") {
                        echo $this->session->flashdata('message');
                    } ?>

                    <!-- Highlighted tabs -->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="nav-item"><a href="#form-details" class="nav-link active"
                                                        data-toggle="tab">Form Details</a></li>
                                <li class="nav-item"><a href="#permission" class="nav-link"
                                                        data-toggle="tab">Permission</a>
                                </li>
                                <li class="nav-item"><a href="#configuration" class="nav-link" data-toggle="tab">Configuration</a>
                                </li>
                                <li class="nav-item"><a href="#mapping" class="nav-link" data-toggle="tab">Field
                                        Mapping</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="form-details">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Form Title <span style="color: red;">*</span></label>
                                                <?= form_input($name); ?>
                                            </div> <!-- /form-group -->
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Access <span style="color: red;">*</span></label>
                                                <?php
                                                $access_choice = array(
                                                    '' => 'Choose access',
                                                    'public' => 'Public',
                                                    'private' => 'Private'
                                                );
                                                echo form_dropdown('access', $access_choice, set_value('access', $form->access), 'class="form-control"');
                                                ?>
                                            </div> <!-- /form-group -->
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status <span style="color: red;">*</span></label>
                                                <?php
                                                $status_choice = array(
                                                    '' => 'Choose status',
                                                    'published' => 'Publish',
                                                    'draft' => 'Draft'
                                                );
                                                echo form_dropdown('status', $status_choice, set_value('status', $form->status), 'class="form-control"');
                                                ?>
                                            </div> <!-- /form-group -->
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
                                </div><!-- ./form-details -->

                                <div class="tab-pane fade" id="permission">

                                </div><!-- ./permission -->

                                <div class="tab-pane fade" id="configuration">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Push</label><br>
                                                <?php
                                                echo form_checkbox('push', 1, ($form_config->push == 1) ? TRUE : FALSE);
                                                echo form_label('Yes', 'push'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Has Feedback</label><br>
                                                <?php
                                                echo form_checkbox('has_feedback', 1, ($form_config->has_feedback == 1) ? TRUE : FALSE);
                                                echo form_label('Yes', 'has_feedback'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Use OHKR</label><br>
                                                <?php
                                                echo form_checkbox('use_ohkr', 1, ($form_config->use_ohkr == 1) ? TRUE : FALSE);
                                                echo form_label('Yes', 'use_ohkr'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Has Visualization</label><br>
                                                <?php
                                                echo form_checkbox('has_charts', 1, ($form_config->has_charts == 1) ? TRUE : FALSE);
                                                echo form_label('Yes', 'has_charts'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Has Map</label><br>
                                                <?php
                                                echo form_checkbox('has_map', 1, ($form_config->has_map == 1) ? TRUE : FALSE);
                                                echo form_label('Yes', 'has_map'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Allow DHIS2</label><br>
                                                <?php
                                                echo form_checkbox('allow_dhis', 1, ($form_config->allow_dhis == 1) ? TRUE : FALSE);
                                                echo form_label('Yes', 'allow_dhis'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->
                                </div><!-- ./configuration -->

                                <div class="tab-pane fade" id="mapping">
                                    <?php if (isset($table_fields) && $table_fields) { ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive table-bordered table-striped">
                                                        <tr>
                                                            <th width="8%" class="text-center">Hide</th>
                                                            <th width="30%" class="text-center">Mapping To</th>
                                                            <th width="30%" class="text-center">Question/Label</th>
                                                            <th width="10%" class="text-center">Field Type</th>
                                                            <th width="10%" class="text-center">Chart use</th>
                                                        </tr>
                                                        <?php

                                                        $form_specific_options = [
                                                            '' => "Select Option",
                                                            'male case' => "Male Case",
                                                            'male death' => "Male Death",
                                                            'female case' => "Female Case",
                                                            'female death' => "Female Death"
                                                        ];

                                                        $field_type_options = [
                                                            'TEXT' => "Text",
                                                            'INT'
                                                            => "Number",
                                                            "GPS" => "GPS Location",
                                                            "DATE" => "DATE",
                                                            "DALILI" => 'Dalili',
                                                            "LAT" => "Latitude",
                                                            "LONG" => "Longitude",
                                                            "IDENTITY" => "Username/Identity",
                                                            "IMAGE" => "Image",
                                                            "DISTRICT" => "District",
                                                            "SPECIE" => "Specie",
                                                        ];

                                                        $use_in_chart_options = [1 => 'Yes', 0 => 'No'];

                                                        foreach ($table_fields as $tf) {
                                                            echo "<tr>";
                                                            echo "<td class='text-center'>" . form_checkbox("hide[]", $tf['id'], ($tf['hide'] == 1)) . "</td>";
                                                            echo "<td><em>{$tf['col_name']}</em></td>";
                                                            echo "<td>" . form_hidden("ids[]", $tf['id']) . " " . form_input("label[]", (!empty($tf['field_label']) ? $tf['field_label'] : $tf['field_name']), 'class="form-control"') . "</td>";
                                                            echo "<td>" . form_dropdown("field_type[]", $field_type_options, $tf['field_type']) . "</td>";
                                                            echo "<td>" . form_dropdown("chart_use[]", $use_in_chart_options, $tf['chart_use']) . "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div><!-- ./mapping -->
                            </div>
                        </div>
                    </div>
                    <!-- /highlighted tabs -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo form_submit('submit', 'Save', array('class' => "btn btn-primary")); ?>
                                <?= anchor('projects/details/' . $project->id, 'Cancel', 'class="btn btn-warning"') ?>
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