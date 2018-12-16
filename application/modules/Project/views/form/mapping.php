

<script src="<?php echo base_url(); ?>vendors/ez/js/db_exp.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */


//echo $this->session->userdata('form_id');


$this->model->set_table('xforms');
$xform      = $this->model->get($this->session->userdata('form_id'));
$table_name = $xform->form_id;

$this->db_exp->set_table('xform_field_map');
$this->db_exp->set_search_condition("table_name = '$table_name'");
$this->db_exp->set_form_action('project/view/form/mapping?');
$this->db_exp->set_default_action('row_list');
$this->db_exp->show_insert_button = false;
$this->db_exp->show_delete_button = false;
$this->db_exp->set_hidden(array('table_name','col_name'));
$this->db_exp->render();
echo $this->db_exp->output;