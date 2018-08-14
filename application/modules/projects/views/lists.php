<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Projects Lists</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Projects Lists</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <!-- Hover rows -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Projects Lists</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                    </div>
                </div>
            </div>

            <?php if (isset($projects_list) && $projects_list) { ?>
                <table class="table datatable-basic table-hover">
                    <thead>
                    <tr>
                        <th width="3%"></th>
                        <th width="35%">Project Title</th>
                        <th width="15%">Creator</th>
                        <th width="15%">Viewers</th>
                        <th width="10%">Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($projects_list as $v) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= anchor('projects/details/' . $v->id . '/' . str_replace(' ', '-', strtolower($v->title)), '<strong>' . $v->title . '</strong>', 'title="Project details"') ?>
                                <br><?= $v->description ?></td>
                            <td><?= $v->user->first_name . ' ' . $v->user->last_name ?></td>
                            <td><?= $v->perms ?></td>
                            <td><?= date('d/m/Y', strtotime($v->created_at)) ?></td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="<?= site_url('projects/edit/' . $v->id) ?>"
                                               class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                            <a href="<?= site_url('projects/delete/' . $v->id) ?>"
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
            <?php } else {
                echo display_message('No project found', 'danger');
            } ?>
        </div>
        <!-- /hover rows -->

    </div>
    <!-- /content area -->