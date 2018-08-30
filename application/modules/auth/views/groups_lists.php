<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Groups Lists</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Groups Lists</span>
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
            <div class="card-body">

                <?php if ($this->session->flashdata('message') != "") {
                    echo $this->session->flashdata('message');
                } ?>

                <div class="row" >
                    <div class="col-lg-12">
                        <div class="pull-left">
                            <?= anchor('auth/create_group', '<i class="icon-pencil"></i> Create New Group', 'class="btn btn-sm btn-primary"') ?>
                        </div>
                    </div>
                </div><!--./row -->

                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <?php if (isset($groups_lists) && $groups_lists) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th width="3%"></th>
                                        <th width="15%">Group Name</th>
                                        <th width="40%">Description</th>
                                        <th width="25%" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($groups_lists as $v) { ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $v->name ?></td>
                                            <td><?= $v->description ?></td>
                                            <td class="text-center">
                                                <?= anchor("auth/edit_group/" . $v->id, '<i class="icon-pencil"></i> ' . lang('edit_group_heading'), array("class" => 'btn btn-primary btn-sm')); ?>
                                                <?= anchor("auth/perms_group/" . $v->id, '<i class="icon-users4"></i> Assign Permission', array("class" => 'btn btn-warning btn-sm')); ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else {
                            echo display_message('No group found', 'danger');
                        } ?>
                    </div><!--./col-lg-12 -->
                </div><!--./row -->
            </div><!--./card -->
        </div>
        <!-- /hover rows -->
    </div>
    <!-- /content area -->