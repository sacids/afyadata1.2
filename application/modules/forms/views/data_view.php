<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-home mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    <?= isset($form) ? $form->title : '' ?> Data</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="<?= site_url('dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="<?= site_url('projects/details/' . $project->id) ?>"
                       class="breadcrumb-item"> <?= isset($project) ? $project->title : 'Project Details' ?></a>
                    <span class="breadcrumb-item active"><?= isset($form) ? $form->title : '' ?> Data</span>
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
                <legend class="text-uppercase font-size-sm font-weight-bold">
                    <?= isset($form) ? $form->title : '' ?> Data
                </legend>

                <!-- Highlighted tabs -->
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="nav-item"><a href="#data-list" class="nav-link active"
                                                    data-toggle="tab">Data Lists</a></li>
                            <?php if (isset($form_config) && $form_config) {
                                if ($form_config->has_charts == 1)
                                    echo '<li class="nav-item"><a href="#visualization" class="nav-link" data-toggle="tab">Visualization</a></li>';

                                if ($form_config->has_map == 1)
                                    echo '<li class="nav-item"><a href="#maps" class="nav-link" data-toggle="tab">Maps</a></li>';
                            } ?>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="data-list">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if (isset($data_list) && $data_list) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-responsive">
                                                    <tr>
                                                        <?php
                                                        if (isset($mapped_fields)) {
                                                            foreach ($mapped_fields as $key => $column) {
                                                                if (array_key_exists($column, $field_maps)) {
                                                                    echo "<th>" . $field_maps[$column] . "</th>";
                                                                } else {
                                                                    echo "<th>" . $column . "</th>";
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        foreach ($data_list as $data) {
                                                            echo "<tr>";
                                                            foreach ($data as $key => $entry) {
                                                                if (preg_match('/(\.jpg|\.png|\.bmp)$/', $entry)) {
                                                                    echo "<td><img src=' " . base_url('./assets/uploads/forms/data/img/') . $entry . "' style='max-width:100px;' /></td>";
                                                                } else {
                                                                    echo "<td>" . $entry . "</td>";
                                                                }
                                                            }
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                            <?php if (!empty($links)): ?>
                                                <div class="widget-foot">
                                                    <?= $links ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endif; ?>
                                        <?php } else {
                                            echo display_message('No data found', 'danger');
                                        } ?>
                                    </div><!--./col-lg-12 -->
                                </div><!--./row -->
                            </div><!--./data-list tab -->

                            <div class="tab-pane fade" id="visualization">
                                visualization
                            </div>

                            <div class="tab-pane fade" id="maps">
                                Maps
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /highlighted tabs -->
            </div>
        </div>
        <!-- /form inputs -->

    </div>
    <!-- /content area -->