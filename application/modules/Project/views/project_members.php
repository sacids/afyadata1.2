
<script src="<?php echo base_url(); ?>vendors/ez/js/db_exp.js"></script>

<?php

$q = "SELECT * FROM users WHERE id IN (SELECT user_id FROM users_groups WHERE group_id = '$gid')";
$cond = "id IN (SELECT user_id FROM users_groups WHERE group_id = '$gid')";

$this->db_exp->set_table('users');
$this->db_exp->set_search_condition($cond);

//$this->db_exp->set_form_action('project/view/form/data?');
$this->db_exp->set_default_action('row_list');
//$this->db_exp->set_arg_link(base_url('api/v3/form_data/item?tn='.$table_name),'form_data','Manage');
$this->db_exp->show_submit_button = false;
$this->db_exp->show_insert_button = false;
$this->db_exp->show_delete_button = false;
$this->db_exp->show_edit_button = false;
//$this->db_exp->set_hidden('meta_instanceID');
$this->db_exp->render();

?>

<div class="row">
    <div class="col-md-12">
        <?php echo $this->db_exp->output; ?>
    </div>
</div>
