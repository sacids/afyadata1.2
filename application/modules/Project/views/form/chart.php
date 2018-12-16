<?php



$json = '
[{
    label: "Linea A",
            backgroundColor: "transparent",
            borderColor: color[1],
            pointBackgroundColor: color[1],
            pointBorderColor: color[1],
            pointHoverBackgroundColor:color[1],
            pointHoverBorderColor: color[1],
    data: [{

        x: "2014-09-02",
                y: 90

            }, {
        x: "2014-11-02",
                y: 96

            }, {
        x: "2014-12-03",
                y: 97

            }]


        },
            {
                label: "Linea B",
                backgroundColor: "transparent",
                borderColor: color[2],
                pointBackgroundColor: color[2],
                pointBorderColor: color[2],
                pointHoverBackgroundColor:color[2],
                pointHoverBorderColor: color[2],
                data: [{
                x: "2014-09-01",
                    y: 96
                }, {
                x: "2014-10-04",
                    y: 95.8
                }, {
                x: "2014-11-06",
                    y: 99
                }]
            }]';


?>
<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>
<style>
    .chart-container {
        position: relative;
        margin: auto;
        height: 500px;
        width: 70vw;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>


    var ctx = document.getElementById('myChart').getContext('2d');
    var color=["#ff6384","#5959e6","#2babab","#8c4d15","#8bc34a","#607d8b","#009688"];
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'scatter',

        // The data for our dataset
        data: {
            datasets: <?php echo $json; ?>
        },

        // Configuration options go here
        options: {
            responsive: true,
            legend: {
                position: 'left',
            },
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        displayFormats: {
                            'month': 'MM/YY',
                        },
                        tooltipFormat: "DD/MM/YY"
                    }
                } ]
            }
        }
    });
</script>

<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */
/*
    $form_id    = $this->session->userdata('form_id');
    $project_id = $this->session->userdata('project_id');
    $group_id = $this->session->userdata('group_id');

    print_r($form_id);
*/

