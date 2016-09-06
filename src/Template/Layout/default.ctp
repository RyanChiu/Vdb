<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    	<?= $this->Html->charset() ?>
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
        	<?= $this->fetch('title') ?>
		</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        
        <!-- include the BotDetect layout stylesheet -->
		<?= $this->Html->css(captcha_layout_stylesheet_url(), ['inline' => false]) ?>

        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('icomoon-social.css') ?>

        <?= $this->Html->css('leaflet.css') ?>
		<!--[if lte IE 8]>
		    <?= $this->Html->css('leaflet.ie.css') ?>
		<![endif]-->
		<?= $this->Html->css('main.css') ?>

        <?= $this->Html->script('modernizr-2.6.2-respond-1.1.0.min.js') ?>
        
        <?= $this->fetch('meta') ?>
    	<?= $this->fetch('css') ?>
    	<?= $this->fetch('script') ?>
    </head>
	<body>
		<!-- Javascripts resources begin -->
		<?= $this->Html->script('jquery-1.9.1.min.js') ?>
		<?= $this->Html->script('bootstrap.min.js') ?>
		<?= $this->Html->script('leaflet.js') ?>
		<?= $this->Html->script('jquery.fitvids.js') ?>
		<?= $this->Html->script('jquery.sequence-min.js') ?>
		<?= $this->Html->script('jquery.bxslider.js') ?>
		<?= $this->Html->script('main-menu.js') ?>
		<?= $this->Html->script('template.js') ?>
		<!-- Javascripts resources end -->
		
	    <?= $this->Flash->render() ?>
	    
	    <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<!-- Navigation & Logo-->
		<div class="mainmenu-wrapper">
			<div class="container">
				<div class="menuextras">
					<div class="extras">
						<ul>
							<li>
								<div class="dropdown choose-country">
									<a class="#" data-toggle="dropdown" href="#"><img src="img/flags/us.png"
												alt="United States"> US</a>
									<ul class="dropdown-menu" role="menu">
										<li role="menuitem"><a href="#"><img
										src="img/flags/gb.png" alt="Great Britain"> UK</a></li>
										<li role="menuitem"><a href="#"><img src="img/flags/de.png"
												alt="Germany"> DE</a></li>
										<li role="menuitem"><a href="#"><img src="img/flags/es.png"
												alt="Spain"> ES</a></li>
									</ul>
								</div>
							</li>
							<li class="shopping-cart-items"><i
								class="glyphicon glyphicon-shopping-cart icon-white"></i> <a
								href="#"><b><?php echo 0;?> items</b></a>
							</li>
							<li>
								<?php 
								if (empty($user)) {
								?>
									<a href="login">Login/Register</a>
								<?php 
								} else {
								?>
									<a href="profile">
										<i class="glyphicon glyphicon-user icon-white"></i>
										<?= $user['username'] ?>
									</a>
									<a href="logout" style="margin-left:12px;">
										<i class="glyphicon glyphicon-log-out icon-white"></i>
										<b>logout</b>
									</a>
								<?php 
								}
								?>
							</li>
						</ul>
					</div>
				</div>
				<nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="."><img
							src="img/mPurpose-logo.png"
							alt="Multipurpose Twitter Bootstrap Template"></a>
						</li>
						<li class="active"><a href=".">Cars for Sale</a></li>
						<li><a href="#">Sell My Car</a></li>
						<li><a href="#">Trade in My Car</a></li>
						<li><a href="#">Car Research & Reviews</a></li>
					</ul>
				</nav>
			</div>
		</div>
		
	    <?= $this->fetch('content') ?>
    
	    <!-- Footer -->
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-footer col-md-12">
						<h3>Contacts</h3>
						<p class="contact-us-details">
							<b>Address:</b> 123 Fake Street, LN1 2ST, London, United Kingdom<br />
							<b>Phone:</b> +44 123 654321<br /> <b>Fax:</b> +44 123 654321<br />
							<b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="footer-copyright">&copy; 2013 mPurpose. All rights
							reserved.</div>
					</div>
				</div>
			</div>
		</div>
		
	<script type="text/javascript">
		jQuery(document).ready(function() {
			// to do
		});
	</script>
	</body>
</html>
