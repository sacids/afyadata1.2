<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Users Lists</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Users Lists</span>
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="pull-left">
                            <?= anchor('auth/create_user', '<b><i class="icon-user-plus"></i></b> Register User', 'class="btn btn-primary btn-labeled btn-labeled-left btn-sm"') ?>
                        </div>
                    </div>
                </div><!--./row -->

                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <?php if (isset($users_lists) && $users_lists) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th width="3%"></th>
                                        <th width="12%">Name</th>
                                        <th width="10%">Email</th>
                                        <th width="8%">Phone</th>
                                        <th width="8%">Username</th>
                                        <th width="8%">Groups</th>
                                        <th width="8%">Status</th>
                                        <th width="10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $serial = 1;
                                    foreach ($users_lists as $values) { ?>
                                        <tr>
                                            <td><?= $serial ?></td>
                                            <td><?= $values->first_name . ' ' . $values->last_name; ?></td>
                                            <td><?= $values->email; ?></td>
                                            <td><?= $values->phone; ?></td>
                                            <td><?= $values->username; ?></td>
                                            <td>
                                                <?php
                                                foreach ($values->groups as $group) {
                                                    echo str_replace('_', ' ', $group->name) . "<br/>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?= ($values->active) ? anchor("auth/deactivate/" . $values->id, '<b><i class="icon-user"></i></b>' . lang('index_active_link'), 'class="btn btn-success btn-labeled btn-labeled-left btn-sm"') :
                                                    anchor("auth/activate/" . $values->id, '<b><i class="icon-user-block"></i></b>' . lang('index_inactive_link'), 'class="btn btn-danger btn-labeled btn-labeled-left btn-sm"');
                                                ?>
                                            </td>
                                            <td>
                                                <?= anchor('auth/edit_user/' . $values->id, '<b><i class="icon-pencil"></i></b> Edit', 'class="btn btn-primary btn-labeled btn-labeled-left btn-sm"'); ?></td>
                                        </tr>
                                        <?php
                                        $serial++;
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