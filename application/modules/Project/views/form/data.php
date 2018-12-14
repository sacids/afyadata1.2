

<script src="<?php echo base_url(); ?>vendors/ez/js/db_exp.js"></script>

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

// get user permissions from filters of particular

// get table mappings
$this->model->set_table('xform_field_map');
$mappings   = $this->model->get_many_by('table_name',$table_name);

$this->db_exp->set_table($table_name);

foreach($mappings as $field){
    $this->db_exp->set_label($field->col_name,$field->field_label);
    if($field->hide) $this->db_exp->set_hidden($field->col_name);
}



$this->db_exp->set_form_action('project/view/form/data?');
$this->db_exp->set_default_action('row_list');
$this->db_exp->set_arg_link('test','test','test');
$this->db_exp->set_hidden('meta_instanceID');
$this->db_exp->render();

?>

<div class="row">
    <div class="col-md-8 mr-1">
        <?php echo $this->db_exp->output; ?>
    </div>
    <div class="col-md-4 ml-1">
        jembe
    </div>
</div>
