<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Diseases Symptoms</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Diseases Symptoms</span>
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
                    <div class="col-lg-6">
                        <div class="pull-left">
                            <?= anchor('ohkr/diseases_symptoms/add_new', '<b><i class="icon-plus2"></i></b> Add New Disease', 'class="btn btn-primary btn-labeled btn-labeled-left btn-sm"') ?>
                        </div>
                    </div>
                </div><!--./row -->

                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <?php if (isset($diseases_symptoms) && $diseases_symptoms) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-responsive datatable-basic">
                                    <thead>
                                    <tr>
                                        <th width="3%"></th>
                                        <th width="20%">Disease</th>
                                        <th width="20%">Symptom</th>
                                        <th width="20%">Species</th>
                                        <th width="15%">Importance (%)</th>
                                        <th width="10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $serial = 1;
                                    foreach ($diseases_symptoms as $values) { ?>
                                        <tr>
                                            <td><?= $serial ?></td>
                                            <td><?= $values->disease->title_sw ?></td>
                                            <td><?= $values->symptom->title_sw ?></td>
                                            <td><?= $values->specie->title_sw; ?></td>
                                            <td><?= $values->importance; ?></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $serial++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else {
                            echo display_message('No disease symptom found', 'danger');
                        } ?>
                    </div><!--./col-lg-12 -->
                </div><!--./row -->
            </div><!--./card -->
        </div>
        <!-- /hover rows -->
    </div>
    <!-- /content area -->