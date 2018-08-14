<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    <?= isset($project) ? $project->title : 'Project Details' ?></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i> kk</a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active"><?= isset($project) ? $project->title : 'Project Details' ?></span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('message') != "") {
                    echo $this->session->flashdata('message');
                } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pull-left">
                            <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                    data-toggle="dropdown"><i class="fa fa-plus"></i> Upload Form
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= site_url('forms/add_new/' . $project->id) ?>">Upload
                                        XML</a></li>
                                <li><a class="dropdown-item" href="#">Upload XLS</a></li>
                            </ul>

                            <?= anchor('projects/edit/' . $project->id, '<i class="icon-pencil"></i> Edit Project', 'class="btn btn-sm btn-warning"') ?>
                            <?= anchor('projects/delete/' . $project->id, '<i class="icon-trash"></i> Delete Project', 'class="btn btn-sm btn-danger delete"') ?>
                            <?= anchor('projects/edit/#', '<i class="icon-envelop"></i> Invite', 'class="btn btn-sm btn-info"') ?>
                        </div>
                    </div>
                </div><!--./row -->


                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <h4 class="title"> Project Forms</h4>
                        <?php if (isset($forms_list) && $forms_list) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="28%">Form Title</th>
                                        <th width="12%">Viewers</th>
                                        <th width="10%">Created At</th>
                                        <th width="8%">Status</th>
                                        <th width="5%">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($forms_list as $v) { ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= anchor('forms/data_view/' . $project->id . '/' . $v->id, '<h5>' . $v->title . '</h5>') ?>
                                                <?= $v->description ?></td>
                                            <td></td>
                                            <td><?= date('d/m/Y', strtotime($v->created_at)) ?></td>
                                            <td><?= ($v->status == 'published' ? '<span class="label label-success">Published</span>' : '<span class="label label-warning">Draft</span>') ?></td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="<?= site_url('forms/edit/' . $project->id . '/' . $v->id) ?>"
                                                               class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                            <a href="<?= site_url('forms/delete/' . $project->id . '/' . $v->id) ?>"
                                                               class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div><!--./responsive div -->

                            <?php if (!empty($links)): ?>
                                <div class="widget-foot">
                                    <?= $links ?>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endif; ?>
                        <?php } else {
                            echo display_message('No form found', 'danger');
                        } ?>
                    </div><!--./col-lg-12-->
                </div><!--./row -->

            </div>
        </div><!--./card -->

    </div>
    <!-- /content area -->