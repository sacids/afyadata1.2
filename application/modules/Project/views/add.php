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

include_once FCPATH.'/vendors/ez/php/db_table_render.php';
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
                            © 2015 - 2018. <a href="#">AfyaData Community Based Surveillance Kit</a> by <a href="www.sacids.org" target="_blank">SACIDS</a>
                        </span>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                <li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
            </ul>
        </div>
    </div>
    <!-- /footer -->

</div>


