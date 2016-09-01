<!-- Page Title -->
<div class="section section-breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Login</h1>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-7">
				<div class="basic-login">
					<!-- <form role="form" role="form"> -->
					<?= $this->Flash->render('auth') ?>
					<?= $this->Form->create()?>
						<div class="form-group">
							<label for="login-username"><i class="icon-user"></i> <b>Email</b></label>
							<!-- 
							<input class="form-control" id="login-username" type="text"
								placeholder="">
							-->
							<?= $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => '')) ?>
						</div>
						<div class="form-group">
							<label for="login-password"><i class="icon-lock"></i> <b>Password</b></label>
							<!--  
							<input class="form-control" id="login-password"
								type="password" placeholder="">
							-->
							<?= $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => ''))?>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<!-- show captcha image html -->
							    <?= captcha_image_html() ?>
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
							<label class="checkbox"> <input type="checkbox"> Remember me
							</label> <a href="page-password-reset.html"
								class="forgot-password">Forgot password?</a>
							<button type="submit" class="btn pull-right">Login</button>
							<div class="clearfix"></div>
						</div>
					<!-- </form> -->
					<?= $this->Form->end() ?>
				</div>
			</div>
			<div class="col-sm-5 social-login">
				<div class="clearfix"></div>
				<div class="not-member">
					<p>
						Not a member?
					</p>
				</div>
				<div class="row">
					<p>
						<i class="glyphicon glyphicon-user"></i>
						<b>Buyer</b> <a href="register?as=2">Register here</a>
					</p>
					<p>
						<i class="glyphicon glyphicon-road"></i>
						<b>Seller</b> <a href="register?as=1">Register here</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>