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
                        <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown"><i class="fa fa-plus"></i> Upload Form
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= site_url('forms/add_new/' . $project->id) ?>">Upload
                                    XML</a></li>
                            <li><a class="dropdown-item" href="#">Upload XLS</a></li>
                        </ul>

                        <?= anchor('projects/edit/' . $project->id, '<i class="fa fa-pencil"></i> Edit Project', 'class="btn btn-sm btn-warning"') ?>
                        <?= anchor('projects/delete/' . $project->id, '<i class="fa fa-trash"></i> Delete Project', 'class="btn btn-sm btn-danger delete"') ?>
                    </div>
                </div><!--./row -->


                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <h4 class="title"> Project Forms</h4>
                        <?php if (isset($forms_list) && $forms_list) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th width="30%">Form Title</th>
                                        <th width="10%">Created At</th>
                                        <th width="8%">Status</th>
                                        <th width="15%"></th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    foreach ($forms_list as $v) { ?>
                                        <tr>
                                            <td><?= anchor('forms/data_view/' . $project->id . '/' . $v->id . '/' . str_replace(' ', '-', strtolower($v->title)), '<h5>' . $v->title . '</h5>') ?>
                                                <?= $v->description ?></td>
                                            <td><?= date('F jS, Y', strtotime($v->created_at)) ?></td>
                                            <td><?= ($v->status == 'published' ? '<span class="label label-success">Published</span>' : '<span class="label label-warning">Draft</span>') ?></td>
                                            <td>
                                                <?php
                                                //if (perms_role('documents', 'edit'))
                                                echo anchor('forms/edit/' . $project->id . '/' . $v->id . '/' . str_replace(' ', '-', strtolower($v->title)), '<i class="fa fa-pencil"></i> Edit', 'class="btn btn-primary btn-xs"') . '&nbsp;&nbsp';

                                                //if (perms_role('documents', 'edit'))
                                                echo anchor('forms/field_mapping/' . $project->id . '/' . $v->id . '/' . str_replace(' ', '-', strtolower($v->title)), '<i class="fa fa-clone"></i> Mapping', 'class="btn btn-info btn-xs"') . '&nbsp;&nbsp';

                                                //if (perms_role('documents', 'delete'))
                                                echo anchor('forms/delete/' . $project->id . '/' . $v->id . '/' . str_replace(' ', '-', strtolower($v->title)), '<i class="fa fa-trash"></i> Delete', 'class="btn btn-danger btn-xs delete"');
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    } ?>
                                </table>
                            </div>

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