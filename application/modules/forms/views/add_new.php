<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Upload New Form</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="<?= site_url('projects/details/' . $project->id) ?>"
                       class="breadcrumb-item"> <?= isset($project) ? $project->title : 'Project Details' ?></a>
                    <span class="breadcrumb-item active">Upload New Form</span>
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
                <?= form_open_multipart(uri_string(), 'role="form"'); ?>
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Upload New Form</legend>

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
                                                echo form_dropdown('access', $access_choice, set_value('access'), 'class="form-control"');
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
                                                echo form_dropdown('status', $status_choice, set_value('status'), 'class="form-control"');
                                                ?>
                                            </div> <!-- /form-group -->
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Form XML <span style="color: red;">*</span></label>
                                                <?= form_upload($attachment); ?>
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
                                </div>

                                <div class="tab-pane fade" id="permission">

                                </div>

                                <div class="tab-pane fade" id="configuration">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Push</label><br>
                                                <?php
                                                echo form_checkbox('push', 1, set_checkbox('push', 1), 'id="push"');
                                                echo form_label('Yes', 'push'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Has Feedback</label><br>
                                                <?php
                                                echo form_checkbox('has_feedback', 1, set_checkbox('has_feedback', 1), 'id="has_feedback"');
                                                echo form_label('Yes', 'has_feedback'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Allow DHIS2</label><br>
                                                <?php
                                                echo form_checkbox('allow_dhis', 1, set_checkbox('allow_dhis', 1), 'id="allow_dhis"');
                                                echo form_label('Yes', 'allow_dhis'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /highlighted tabs -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo form_submit('submit', 'Upload', array('class' => "btn btn-primary")); ?>
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