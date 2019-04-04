<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Diseases Tests</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Diseases Tests</span>
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

                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <?php if (isset($diseases) && $diseases) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-responsive datatable-basic">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px;"></th>
                                        <th>Specie</th>
                                        <th>Symptoms</th>
                                        <th>Results</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $serial = 1;
                                    foreach ($diseases as $values) { ?>
                                        <tr>
                                            <td><?= $serial ?></td>
                                            <td><?= $values->specie->title_sw ?></td>
                                            <td><?= $values->symptoms ?></td>
                                            <td><?= $values->results; ?></td>
                                        </tr>
                                        <?php
                                        $serial++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else {
                            echo display_message('No disease found', 'danger');
                        } ?>
                    </div><!--./col-lg-12 -->
                </div><!--./row -->
            </div><!--./card -->
        </div>
        <!-- /hover rows -->
    </div>
    <!-- /content area -->