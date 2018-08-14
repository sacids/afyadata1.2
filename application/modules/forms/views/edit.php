<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Edit Form</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Edit Form</li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Form
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <?php if (validation_errors() != "") {
                                echo '<div class="alert alert-danger fade in">' . validation_errors() . '</div>';
                            } else if ($this->session->flashdata('message') != "") {
                                echo $this->session->flashdata('message');
                            } ?>

                            <?= form_open(uri_string(), 'role="form"'); ?>
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
                                        <label>Project <span style="color: red;">*</span></label>
                                        <?php
                                        $project_option = array();
                                        if (isset($projects_list)) {
                                            foreach ($projects_list as $v) {
                                                $project_option[$v->id] = $v->title;
                                            }
                                            $project_option = array('' => 'Choose Project') + $project_option;
                                            echo form_dropdown('project_id', $project_option, set_value('project_id', $form->project_id), 'class="form-control"');
                                        } ?>
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <?php echo form_submit('submit', 'Save', array('class' => "btn btn-primary")); ?>
                                        <?= anchor('projects/details/' . $project->id . '/' . str_replace(' ', '-', strtolower($project->title)), 'Cancel', 'class="btn btn-warning"') ?>
                                    </div> <!-- /form-group -->
                                </div>
                            </div> <!-- /.row -->
                            <?= form_close() ?>

                        </div><!--./col-lg-6-->
                    </div><!--./row -->
                </div><!--./panel-body -->
            </div><!--./panel -->
        </div><!--./col-lg-12-->
    </div><!--./row -->
</div><!-- /#page-wrapper -->
<!-- /#wrapper -->


