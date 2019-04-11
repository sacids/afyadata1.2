

<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */

    $form_id    = $this->session->userdata('form_id');
    $project_id = $this->session->userdata('project_id');
    $group_id = $this->session->userdata('group_id');

    $available_perms = $this->Perm_model->get_all_project_perms ($project_id,$group_id);
    $available_perms = $this->Perm_model->get_all_perms();

    $this->db_exp->set_table ( 'xforms' );
    $this->db_exp->set_hidden ( array('id','project_id','title','description','access','status','form_id','created_at','created_by', 'attachment','filename','date_created','last_updated','push','jr_form_id','allow_dhis','dhis_date_set','org_unit','period_type','has_symptoms','has_specie_type_field') );

    $this->db_exp->set_list ( 'perms', $available_perms );

    $this->db_exp->set_pri_id ( $form_id );
    $this->db_exp->set_default_action ( "edit" );

    $this->db_exp->render ();
    echo $this->db_exp->output;


