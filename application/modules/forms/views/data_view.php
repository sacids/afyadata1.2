<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?= (isset($form) ? $form->title : '') ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
        <?php if (isset($project)) { ?>
            <li>
                <a href="<?= site_url('projects/details/' . $project->id . '/' . str_replace(' ', '-', strtolower($project->title))) ?>"><?= $project->title ?></a>
            </li>
        <?php } ?>
        <li class="active">Form Data</li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Form Data : <?= (isset($form) ? $form->title : '') ?>

                    <span class="pull-right">
                        <?= anchor("forms/export_form_data/" . $form->id, '<i class="fa fa-file-excel-o fa-lg"></i>&nbsp;&nbsp;') ?>
                        <?= anchor("forms/data_view/" . $project->id . '/' . $form->id, '<i class="fa fa fa-bar-chart-o fa-lg"></i>&nbsp;&nbsp;') ?>
                        <?= anchor('forms/map_view/' . $project->id . '/' . $form->id, '<i class="fa fa-map-marker fa-lg"></i>') ?>
                    </span>
                </div>
                <div class="panel-body">
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
                </div><!--./panel-body-->
            </div><!--./panel -->
        </div><!--./col-lg-12 -->
    </div><!--./row -->
</div><!-- /#page-wrapper -->
<!-- /#wrapper -->


