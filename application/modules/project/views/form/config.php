

<script src="<?php echo base_url(); ?>vendors/ez/js/db_exp.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */


//echo $this->session->userdata('form_id');
$yn = array('No','Yes');

$this->model->set_table('xform_config');

if($this->model->count_by('form_id',$this->session->userdata('form_id'))){
    $xf_config  = $this->model->get_by('form_id',$this->session->userdata('form_id'));
    $xf_id      = $xf_config->id;
    $this->db_exp->set_default_action('edit');
    $this->db_exp->set_pri_id($xf_id);
}else{
    $this->db_exp->set_default_action('insert');
}

$this->db_exp->set_table('xform_config');
//$this->db_exp->set_form_action('project/view/form/config?');
$this->db_exp->set_select('push',$yn);
$this->db_exp->set_select('has_feedback',$yn);
$this->db_exp->set_select('use_ohkr',$yn);
$this->db_exp->set_select('has_map',$yn);
$this->db_exp->set_select('has_charts',$yn);
$this->db_exp->set_select('allow_dhis',$yn);

$this->db_exp->set_hidden('form_id',$this->session->userdata('form_id') );
$this->db_exp->render();
echo $this->db_exp->output;