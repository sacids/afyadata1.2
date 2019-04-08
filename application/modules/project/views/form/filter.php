


<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */

//<script src="echo base_url(); vendors/ez/js/db_exp.js">

$this->model->set_table('xforms');
$xform      = $this->model->get($this->session->userdata('form_id'));
$table_name = $xform->form_id;

// get user permissions from filters of particular


$this->db_exp->set_table('perm_filter');
$this->db_exp->set_search_condition("table_name = '$table_name'");
$this->db_exp->set_hidden('table_name',$table_name);
$this->db_exp->set_arg_link(base_url('api/aplus/filter_config'),'jembe','Manage');


$this->db_exp->set_form_action('project/view/form/filter?');
$this->db_exp->set_default_action('row_list');
$this->db_exp->render();



echo '    <div class="row">
            <div class="col" id="soson">'.$this->db_exp->output.'</div>
            <div class="col" id="jembe"> jembe </div>
          </div> ';