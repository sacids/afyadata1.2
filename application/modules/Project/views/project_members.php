
<script src="<?php echo base_url(); ?>vendors/ez/js/db_exp.js"></script>

<?php

$q = "SELECT * FROM users WHERE id IN (SELECT user_id FROM users_groups WHERE group_id = '$gid')";
$cond = "id IN (SELECT user_id FROM users_groups WHERE group_id = '$gid')";

$this->db_exp->set_table('users');
$this->db_exp->set_search_condition($cond);

//$this->db_exp->set_form_action('project/view/form/data?');
$this->db_exp->set_default_action('row_list');
$this->db_exp->set_arg_link(base_url('auth/set_password?tn=users'),'form_data','Set Password');
$this->db_exp->show_submit_button = false;
$this->db_exp->show_insert_button = false;
$this->db_exp->show_delete_button = false;
$this->db_exp->show_edit_button = false;
//$this->db_exp->set_hidden('meta_instanceID');
$this->db_exp->render();

?>

<div class="row">
    <div class="col-md-8">
        <?php echo $this->db_exp->output; ?>
    </div>
    <div class="hidden col-md-4 border-1 p-4" id="form_data" style="border-color: #ddd; max-height: 600px; overflow-y: scroll">

    </div>
</div>
