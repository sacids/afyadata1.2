<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 14/12/2018
 * Time: 11:51
 */




class Form_data extends CI_Controller{

    public $output;

    public function __construct(){
        parent::__construct();

        $this->load->model('model');

    }

    function _remap($method_name = 'index') {
        if (! method_exists ( $this, $method_name )) {
            $this->page_not_found();
        } else {

            if($method_name != 'delete_row'){
                //$this->load->view('plus/ahead');
                //$this->load->view('plus/afoot');
            }
            $this->{$method_name} ();
        }
    }

    private function page_not_found() {
        echo 'page not found';
    }



    private function item(){

        $this->save_vars ();
        $table_name = $this->input->get('tn');
        $table_id   = $this->session->userdata ['post'] ['id'];

        $this->model->set_table($table_name);
        $fd         = $this->model->as_array()->get($table_id);
        $instance_id    = $fd['meta_instanceID'];
        $username       = $fd['meta_username'];

        $this->model->set_table('users');
        $user       = $this->model->get_by('username',$username);
        $user_id    = $user->id;

        $fields = $this->db->field_data($table_name);
        $ignore = array();
        array_push($ignore,$table_name);

        //print_r($fields); return;

        foreach ($fields as $field) {

            if($field->type == 'point'){
                $gps_prefix  =  substr($field->name,0,-6);
                array_push($ignore,$gps_prefix.'_point');
                array_push($ignore,$gps_prefix.'_lat');
                array_push($ignore,$gps_prefix.'_lng');
                array_push($ignore,$gps_prefix.'_acc');
                array_push($ignore,$gps_prefix.'_alt');
            }

            if($field->type == 'enum') {
                array_push($ignore,$field->name);
            }
        }


        $this->model->set_table('feedback');
        $tmp    = array('table_id' => $instance_id, 'table_name' => $table_name);

        $data   = array(
                'msg' => array(),
                'tbl' => $table_name,
                'tbl_id' => $table_id,
                'created_by' => $user_id
        );

        $feedback   = $this->model->as_array()->get_many_by($tmp);

        $this->model->set_table('users');

        foreach($feedback as $val){

            $user                   = $this->model->as_object()->get($val['replied_by']);
            $val['full_name']       = $user->first_name.' '.$user->last_name;
            $val['time_elapsed']    = $this->time_elapsed_string($val['created_on']);
            array_push($data['msg'],$val);
        }


?>
        <ul class="nav nav-tabs nav-tabs-bottom nav-justified ">
            <li class="nav-item">
                <a href="#form_data-tab1" class="nav-link legitRipple active show" data-toggle="tab"><i class="icon-file-eye mr-2"></i>Data</a>
            </li>
            <li class="nav-item">
                <a href="#form_data-tab3" class="nav-link legitRipple" data-toggle="tab"><i class="icon-bubbles6 mr-2"></i>Chat</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show dbx_wrapper" id="form_data-tab1" style="overflow-y: auto;">
                <?php $this->display_form_data($ignore); ?>
            </div>

            <div class="tab-pane fade dbx_wrapper" id="form_data-tab2" style="overflow-y: auto;">
                <?php //$this->display_map_data($gps_prefix); ?>
            </div>

            <div class="tab-pane fade dbx_wrapper" id="form_data-tab3" style="overflow-y: auto;">
                <?php $this->display_form_discussions($data); ?>
            </div>

        </div>

<?php
    }

    private function display_map_data($gps_prefix){

        $latlon     = '['.$this->input->get($gps_prefix.'_lat').','.$this->input->get($gps_prefix.'_lng').']';
        ?>

        <link rel="stylesheet" href="<?php echo base_url(); ?>vendors/leaflet/css/leaflet.css" />
        <script src="<?php echo base_url(); ?>vendors/leaflet/js/leaflet.js" /></script>

        <div style="width: 100%; height: 600px" id="map1"></div>
        <script type="text/javascript">
                var latlng  = <?php echo $latlon; ?>;
            var map = L.map('map1').setView(latlng, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.marker(latlng).addTo(map)
        </script>
<?php
    }


    private function display_form_data($ignore){

        $table_name = $this->input->get('tn');

        $this->model->set_table('xform_fieldname_map');
        $tmp   = $this->model->get_many_by('table_name',$table_name);
        $mappings   = array();
        foreach($tmp as $val){
            $mappings[$val->col_name]   = $val->field_label;
        }

        $data       = $this->input->get();

        echo '<table class="table datatable-basic dataTable no-footer">';
        foreach($data as $key   => $val){

            if($key == 'tn') continue;
            if(in_array($key,$ignore)) continue;

            if(substr($key,0,5) == 'meta_'){
                //echo substr($key,5).' : '.$val.'<br>';
                $fn = substr($key,5);
            }elseif(array_key_exists($key,$mappings)) {
                //echo $mappings[$key] . ' : ' . $val . '<br>';
                $fn = $mappings[$key];
            }else{
                //echo $key.' : '.$val.'<br>';
                $fn = $key;
            }

            $ext    = pathinfo($val,PATHINFO_EXTENSION);
            if(in_array($ext,array('jpg','jpeg','png','gif'))){
                echo "<tr><td colspan='2'><span class='text-muted'>$fn</span><img src='".base_url('assets/uploads/forms/data/images/').$val."' width='100%'></td></tr>";
            }else{
                echo "<tr><td><strong>".$fn."</strong></td><td>$val</td></tr>";
            }

        }
        echo '</table>';
    }

    private function display_form_discussions($data){

?>


        <div class="p-2">
    <ul id="obox_chat_list" class="media-list media-chat media-chat-scrollable mb-3">
    <?php

    foreach($data['msg'] as $comment) {


        $pic = 'placeholder.jpg';

        if($this->session->userdata('user_id') == $comment['replied_by']){
            $class  = ' media-chat-item-reverse ';
            $pre_icon   = '<div class="ml-3">';
        }else{
            $class  = '';
            $pre_icon   = '<div class="mr-3">';

        }

        $pre_icon   .= '<a href="'.base_url("assets/uploads/") . $pic.'">
                            <img src="'.base_url("assets/uploads/") . $pic.'"
                                 class="rounded-circle" width="40" height="40" alt="">
                        </a>
                    </div>';

        ?>

        <li class="media <?php echo $class; ?>">

            <?php if($class == '') echo $pre_icon ?>
            <div class="media-body">
                <div class="media-chat-item"><?php echo $comment['message']; ?></div>
                <div class="font-size-sm text-muted mt-2"><?php echo $comment['time_elapsed']. ' | '. $comment['full_name']; ?><a href="#"><i
                                class="icon-pin-alt ml-2 text-muted"></i></a></div>
            </div>
            <?php if($class != '') echo $pre_icon ?>
        </li>

        <?php
    }
    ?>



    </ul>

        <textarea id="ref_comment" name="enter-message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>
        <div class="d-flex align-items-center">
            <button type="button" id="obox_comment" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto legitRipple" ref_data="<?php echo base64_encode($data['tbl'].':'.$data['tbl_id']); ?>"><b><i class="icon-paperplane"></i></b> Send</button>
        </div>
        </div>
<?php

    }


    private function add_comment(){

        $ref_data   = explode(":",base64_decode($this->input->post('ref_data')));

        $table      = $ref_data[0];
        $table_id   = $ref_data[1];

        //echo $table.' - '.$table_id; exit();
        
        $this->model->set_table($table);
        $fd         = $this->model->as_array()->get($table_id);
        $instance_id    = $fd['meta_instanceID'];
        $username       = $fd['meta_username'];

        $this->model->set_table('users');
        $user       = $this->model->get_by('username',$username);
        $user_id    = $user->id;

        $data   = array(
            'table_name'         => $table,
            'table_id'      => $instance_id,
            'created_by'    => $user_id,
            'replied_by'    => $this->session->userdata('user_id'),
            'message'       => $this->input->post('comment'),
            'created_on'    => date("Y-m-d H:i:s")
        );

        $this->model->set_table('feedback');

        if($this->model->insert($data)){

            $reply  = '<li class="media  media-chat-item-reverse ">
                    <div class="media-body">
                        <div class="media-chat-item">'.$this->input->post('comment').'</div>
                        <div class="font-size-sm text-muted mt-2">Just now | '.$this->session->userdata('user_id').'<a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                    </div>
                    <div class="ml-3">
                        <a href="http://ez.local/assets/uploads/placeholder.jpg">
                            <img src="http://ez.local/assets/uploads/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                        </a>
                    </div>
                </li>';
        }else{
            $reply = '0';
        }

        echo $reply;

    }


    private function save_vars() {

        $post = $this->input->post ();
        $get = $this->input->get ();

        $db_exp_submit = $this->input->post ( 'db_exp_submit_engaged' );

        if (! empty ( $db_exp_submit ) || @$post ['action'] == 'insert' || @$post ['action'] == 'edit' || @$post ['action'] == 'delete') {
        }
        elseif (! empty ( $db_exp_submit ) ||  @$get ['action'] == 'insert' || @$get ['action'] == 'edit' || @$get ['action'] == 'delete') {
        } else {
            $tmp    = $get + $post;
            $this->session->set_userdata ( 'post', $tmp );
        }

    }
    private function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
