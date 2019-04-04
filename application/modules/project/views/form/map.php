<link rel="stylesheet" href="<?php echo base_url(); ?>vendors/leaflet/css/leaflet.css" />

<style type="text/css">
    .fullscreen-icon { background-image: url(<?php echo base_url(); ?>vendors/leaflet/plugins/fullscreen/icon-fullscreen.png); }
    /* one selector per rule as explained here : http://www.sitepoint.com/html5-full-screen-api/ */
    #map:-webkit-full-screen { width: 100% !important; height: 100% !important; z-index: 99999; }
    #map:-ms-fullscreen { width: 100% !important; height: 100% !important; z-index: 99999; }
    #map:full-screen { width: 100% !important; height: 100% !important; z-index: 99999; }
    #map:fullscreen { width: 100% !important; height: 100% !important; z-index: 99999; }
    .leaflet-pseudo-fullscreen { position: fixed !important; width: 100% !important; height: 100% !important; top: 0px !important; left: 0px !important; z-index: 99999; }
</style>


<script src="<?php echo base_url(); ?>vendors/leaflet/js/leaflet.js" /></script>
<script src="<?php echo base_url(); ?>vendors/leaflet/plugins/fullscreen/Control.FullScreen.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>vendors/leaflet/plugins/markercluster/MarkerCluster.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/leaflet/plugins/markercluster/MarkerCluster.Default.css" />
    <script src="<?php echo base_url(); ?>vendors/leaflet/plugins/markercluster/leaflet.markercluster.js"></script>


<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */

$this->model->set_table('xforms');
$xform      = $this->model->get($this->session->userdata('form_id'));
$table_name = $xform->form_id;


// check if file is cached




$this->model->set_table($table_name);
if(!$this->model->count_all()){
    echo 'No data available';
    return;
}

$this->model->set_table('xform_field_map');
$mapping    = $this->model->get_many_by('table_name',$table_name);
//echo '<pre>'; print_r($mapping); exit();

// get user permissions from filters of particular


$fields = $this->db->field_data($table_name);
$gps_prefix  = false;
foreach ($fields as $field) {
    if($field->type == 'point'){
        $gps_prefix  =  substr($field->name,0,-6);
    }
}

if (!$gps_prefix) {
    log_message('error', 'load points Table ' . $form_id . ' has no location field of type POINT');
    echo 'Data does not support Map features';
    return FALSE;
}

$this->model->set_table($table_name);
$data   = $this->model->as_array()->get_all();


$addressPoints = '<script type="text/javascript"> var addressPoints = [';
$first = 0;
foreach ($data as $val) {
    $data_string = "<h3>" . $xform->title . "</h3>";
    foreach ($val as $key => $value) {
        if (!strpos($key, '_point')) {

// remove after demo
            if (preg_match('/(\.jpg|\.png|\.bmp)$/', $value)) {
                $data_string .= str_replace('"', '\'', '<img src = "' . base_url() . 'assets/forms/data/images/' . $value . '" width="350" /><br/>');
            } else {
                $data_string .= $key . " : " . str_replace('"', '', str_replace("'", "\'", $value)) . "<br/>";
            }
        }
    }
    log_message("debug", "Single record " . $data_string);
    $lat = $val[$gps_prefix . '_lat'];
    $lng = $val[$gps_prefix . '_lng'];
    //TODO Replace a with form data.
$data_string = '';
    if (!$first++) {
        $addressPoints .= '[' . $lat . ', ' . $lng . ', "' . $data_string . '"]';
    } else {
        $addressPoints .= ',[' . $lat . ', ' . $lng . ', "' . $data_string . '"]';
    }
}
$addressPoints .= ']; </script>';
$latlon = $lat . ', ' . $lng;




/*
$data       = $this->model->get_all();



foreach($data as $obj){
    // create markers
}

///caching
if ( ! $foo = $this->cache->get('foo'))
{
     echo 'Saving to the cache!<br />';
     $foo = 'foobarbaz!';

     // Save into the cache for 5 minutes
     $this->cache->save('foo', $foo, 300);
}



*/



?>

<div style="width: 100%; min-height: 500px; height: auto" id="map"></div>
<?php echo $addressPoints; ?>
<script type="text/javascript">
    var tiles = L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
            maxZoom: 18
        }),
        latlng = L.latLng(<?php echo $latlon; ?>);

    var map = L.map("map", {
        center: latlng,
        zoom: 6,
        layers: [tiles],
        fullscreenControl: true,
        fullscreenControlOptions: { // optional
            title:"Show me the fullscreen !",
            titleCancel:"Exit fullscreen mode"
        }
    });

    var markers = L.markerClusterGroup();
    for (var i = 0; i < addressPoints.length; i++) {
        var a = addressPoints[i];
        var title = a[2];
        var marker = L.marker(new L.LatLng(a[0], a[1], {title: title}));
        marker.bindPopup(title);
        markers.addLayer(marker);
    }
    map.addLayer(markers);
</script>
