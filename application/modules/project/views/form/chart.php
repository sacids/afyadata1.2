<?php


$this->model->set_table('xforms');
$xform      = $this->model->get($this->session->userdata('form_id'));
$table_name = $xform->form_id;


// check if file is cached


$this->model->set_table('xform_field_map');
$mapping    = $this->model->get_many_by('table_name',$table_name);
$calc       = array('1' => 'SUM', '2' => 'COUNT', '3' => 'AVG');
$q          = array();

foreach($mapping as $field){

    $chart  = $field->chart;
    if(!$chart) continue;

    $tmp    = $calc[$chart]."(".$field->col_name.") as '".$field->field_label."'";
    array_push($q,$tmp);
}

$sql    = "SELECT DATE(submitted_at) as submitted_date, ".implode(', ',$q)." FROM $table_name GROUP BY submitted_date";

$query  = $this->db->query($sql);
if(!$query->num_rows()){
    echo 'No data available';
    return;
}
$chart_data = array();


foreach($query->result_array() as $row){
    foreach($row as $k => $v){
        if(!array_key_exists($k,$chart_data)){
            $chart_data[$k] = array();
        }

        array_push($chart_data[$k],$v);
    }
}

$submitted_date     = array_shift($chart_data);

$series = array();
foreach($chart_data as $k => $v){
    $tmp    = "
    { 
        name: '$k',
        type: 'line',
        smooth: true, 
        symbolSize: 6, 
        itemStyle: {
            normal: {
                borderWidth: 2
            }
        }, 
        data: [".implode(",",$v)."]
    }";
    array_push($series,$tmp);
}

$json   = " 
                // Define elements
                var line_zoom_element = document.getElementById('line_zoom');
                
                // Initialize chart
                var line_zoom = echarts.init(line_zoom_element);
                
                //
                // Chart config
                //
    
                // Options
                line_zoom.setOption({
    
                    // Define colors
                    color: ['#D9CCE3', '#CAACCB', '#BA8DB4', '#AA6F9E', '#994F88', '#882E72', '#1965B0', '#437DBF', '#6195CF', '#7BAFDE', '#4EB265', '#90C987', '#CAE0AB', '#F7F056', '#F7CB45', '#F4A736', '#EE8026', '#E65518', '#DC050C', '#A5170E','#72190E', '#42150A'],
    
                    // Global text styles
                    textStyle: {
                        fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                        fontSize: 13
                    },
    
                    // Chart animation duration
                    animationDuration: 750,
    
                    // Setup grid
                    grid: {
                        left: 0,
                        right: 40,
                        top: 35,
                        bottom: 60,
                        containLabel: true
                    },
    
                    // Add legend
                    legend: {
                        data: ['".implode("', '",array_keys($chart_data))."'],
                        type: 'scroll',
                        orient: 'horizontal',
                        right: 10,
                        top: 0,
                        bottom: 5
                    },
    
                    // Add tooltip
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        padding: [10, 15],
                        textStyle: {
                            fontSize: 13,
                            fontFamily: 'Roboto, sans-serif'
                        }
                    },
    
                    // Horizontal axis
                    xAxis: [{
                        type: 'category',
                        boundaryGap: false,
                        axisLabel: {
                            color: '#333'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#999'
                            }
                        },
                        data: ['".implode("', '",$submitted_date)."']
                    }],
    
                    // Vertical axis
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            formatter: '{value} ',
                            color: '#333'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#999'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: ['#eee']
                            }
                        },
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                            }
                        }
                    }],
    
                    // Zoom control
                    dataZoom: [
                        {
                            type: 'inside',
                            start: 30,
                            end: 70
                        },
                        {
                            show: true,
                            type: 'slider',
                            start: 30,
                            end: 70,
                            height: 40,
                            bottom: 0,
                            borderColor: '#ccc',
                            fillerColor: 'rgba(0,0,0,0.05)',
                            handleStyle: {
                                color: '#585f63'
                            }
                        }
                    ],
    
                    // Add series
                    series: [
                        ".implode(',', $series)."
                    ]
                });
            
            ";

?>

<script src="<?php echo base_url(); ?>/vendors/limitless/global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>


<div class="chart-container">
    <div class="chart has-fixed-height"  style="width:95vw; height:483px;" id="line_zoom"> </div>
</div>

<script> <?php echo $json; ?> </script>
