

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

$field_type_options = array('TEXT' => "Text",
                                        'INT'
                                        => "Number",
                                        "GPS" => "GPS Location",
                                        "DATE" => "DATE",
                                        "DALILI" => 'Dalili',
                                        "LAT" => "Latitude",
                                        "LONG" => "Longitude",
                                        "IDENTITY" => "Username/Identity",
                                        "IMAGE" => "Image",
                                        "DISTRICT" => "District",
                                        "SPECIE" => "Specie"
                                    );

$this->db_exp->set_table('xform_fieldname_map');
$this->db_exp->set_search_condition("table_name = '$table_name'");
$this->db_exp->set_form_action('project/view/form/mapping?');
$this->db_exp->set_default_action('row_list');
$this->db_exp->set_select('field_type',$field_type_options);
$this->db_exp->set_select('chart',array(0 => 'None',1 => 'Sum', '2' => 'Count', '3' => 'Avg'));
$this->db_exp->show_insert_button = false;
$this->db_exp->show_delete_button = false;
$this->db_exp->set_hidden(array('table_name','col_name'));
$this->db_exp->render();
echo $this->db_exp->output;
