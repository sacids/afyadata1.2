<h1><?php echo lang('reset_password_heading'); ?></h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php

	$attributes = array('class' => 'email', 'id' => 'myform');
	echo form_open('auth/set_password/', $attributes);

?>

	<p>
		<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
		<?php echo form_input($new_password);?>
	</p>

	<p>
		<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
		<?php echo form_input($new_password_confirm);?>
	</p>

	<?php echo form_input($user_id);?>

	<p><?php echo form_submit(array('name'=>'submit','class'=>'dbx_submit'), lang('reset_password_submit_btn'));?></p>

<?php echo form_close();?>