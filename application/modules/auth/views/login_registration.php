<?php

function show_message($message)
{
    ?>
    <div class="alert alert-primary alert-styled-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold"><?php echo $message; ?></span>
    </div>

    <?php
}
?>

<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Registration form -->
                <?php echo form_open("auth/register",array('class'=>'login-form form-validate'));?>
					<div class="card mb-0">
						<div class="card-body">


                            <?php if($message != '') show_message($message); ?>



							<div class="text-center mb-3">

								<h5 class="mb-0">Create account</h5>
								<span class="d-block text-muted">All fields are required</span>
							</div>

							<div class="form-group text-center text-muted content-divider">
								<span class="px-2">Your credentials</span>
							</div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <?php echo form_input($first_name);?>
                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <?php echo form_input($last_name);?>
                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <?php echo form_input($company);?>
                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
							<div class="form-group form-group-feedback form-group-feedback-left">
                                <?php echo form_input($email);?>
								<div class="form-control-feedback">
									<i class="icon-mention text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
                                <?php echo form_input($password);?>
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
							</div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <?php echo form_input($password_confirm);?>
                                <div class="form-control-feedback">
                                    <i class="icon-user-lock text-muted"></i>
                                </div>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-input-styled" data-fouc>
                                    Accept <a href="#">terms of service</a>
                                </label>
                            </div>

							<button type="submit" class="btn bg-teal-400 btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>
						</div>
					</div>
				</form>
				<!-- /registration form -->

			</div>
			<!-- /content area -->


		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
