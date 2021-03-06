<!-- Page Title -->
<div class="section section-breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Register</h1>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="basic-login">
					<!-- <form role="form"> -->
					<?= $this->Form->create($user)?>
						<div class="form-group">
							<label for="register-username"><i class="icon-user"></i> <b>Email</b></label>
							<!-- 
							<input class="form-control" id="register-username" type="text"
								placeholder="">
							-->
							<?= $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => '')) ?>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="register-password"><i class="icon-lock"></i> <b>Password</b></label>
								<!--  
								<input class="form-control" id="register-password"
									type="password" placeholder="">
								-->
								<?= $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => ''))?>
							</div>
							<div class="form-group col-md-6">
								<label for="register-password2"><i class="icon-lock"></i> <b>Re-enter
									Password</b></label>
								<!--   
								<input class="form-control"
									id="register-password2" type="password" placeholder="">
								-->
								<?= $this->Form->input('password2', array('label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => ''))?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<!-- show captcha image html -->
							    <?= captcha_image_html() ?>
							    <script type="text/javascript">
							    jQuery("[title$='Validation']").text('enter the code to the right, please').attr('href', '#CaptchaCode').removeAttr('title');
							    </script>
							</div>
							<div class="form-group col-md-6">
								<!-- Captcha code user input textbox -->
							    <?= $this->Form->input('CaptchaCode', [
							    	'label' => '',
									'class' => 'form-control',
							    	'maxlength' => '10',
							    	'placeholder' => 'BotDetect code here, please.',
							    	'id' => 'CaptchaCode'
							    ]) ?>
							</div>
						</div>	
						<div class="form-group">
							<?php
							$role = -1;
							$registerstr = "Register as a ";
							if (empty($as)) {
								$registerstr .= "buyer";
								$role = 2;
							}
							else {
								$registerstr .= ($as == 2 ? "buyer" : ($as == 1 ? "seller" : "buyer"));
								$role = in_array($as, [1, 2]) ? $as : 2;
							}
							?>
							<?= $this->Form->input('role', array('type' => 'hidden', 'value' => $role))?>
							<button type="submit" class="btn pull-right">
							<?= $registerstr ?>
							</button>
							<div class="clearfix"></div>
						</div>
					<!-- </form> -->
					<?= $this->Form->end() ?>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>

	</div>
</div>