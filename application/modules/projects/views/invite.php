<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Invite Users to Project</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="<?= site_url('projects/details/' . $project->id) ?>"
                       class="breadcrumb-item"> <?= isset($project) ? $project->title : 'Project Details' ?></a>
                    <span class="breadcrumb-item active">Invite Users to Project</span>
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
                    <legend class="text-uppercase font-size-sm font-weight-bold">Invite Users to Project
                        : <?= isset($project) ? $project->title : '' ?></legend>

                    <?php if ($this->session->flashdata('message') != "") {
                        echo $this->session->flashdata('message');
                    } ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Project Title <span style="color: red;">*</span></label>
                                <?= form_input($name); ?>
                                <span class="form-text text-danger"><?= form_error('name') ?></span>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Project Code <span style="color: red;">*</span></label>
                                <?= form_input($code); ?>
                            </div> <!-- /form-group -->
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Users <span style="color: red;">*</span></label>
                                <select name="users[]" class="form-control multiselect-max-height" multiple="multiple"
                                        data-fouc>
                                    <?php foreach ($users as $user) { ?>
                                        <option value="<?= $user->phone ?>"><?= $user->first_name . ' ' . $user->last_name ?></option>
                                    <?php } ?>
                                </select>
                                <span class="form-text text-danger"><?= form_error('users[]') ?></span>
                            </div>
                        </div>
                    </div> <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?= form_submit('submit', 'Invite', array('class' => "btn btn-primary")); ?>
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