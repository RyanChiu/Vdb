<?php
//$usr = $this->request->session()->read('Auth.User');
?>

<div class="section"><div class="container">

	<?= $this->Form->create($user) ?>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="profile-username"><b>Username</b></label>
			<?= 
			$this->Form->input(
				'username',
				array(
					'id' => 'profile-username',
					'label' => false,
					'class' => 'form-control', 
					'type' => 'text',
					'placeholder' => 'Email as the username.'
				)
			) 
			?>
		</div>
		<div class="form-group col-md-3">
			<label for="profile-password"><b>Password</b></label>
			<?= 
			$this->Form->input(
				'password', 
				array(
					'id' => 'profile-password',
					'label' => false, 
					'class' => 'form-control', 
					'type' => 'password', 
					'placeholder' => ''
				)
			) 
			?>
		</div>
		<div class="form-group col-md-3">
			<label for="profile-password2"><b>Re-enter Password</b></label>
			<?= 
			$this->Form->input(
				'password2', 
				array(
					'id' => 'profile-password2',
					'label' => false, 
					'class' => 'form-control', 
					'type' => 'password', 
					'placeholder' => ''
				)
			) 
			?>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="profile-socialid"><b>Social ID</b></label>
			<?= 
			$this->Form->input(
				'socialid',
				array(
					'id' => 'profile-socialid',
					'label' => false,
					'class' => 'form-control', 
					'type' => 'text',
					'placeholder' => ''
				)
			) 
			?>
		</div>
		<div class="form-group col-md-6">
			<label for="profile-address"><b>Address</b></label>
			<?= 
			$this->Form->input(
				'address', 
				array(
					'id' => 'profile-address',
					'label' => false, 
					'class' => 'form-control', 
					'type' => 'test', 
					'placeholder' => ''
				)
			) 
			?>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="profile-phonenum"><b>Phone Number</b></label>
			<?= 
			$this->Form->input(
				'phonenum',
				array(
					'id' => 'profile-phonenum',
					'label' => false,
					'class' => 'form-control', 
					'type' => 'text',
					'placeholder' => ''
				)
			) 
			?>
		</div>
		<div class="form-group col-md-6">
			<label for="profile-cellnum"><b>Cell Phone Number</b></label>
			<?= 
			$this->Form->input(
				'cellnum', 
				array(
					'id' => 'profile-cellnum',
					'label' => false, 
					'class' => 'form-control', 
					'type' => 'test', 
					'placeholder' => ''
				)
			) 
			?>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<button type="submit" class="btn pull-right">Update</button>
			<div class="clearfix"></div>
		</div>
	</div>
	<?= $this->Form->end() ?>

</div></div>