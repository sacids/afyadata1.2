<?php

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2/8/17
 * Time: 11:51 AM
 */
class Project extends CI_Controller{

    public $output;

    public function __construct(){
        parent::__construct();

        $this->load->model('model');
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

    private function save_dbexp_post_vars() {

        $request = $this->input->post () + $this->input->get ();
        $request += array_key_exists('post',$this->session->userdata) ? $this->session->userdata['post'] : array();
        $this->session->set_userdata('post',$request);
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


    public function add(){

        //print_r($this->session->userdata('user_id'));
        $this->db_exp->set_table('projects');
        $this->db_exp->set_hidden('created_by',$this->input->get('user_id'));
        $this->db_exp->set_hidden('created_at',date('Y-m-d H:m:i'));
        $this->db_exp->set_hidden('perms');
        $this->db_exp->set_textarea('description');
        $this->db_exp->render('insert');
        echo $this->db_exp->output;

        if($this->db_exp->is_posted){

            // create group
            $data   = array('name' => $this->input->post('title'),'description' => $this->input->post('description'));
            $this->model->set_table('groups');
            if($gid = $this->model->insert($data)) {

                $pid    = $this->db_exp->insert_id;
                $perms  = 'P' . $this->input->post('created_by') . 'P,G' . $gid . 'G';
                $data = array('perms' => $perms,'group_id' => $gid);
                $this->model->set_table('projects');
                $this->model->update($pid,$data);
            }



        }
    }

}