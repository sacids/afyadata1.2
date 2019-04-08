<?php

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2/8/17
 * Time: 11:51 AM
 */
class aplus extends CI_Controller{

    public $output;

    public function __construct(){
        parent::__construct();

        $this->load->model('model');
        $this->load->model('Perm_model');
        $this->load->library('db_exp');

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

    private function delete_row() {
        $table = $this->input->post ( 'table' );
        $tbl_id = $this->input->post ( 'id' );

        $this->model->set_table($table);
        if($res = $this->model->delete($tbl_id)){
            echo "Delete Success!";
        }else {
            echo "Delete failed!";
        }

        log_message('debug', 'delete '.$res.' : '.$table.' : '.$tbl_id);
    }

    private function save_dbexp_post_vars() {

        $request = $this->input->post () + $this->input->get ();
        $request += array_key_exists('post',$this->session->userdata) ? $this->session->userdata['post'] : array();
        $this->session->set_userdata('post',$request);
        //print_r($request);

        $db_exp_submit = $this->input->post ( 'db_exp_submit_engaged' );
/*
        if (! empty ( $db_exp_submit ) || @$request ['action'] == 'insert' || @$request ['action'] == 'edit' || @$request ['action'] == 'delete') {
            //$request = $post;
        } else {

            $request += array_key_exists('post',$this->session->userdata) ? $this->session->userdata['post'] : array();
            $this->session->set_userdata('post',$request);
        */
    }
    
    private function add_comment(){

        $data   = array(
            'table'         => $this->input->post('table_name'),
            'table_id'      => $this->input->post('table_id'),
            'created_by'    => 1,
            'comment'       => $this->input->post('comment'),
            'created_on'    => date("Y-m-d H:i:s")
        );

        $this->model->set_table('ob_comments');
        echo ($this->model->insert($data) ? 'success' : 'failed');

    }
    public function link_table_action() {

        //$this->load->view('plus/ahead');


        $this->save_dbexp_post_vars ();

        $args = rawurldecode($this->session->userdata ['post'] ['args']);


        $ele_id = $this->session->userdata ['post'] ['ele_id'];
        $table_id = $this->session->userdata ['post'] ['table_action_id'];
        $table_name = $this->session->userdata ['post'] ['ele_table_name'];

        $args = json_decode ( $args, true );

        //print_r($args);

        $to = $args ['to'];
        $oper = $args ['oper'];
        $match = $args ['match'];

        //$res = $this->Perm_model->get_table_data ( $table_name, $match, $ele_id );
        //$match_val = $res [0] [$match];
        
        $available_perms = $this->Perm_model->get_all_perms ();
        $this->db_exp->set_list ( 'perms', $available_perms );

        $res = $this->Perm_model->get_field_data ($match,$table_name,$ele_id);
        $match_val	= $res[$match];


        $rend = $args ['rend'];
        if($this->input->get('action') == 'insert'){
            $rend = 'insert';
        }

        $this->db_table_render ( $table_id );

        switch ($rend) {
            case 'edit' :
                $this->db_exp->set_hidden($to,$match_val);
                $this->db_exp->set_pri_id ( $ele_id );
                $this->db_exp->render ( $rend );
                echo $this->db_exp->output;
                break;
            case 'list' :
                $rend = 'row_list';
                $this->db_exp->set_hidden($to,$match_val);
                $this->db_exp->set_search_condition ( "`" . $to . "` " . $oper . " '" . $match_val . "'" );
                $this->db_exp->render ( $rend );
                echo $this->db_exp->output;
                break;
            case 'insert':
                $this->db_exp->set_hidden($to,$match_val);
                $this->db_exp->set_search_condition ( "`" . $to . "` " . $oper . " '" . $match_val . "'" );
                $this->db_exp->render ( $rend );
                echo $this->db_exp->output;
                break;
            case 'flush table' :
                $cond = $this->get_list_cond ();
                echo $this->table_results ( $table_id, 10, $cond );
                break;
        }
    }

    private function db_table_render($table_id) {

        $res = $this->Perm_model->get_field_data ( 'table_name', 'perm_tables', $table_id );
        $table_name = $res ['table_name'];

        $fields = $this->Perm_model->get_table_data ( 'perm_tables_conf', 'table_id', $table_id );

        //echo '<pre>'; print_r($fields);
        $this->db_exp->set_table ( $table_name );
        if (! $fields) {
            log_message ( 'debug', 'in db_table_render: table has no configs' );
            return;
        }

        foreach ( $fields as $field ) {

            parse_str ( $field ['field_value'], $args );

            $validation = $field['validation'];
            if($validation != ''){
                $this->db_exp->set_validation($field['field_name'],$validation);
            }

            switch ($field ['field_property']) {

                case 'date' :
                    $this->db_exp->set_date ( $field ['field_name'] );
                    break;
                case 'CI db_func' :
                    $func_name = $args ['name'];
                    if ($func_name == 'list_tables') {
                        $options = $this->db->list_tables ();
                        $this->db_exp->set_list ( $field ['field_name'], $options,TRUE );
                    }
                    if ($func_name == 'select_tables') {
                        $options = $this->db->list_tables ();
                        $this->db_exp->set_select ( $field ['field_name'], $options, TRUE );
                    }

                    break;
                case 'password' :
                    $this->db_exp->set_password ( $field ['field_name'] );
                    break;
                case 'password_dblcheck' :
                    $this->db_exp->set_password_dblcheck ( $field ['field_name'] );
                    break;
                case 'label' :
                    $this->db_exp->set_label( $field ['field_name'], $field ['field_value']);
                    break;
                case 'view' :
                    $this->db_exp->set_readonly( $field ['field_name']);
                    break;
                case 'upload' :
                    $this->db_exp->set_upload( $field ['field_name']);
                    break;
                case 'dropdown' :
                    $options = explode ( ",", $field ['field_value'] );
                    $this->db_exp->set_select ( $field ['field_name'], $options, true );
                    break;
                case 'db_dropdown' :
                    $options = explode ( ":", $field ['field_value'] );
                    $cond = false;
                    if (array_key_exists ( 3, $options ))
                        $cond = $options [3];
                    $this->db_exp->set_db_select ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                    break;
                case 'q_dropdown' :
                    $q      = $field ['field_value'];
                    $s      = $this->db->query($q);
                    $o      = array();
                    foreach ($s->result() as $row){
                        $o[$row->id]    = $o[$row->label];
                    }
                    $this->db_exp->set_select ( $field ['field_name'], $options, true );
                    break;

                case 'multiselect':
                    $options = explode ( ",", $field ['field_value'] );
                    $this->db_exp->set_list ( $field ['field_name'], $options, true );
                    break;
                case 'db_multiselect':
                    $options = explode ( ":", $field ['field_value'] );
                    $cond = array_key_exists ( 3, $options ) ? $options [3] : false;
                    $this->db_exp->set_db_list ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                    break;
                case 'textarea' :
                    $this->db_exp->set_textarea ( $field ['field_name'], $field ['field_value'] );
                    break;
                case 'hidden' :
                    $this->db_exp->set_hidden ( $field ['field_name'], $field ['field_value'] );
                    break;
                case 'formula' :
                    $this->db_exp->set_formula ( $field ['field_name'], $field ['field_value'] );
                    break;
                case 'service' :
                    $this->db_exp->set_service ( $field ['field_name'], $field ['field_value'] );
                    break;
                case 'Perm':
                    $available_perms = $this->Perm_model->get_all_perms ();
                    $this->db_exp->set_list ( $field ['field_name'], $available_perms );
                    break;
            }
        }
    }

    private function detail_page(){


        $table_id   = $this->input->post('table_id');
        $id         = $this->input->post('id');

        $this->db_table_render ( $table_id);
        $this->db_exp->set_form_attribute('class','view_table_row');
        $this->db_exp->set_pri_id ( $id );
        $this->db_exp->render ( 'view' );

        echo $this->db_exp->output;
    }
    
    private function comments(){

        $this->save_dbexp_post_vars ();

        $ele_id     = $this->session->userdata ['post'] ['ele_id'];
        $table_name = $this->session->userdata ['post'] ['ele_table_name'];

        $this->model->set_table('ob_comments');
        $tmp    = array('table_id' => $ele_id, 'table' => $table_name);

        $data['data']   = array();
        $tmp2   = $this->model->as_array()->get_many_by($tmp);

        $this->model->set_table('ob_users');

        foreach($tmp2 as $val){

            $user                   = $this->model->as_object()->get($val['created_by']);
            $val['full_name']       = $user->legal_name;
            $val['profile_pic']     = $user->profile_pic;
            $val['time_elapsed']    = $this->time_elapsed_string($val['created_on']);

            array_push($data['data'],$val);
        }

        $this->load->view('obox/comments', $data);
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
    public function setup_perms() {
        $this->save_dbexp_post_vars ();

        $args = $this->session->userdata ['post'] ['args'];
        $ele_id = $this->session->userdata ['post'] ['ele_id'];
        $table_id = $this->session->userdata ['post'] ['table_id'];

        $perm_id = $ele_id;

        $res = $this->Perm_model->get_field_data ( 'perm_type', 'perm_tree', $perm_id );
        $perm_type = trim ( $res ['perm_type'] );

        $fields = array ();
        
        switch ($perm_type) {

            case 'query' :
                $fields ['table'] ['type'] = 'select';
                $fields ['select'] ['type'] = 'text';
                break;
            case 'table' :
                $this->db_exp->set_json_field ( 'perm_data', array (
                    'table_id',
                    'controller',
                    'action',
                    'add_controller'
                ) );
                
                //echo 'jembe'; $this->session->userdata ( 'user_id' ) ;
                
                //$this->db_exp->set_db_select ( 'table_id', 'perm_tables', 'id', 'label', 'module_id = "' . $this->session->userdata ( 'module_id' ) . '"' );
                $this->db_exp->set_db_select ( 'table_id', 'perm_tables', 'id', 'label');
                $this->db_exp->set_select ( 'action', array('list','new'),true);
                $this->db_exp->set_hidden ( 'controller', 'aplus/manage_table' );
                $this->db_exp->set_input ( 'add_controller' );
                $this->db_exp->set_hidden ( array (
                    'id',
                    'icon_font'
                ) );
                break;
            case 'table_list' :
                $this->db_exp->set_json_field ( 'perm_data', array (
                    'table_id',
                    'show',
                    'controller'
                ) );
                $this->db_exp->set_db_select ( 'table_id', 'perm_tables', 'id', 'label', 'module_id = "' . $this->session->userdata ( 'module_id' ) . '"' );
                $this->db_exp->set_input ( 'show' );
                $this->db_exp->set_hidden ( 'controller', 'aplus/list_table_data' );
                break;
            case 'db_select' :
                $this->db_exp->set_json_field ( 'perm_data', array (
                    'table',
                    'value',
                    'label',
                    'name',
                    'controller'
                ) );
                $this->db_exp->set_input ( 'table' );
                $this->db_exp->set_input ( 'value' );
                $this->db_exp->set_input ( 'label' );
                $this->db_exp->set_input ( 'name' );
                $this->db_exp->set_input ( 'controller' );
                break;
            default :
                $this->db_exp->set_label ( 'perm_data', 'Set controler route' );
                break;
        }

        $this->db_exp->set_table ( 'perm_tree' );
        $this->db_exp->set_pri_id ( $perm_id );
        $this->db_exp->set_hidden ( array (
            'perms',
            'perm_target',
            'parent_id',
            'module_id',
            'title',
            'perm_type'
        ) );

        $this->db_exp->render ();
        echo $this->db_exp->output;
    }
    public function setup_table() {

        $this->save_dbexp_post_vars ();

        $args = $this->session->userdata ['post'] ['args'];
        $ele_id = $this->session->userdata ['post'] ['ele_id'];
        $table_id = $this->session->userdata ['post'] ['table_id'];

        $this->db_exp->set_table ( 'perm_tables_conf' );
        $this->db_exp->set_search_condition ( "table_id = '" . $ele_id . "'" );
        $this->db_exp->set_hidden ( 'table_id', $ele_id );

        $res = $this->Perm_model->get_field_data ( 'table_name', 'perm_tables', $ele_id );
        $table_name = $res ['table_name'];

        $fields = $this->Perm_model->get_table_fields ( $table_name );

        $this->db_exp->set_select ( 'field_name', $fields, true );

        $field_property = array (
            'hidden',
            'input',
            'view',
            'password',
            'password_dblcheck',
            'label',
            'upload',
            'textarea',
            'dropdown',
            'db_dropdown',
            'q_dropdown',
            'multiselect',
            'db_multiselect',
            'checkbox',
            'radio',
            'CI db_func',
            'formula',
            'service',
            'Perm',
            'date',
            'time',
            'date_range'
        );
        $this->db_exp->set_select ( 'field_property', $field_property, true );

        $action = $this->input->get ( 'action' );

        switch ($action) {

            case 'edit' :
                $this->db_exp->set_pri_id($this->input->get ( 'id' ));
            case 'insert' :
                $act = 'insert';
                break;
            case 'delete':
                $_POST['id']    = $this->input->get ( 'id' );
                $act = 'delete';
                break;
            default :
                $act = 'row_list';
                break;
        }

        $this->db_exp->render ( $act );
        echo $this->db_exp->output;
    }

    private function set_table_actions() {

        $request = $this->input->post () + $this->input->get ();
        
        //echo '<pre>';print_r($request);echo '</pre>';

        if (array_key_exists ( 'ele_id', $request )) {
            $this->db_exp->set_search_condition ( "table_id = '" . $request ['ele_id'] . "'" );
            $this->session->set_userdata ( 'table_id', $request ['ele_id'] );

        } else {
            $this->db_exp->set_search_condition ( "table_id = '" . $this->session->userdata ( 'table_id' ) . "'" );


        }

        $this->db_exp->set_table ( 'perm_tabs' );
        $this->db_exp->set_hidden ( 'table_id', $this->session->userdata ( 'table_id' ) );

        $tables = $this->Perm_model->get_table_data ( 'perm_tables', 'module_id', $this->session->userdata ( 'module_id' ) );
        $options = array (
            '0' => 'Controller'
        );
        //echo '<pre>'; print_r($tables);echo '</pre>';
        foreach ( $tables as $table ) {
            $key = $table ['id'];
            $val = $table ['label'];
            $options [$key] = $val;
        }

        $sort_order	= array('1','2','3','4','5','6','7','8','9');
        $this->db_exp->set_select ( 'sort_order', $sort_order );

        $table_A = $this->Perm_model->get_field_data ( 'table_name', 'perm_tables', $this->session->userdata ( 'table_id' ) );
        $table_A_fields = $this->Perm_model->get_table_fields ( $table_A ['table_name'] );

        // echo 'sema';

        $id = ( array_key_exists ( 'id', $request ) ? $request ['id'] : 0 );
        //$id = ( array_key_exists ( 'id', $get  ) ? $get['id'] : $id);
        
        $action = ( array_key_exists ( 'action', $request ) ? $request ['action'] : 'default' );
        //$action = ( ($action == 'default' && array_key_exists ( 'action', $get )) ? $get['action'] : 'default');

        if ($id) {

            $new_table_id = $this->Perm_model->get_field_data ( 'table_action_id', 'perm_tabs', $id );
            $new_table_id = $new_table_id ['table_action_id'];

            if ($new_table_id == 0) {
                $this->db_exp->set_hidden ( 'perms' );
            } else {
    
                $table_B = $this->Perm_model->get_field_data ( 'table_name', 'perm_tables', $new_table_id );
                $table_B_fields = $this->Perm_model->get_table_fields ( $table_B ['table_name'] );

                // $table_B_fields = $this->Perm_model->get_table_fields ( $table_B['table_name'] );
                $this->db_exp->set_select ( 'to', $table_B_fields, TRUE );

                $this->db_exp->set_json_field ( 'args', array (
                    'match',
                    'oper',
                    'to',
                    'rend'
                ) );
                $this->db_exp->set_select ( 'match', $table_A_fields, TRUE );
                $this->db_exp->set_select ( 'oper', array (
                    'like',
                    '=',
                    '!=',
                    '<',
                    '>'
                ), TRUE );
                $this->db_exp->set_select ( 'rend', array (
                    'list',
                    'insert',
                    'edit',
                    'flush table'
                ), TRUE );
            }
        }

        switch ($action) {

            case 'edit' :
                $this->db_exp->set_pri_id($id);
                $this->db_exp->set_hidden ( 'id', $id );
                $this->db_exp->set_hidden ( array (
                    'title',
                    'icon',
                    'table_action_id',
                    'perms'
                ) );

                $act = 'edit';
                break;
            case 'insert' :
                // echo 'inserto';
                $this->db_exp->set_select ( 'table_action_id', $options );
                $this->db_exp->set_hidden ( 'args' );
                $this->db_exp->set_hidden ( 'perms' );
                $act = 'insert';
                break;
            default :
                // echo 'listo';
                $this->db_exp->set_select ( 'table_action_id', $options );
                $this->db_exp->set_hidden ( 'args' );
                $act = 'row_list';
                break;
        }

        $this->db_exp->render ( $act );
        echo $this->db_exp->output;
        //print_r($this->output);
    }
    public function set_option_perms() {
        $this->save_dbexp_post_vars ();

        $perm_id = $this->session->userdata ['post'] ['ele_id'];
        $available_perms = $this->Perm_model->get_all_perms ();

        // print_r($available_perms);

        $this->db_exp->set_table ( 'perm_tree' );
        $this->db_exp->set_list ( 'perms', $available_perms );
        $this->db_exp->set_hidden ( array (
            'title',
            'icon_font',
            'perm_target',
            'perm_type',
            'perm_data',
            'id',
            'module_id',
            'parent_id'
        ) );
        $this->db_exp->set_pri_id ( $perm_id );
        $this->db_exp->set_default_action ( "edit" );

        $this->db_exp->render ();
        echo $this->db_exp->output;
    }
    public function set_add_perms() {
        $this->set_ad_perms ( 'add' );
    }
    public function set_del_perms() {
        $this->set_ad_perms ( 'delete' );
    }
    public function set_ad_perms($cat = 'add') {
        $this->save_dbexp_post_vars ();

        $perm_id = $this->session->userdata ['post'] ['ele_id'];
        // get id with perm id
        $res = $this->Perm_model->get_data_from_table ( 'perm_config', "perm_tree_id = '" . $perm_id . "' and category = '" . $cat . "'" );
        if ($res) {
            $pkey = $res [0] ['id'];
            $this->db_exp->set_pri_id ( $pkey );
            $this->db_exp->set_default_action ( "edit" );
        } else {
            $this->db_exp->set_default_action ( "insert" );
        }

        $available_perms = $this->Perm_model->get_all_perms ();

        $this->db_exp->set_table ( 'perm_config' );
        $this->db_exp->set_list ( 'perms', $available_perms );
        $this->db_exp->set_hidden ( array (
            'perm_tree_id' => $perm_id,
            'description',
            'filters',
            'id'
        ) );
        $this->db_exp->set_hidden ( 'category', $cat );

        $this->db_exp->render ();
        echo $this->db_exp->output;
    }
    public function set_list_perms() {

        $this->save_dbexp_post_vars ();
        // print_r($post);

        $perm_id = $this->session->userdata ['post'] ['ele_id'];

        // get table id
        $res = $this->Perm_model->get_field_data ( 'perm_data', 'perm_tree', $perm_id );
        $json = json_decode ( $res ['perm_data'], true );
        $tbl_id = $json ['table_id'];

        // get table name
        $res = $this->Perm_model->get_field_data ( 'table_name', 'perm_tables', $tbl_id );
        $table_name = $res ['table_name'];

        // get available filters
        $res = $this->Perm_model->get_table_data ( 'perm_filter', 'table_name', $table_name );

        if (! $res) {

            // no filters available
            echo '<br>No filters available for ' . $table_name;
            return;
        }

        $available_filters = array ();
        foreach ( $res as $val ) {
            $key = $val ['id'];
            $label = $val ['title'] . ' : ' . $val ['description'];
            $available_filters [$key] = $label;
        }

        $available_perms = $this->Perm_model->get_all_perms ();

        $this->db_exp->set_table ( 'perm_config' );
        $this->db_exp->set_hidden ( 'perm_tree_id', $perm_id );
        $this->db_exp->set_hidden ( 'category', 'list' );
        $this->db_exp->set_textarea ( 'description' );
        $this->db_exp->set_search_condition ( "perm_tree_id = '" . $perm_id . "' AND category = 'list'" );
        $this->db_exp->set_list ( 'filters', $available_filters );
        $this->db_exp->set_list ( 'perms', $available_perms );
        $this->db_exp->set_default_action ( "row_list" );
        $this->db_exp->render ();

        echo $this->db_exp->output;
    }
    public function set_tab_perms() {

        $this->save_dbexp_post_vars ();
        
        $perm_id = $this->session->userdata ['post'] ['ele_id'];

        $res = $this->Perm_model->get_field_data ( 'perm_data', 'perm_tree', $perm_id );
        $data = json_decode ( $res ['perm_data'], true );

        if (empty ( $data ['table_id'] )) {

            echo 'no tabs available';
            return;
        }

        $table_id = $data ['table_id'];
        // get available filters
        $res = $this->Perm_model->get_table_data ( 'perm_tabs', 'table_id', $table_id );
        if (! $res) {
            // no filters available
            echo '<br>No Tabs available';
            return;
        }

        $available_tabs = array ();
        foreach ( $res as $val ) {
            $key = $val ['id'];
            $label = $val ['title'];
            $available_tabs [$key] = $label;
        }

        $available_perms = $this->Perm_model->get_all_perms ();

        $this->db_exp->set_table ( 'perm_config' );
        $this->db_exp->set_hidden ( 'perm_tree_id', $perm_id );
        $this->db_exp->set_hidden ( 'category', 'tab' );
        $this->db_exp->set_textarea ( 'description' );
        $this->db_exp->set_search_condition ( "perm_tree_id = '" . $perm_id . "' AND category = 'tab'" );
        $this->db_exp->set_list ( 'filters', $available_tabs );
        $this->db_exp->set_list ( 'perms', $available_perms );
        $this->db_exp->set_default_action ( "row_list" );
        
        if(array_key_exists('action', $this->input->get())){
            
            switch($this->input->get('action')){
                
                case 'insert':
                    $this->db_exp->set_default_action ( "insert" );
                    break;
                case 'list':
                    $this->db_exp->set_default_action ( "row_list" );
                    break;
                case 'delete':
                    $this->db_exp->set_default_action ( "delete" );
                    break;
                case 'edit':
                    $this->db_exp->set_default_action ( "edit" );
                    $this->db_exp->set_pri_id($this->input->get('id'));
                    break;
                default:
                    $this->db_exp->set_default_action ( "row_list" );
                    break;  
            }
        }
        
        $this->db_exp->render ();
        echo $this->db_exp->output;
        
    }

    public function testo(){

        echo 'me webs ervice';
    }
    public function filter_config() {
         
        //$this->load->view('plus/ahead');
        
        $this->save_dbexp_post_vars ();

        $args = $this->session->userdata ['post'] ['args'];
        $ele_id = $this->session->userdata ['post'] ['ele_id'];
        $table_id = $this->session->userdata ['post'] ['table_id'];

        $res = $this->Perm_model->get_field_data ( 'table_name', 'perm_filter', $ele_id );
        $table_name = $res ['table_name'];

        $this->db_exp->set_table ( 'perm_filter_config' );
        $this->db_exp->set_search_condition ( "perm_filter_id = '" . $ele_id . "'" );
        $this->db_exp->set_hidden ( 'perm_filter_id', $ele_id );
        $this->db_exp->set_select ( 'oper', array (
            '>',
            '<',
            '=',
            'in',
            'not in'
        ), true );
        $this->db_exp->set_select ( 'field_name', $this->Perm_model->get_table_fields ( $table_name ), true );
        $this->db_exp->set_default_action ( 'row_list' );
        $this->db_exp->render ();
        echo $this->db_exp->output;
        
        
        //$this->load->view('plus/afoot');
    }

}