<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 11/12/2018
 * Time: 22:08
 */

function db_table_render($obj, $table_id) {

    $obj->model->set_table('perm_tables');

    //echo $table_id;
    $table_name = $obj->model->get($table_id)->table_name;

    //print_r($res);
    $obj->model->set_table('perm_tables_conf');
    $fields = array_filter($obj->model->as_array()->get_many_by('table_id',$table_id));


    $obj->db_exp->set_table ( $table_name );
    if (! sizeof($fields)) {
        log_message ( 'debug', 'in db_table_render: table has no configs' );
        return;
    }

    foreach ( $fields as $field ) {

        parse_str ( $field ['field_value'], $args );

        $validation = $field['validation'];
        if($validation != ''){
            $obj->db_exp->set_validation($field['field_name'],$validation);
        }

        switch ($field ['field_property']) {

            case 'date' :
                $obj->db_exp->set_date ( $field ['field_name'] );
                break;
            case 'CI db_func' :
                $func_name = $args ['name'];
                if ($func_name == 'list_tables') {
                    $options = $obj->db->list_tables ();
                    $obj->db_exp->set_list ( $field ['field_name'], $options,TRUE );
                }
                if ($func_name == 'select_tables') {
                    $options = $obj->db->list_tables ();
                    $obj->db_exp->set_select ( $field ['field_name'], $options, TRUE );
                }

                break;
            case 'password' :
                $obj->db_exp->set_password ( $field ['field_name'] );
                break;
            case 'password_dblcheck' :
                $obj->db_exp->set_password_dblcheck ( $field ['field_name'] );
                break;
            case 'label' :
                $obj->db_exp->set_label( $field ['field_name'], $field ['field_value']);
                break;
            case 'view' :
                $obj->db_exp->set_readonly( $field ['field_name']);
                break;
            case 'upload' :
                $obj->db_exp->set_upload( $field ['field_name']);
                break;
            case 'dropdown' :
                $options = explode ( ",", $field ['field_value'] );
                $obj->db_exp->set_select ( $field ['field_name'], $options, true );
                break;
            case 'db_dropdown' :
                $options = explode ( ":", $field ['field_value'] );
                $cond = false;
                if (array_key_exists ( 3, $options ))
                    $cond = $options [3];
                $obj->db_exp->set_db_select ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                break;
            case 'q_dropdown' :
                $q      = $field ['field_value'];
                $s      = $obj->db->query($q);
                $o      = array();
                foreach ($s->result() as $row){
                    $o[$row->id]    = $row->label;
                }
                $obj->db_exp->set_select ( $field ['field_name'], $o);
                break;
            case 'multiselect':
                $options = explode ( ",", $field ['field_value'] );
                $obj->db_exp->set_list ( $field ['field_name'], $options, true );
                break;
            case 'db_multiselect':
                $options = explode ( ":", $field ['field_value'] );
                $cond = array_key_exists ( 3, $options ) ? $options [3] : false;
                $obj->db_exp->set_db_list ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                break;
            case 'textarea' :
                $obj->db_exp->set_textarea ( $field ['field_name'], $field ['field_value'] );
                break;
            case 'hidden' :
                $value = $field ['field_value'];
                if(substr($value,0,2) == "##"){
                    // session value
                    $value			= $obj->session->userdata(substr($value,2));
                }
                if(substr($value,0,2) == "__"){
                    // class variable
                    $value			= $obj->{substr($value,2)};
                }
                $obj->db_exp->set_hidden ( $field ['field_name'], $value );
                break;
            case 'formula' :
                $obj->db_exp->set_formula ( $field ['field_name'], $field ['field_value'] );
                break;
            case 'service' :
                $obj->db_exp->set_service ( $field ['field_name'], $field ['field_value'] );
                break;
            case 'Perm':
                $available_perms = $obj->Perm_model->get_all_perms ();
                $obj->db_exp->set_list ( $field ['field_name'], $available_perms );
                break;
        }
    }
}