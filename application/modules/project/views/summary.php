<script src="<?= base_url('assets/js/highcharts.js') ?>"></script>

<?php if (isset($xforms) && $xforms) { ?>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#overall" class="nav-link active" data-toggle="tab">Overall Data</a></li>
            <li class="nav-item"><a href="#monthly" class="nav-link" data-toggle="tab">Monthly Data</a></li>
            <li class="nav-item"><a href="#weekly" class="nav-link" data-toggle="tab">Weekly Data</a></li>
            <li class="nav-item"><a href="#today" class="nav-link" data-toggle="tab">Today Data</a></li>
        </ul>

        <div class="tab-content">
            <div id="overall" class="tab-pane fade show active">
                <div id="overall-graph" style="height: 400px; width: 95% !important;"></div>
            </div>
            <div id="monthly" class="tab-pane fade">
                <div id="monthly-graph" style="height: 400px; width: 90% !important;"></div>
            </div>
            <div id="weekly" class="tab-pane fade">
                <div id="weekly-graph" style="height: 400px; width: 90% !important;"></div>
            </div>
            <div id="today" class="tab-pane fade">
                <div id="daily-graph" style="height: 400px; width: 90% !important;"></div>
            </div>
        </div><!--./tab-content -->
    </div><!--./card-body -->

<?php } else {
    echo 'Nothing to show';
} ?>


<script type="text/javascript">
    //TODO: make function to be called within view
    //Overall data
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#overall-graph').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Overall form submitted'
                },
                xAxis: {
                    categories: <?php echo $form_title;?>
                },
                yAxis: {
                    title: {
                        text: 'Form submitted'
                    }
                },
                series: [{
                    name: 'Submitted forms',
                    data: <?php echo $overall_data;?>
                }],
                credits: {
                    enabled: false
                }
            }
        );
    });

    //Monthly data
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#monthly-graph').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly form submitted'
                },
                xAxis: {
                    categories: <?php echo $form_title;?>
                },
                yAxis: {
                    title: {
                        text: 'Form submitted'
                    }
                },
                series: [{
                    name: '<?php echo 'Submitted forms'; ?>',
                    data: <?php echo $monthly_data;?>
                }],
                credits: {
                    enabled: false
                }
            }
        );
    });

    //Weekly data
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#weekly-graph').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Weekly form submitted'
                },
                xAxis: {
                    categories: <?php echo $form_title;?>
                },
                yAxis: {
                    title: {
                        text: 'Form submitted'
                    }
                },
                series: [{
                    name: '<?php echo 'Submitted forms'; ?>',
                    data: <?php echo $weekly_data;?>
                }],
                credits: {
                    enabled: false
                }
            }
        );
    });

    //Weekly data
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#daily-graph').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Daily form submitted'
                },
                xAxis: {
                    categories: <?php echo $form_title;?>
                },
                yAxis: {
                    title: {
                        text: 'Form submitted'
                    }
                },
                series: [{
                    name: '<?php echo 'Submitted forms'; ?>',
                    data: <?php echo $daily_data;?>
                }],
                credits: {
                    enabled: false
                }
            }
        );
    });
</script>