<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$tmp        = $this->perm_tree[$this->module_id]['tasks'][$this->perm_id]->perm_data;
$perm_data  = json_decode($tmp, true);
$table_id 	 = $perm_data['table_id'];
$add_cntr   = $perm_data['add_controller'];

if(!empty($add_cntr)){

    $tmp    = array(
            'user_id' => $this->user_id,
        'my_perm'   => $this->my_perm,
        'perm_cond' => $this->perm_cond
        );
    $args   = http_build_query($tmp);
    //print_r($args);
    $web_data = file_get_contents('http://ad2.local/api/project/add?'.$args);
}else {

    if (!empty ($table_id)) {
        $this->model->set_table('perm_tables');
        $table_name = $this->model->get($table_id)->table_name;

        $this->session->set_userdata('table_id', $table_id);
        $this->session->set_userdata('table_name', $table_name);
    }

    $table_id = $this->session->userdata('table_id');
    $table_name = $this->session->userdata('table_name');

    $this->db_exp->set_form_attribute('class', 'view_table_row');
    $this->db_exp->set_form_attribute('ajax', 'no');
    db_table_render($this, $table_id);

    $this->db_exp->render('insert');
}
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
?>


<div class="content-wrapper" id="ez-detail">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $title; ?></span> - Add </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0" id="ez_content" surl="<?php echo current_url(); ?>">

        <!-- Navbar classes -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List <?php echo $title; ?> contents</h5>

                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?php

                if(!empty($add_cntr)){

                    echo '<div id="add_cntr" class="p-3">'.$web_data.'</div>';
                }else {

                    if ($this->db_exp->is_posted) {

                        $rid = $this->db->insert_id();
                        // refresh page
                        $url = substr(current_url() . $_SERVER['QUERY_STRING'], 0, -1) . 'l';
                        echo '<script> window.location.replace("' . $url . '"); </script>';
                    } else {

                        echo '<div>';
                        echo $this->db_exp->output;
                        echo '</div>';
                    }
                }

                ?>


            </div>


        </div>
        <!-- /navbar classes -->


    </div>
    <!-- /content area -->


    <!-- Footer -->
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            © 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                        </span>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                <li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
                <li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold legitRipple"><span class="text-pink-400"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
            </ul>
        </div>
    </div>
    <!-- /footer -->

</div>


