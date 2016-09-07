<!-- Homepage Slider -->
<div class="homepage-slider">
	<div id="sequence">
		<ul class="sequence-canvas">
			<!-- Slide 2 -->
			<li class="bg3">
				<!-- Slide Left Content -->
				<!-- Slide Title -->
				<h2 class="title">Find you car here, please.</h2>
				<!-- Slide Text -->  
				<div class="subtitle">
					<?= $this->Form->create(null, ['class' => 'form-inline', 'url' => '/vdb/details']) ?>
					<!-- <form class="form-inline" action="/vdb/details"> -->
						<div class="row">
							<div class="col-xs-6">
								<select name="make" id="SearchMake" class="form-control" style="width:100%">
									<option value="-1">Any Make</option>
									<?php
									$im = 0;
									foreach ($makes as $make) {
										$im++
									?>
										<option value="<?= $make['make'] ?>"><?= $make['make'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="col-xs-6">
								<select name="model" id="SearchModel" class="form-control" style="width:100%">
									<option value="-1">Any Model</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6" style="font-size:x-small;font-weight:bold;color:white;">
								Ex:FIAT
							</div>
							<div class="col-xs-6" style="font-size:x-small;font-weight:bold;color:white;">
								Ex:FIAT 500
							</div>
						</div>
						<div class="row" style="margin-top:6px;">
							<div class="col-xs-6">
								<select name="underprice" id="SearchUnderPrice" class="form-control" style="width:100%">
									<option value="-1">Any Price</option>
									<?php
									$pstep = 1000;
									for ($ip = 1000; $ip <= 100000; $ip += $pstep) {
									?>
										<option value="<?= $ip ?>">Under $<?= number_format($ip) ?></option>
									<?php 
										if ($ip >= 20000 and $ip < 30000) {
											$pstep = 2000;
										} else if ($ip >= 30000) {
											$pstep = 5000;
										}
									}
									?>
								</select>
							</div>
							<div class="col-xs-3">
								<input name="zip" type="text" class="form-control" style="width:100%" placeholder="zip code">
							</div>
							<div class="col-xs-3">
								<button type="submit" class="btn btn-default" style="width:100%">Search</button>
							</div>
						</div>
					<!-- </form> -->
					<?= $this->Form->end() ?>
					<!-- jQuery part for the form above begin -->
					<script type="text/javascript">
					jQuery("#SearchMake").change(function() {
						var xmlhttp;
						if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp=new XMLHttpRequest();
						}
						else
						{// code for IE6, IE5
							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							// do nothing here for now
						}
						if (xmlhttp) {
							xmlhttp.onreadystatechange=function() {
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									//alert(xmlhttp.responseText);// for debug
									jQuery("#SearchModel").empty();
									jQuery("#SearchModel").append(xmlhttp.responseText);
								}
							}
							xmlhttp.open("GET", "asyncs?make=" + jQuery("#SearchMake").find("option:selected").text() + "&t=" + Math.random(), true);
							xmlhttp.send();
						}
					});
					</script>
					<!-- jQuery part for the form above end -->
				</div>
				<!-- Slide Image --> 
				<img class="slide-img"
					src="img/homepage-slider/slide2.png" alt="Slide 2" style="width:400px;"/>
			</li>
			<!-- End Slide 2 -->
		</ul>
	</div>
</div>
<!-- End Homepage Slider -->

<!-- Pricing Table -->
<div class="section">
	<div class="container">
		<h2>Cars</h2>
		<div class="row">
			<!-- Pricing Plans Wrapper -->
			<div class="pricing-wrapper col-md-12">
			
				<?php 
				$irs4 = 0;
				foreach ($rs4 as $r) {
				?>
					<!-- Pricing Plan -->
					<div class="pricing-plan">
					
						<?php
						$irs4++;
						if ($irs4 == 1) {
						?>
						<!-- Pricing Plan Ribbon -->
						<div class="ribbon-wrapper">
							<div class="price-ribbon ribbon-red">Popular</div>
						</div>
						<?php
						} else if ($irs4 == 4) {
						?>
						<!-- Pricing Plan Ribbon -->
						<div class="ribbon-wrapper">
							<div class="price-ribbon ribbon-green">New</div>
						</div>
						<?php
						}
						?>
					
						<h2 class="pricing-plan-title"><?= $r['make'] ?></h2>
						<div class="portfolio-item"><div class="portfolio-image">
							<img src="/vdb/img/cars/<?= $r['image'] ?>" />
						</div></div>
						<p class="pricing-plan-price">$<?= number_format($r['locals']['0']['price']) ?></p>
						<ul class="pricing-plan-features">
							<li><strong><?= $r['name'] ?></strong> <?= $r['model'] ?></li>
						</ul>
						<a href="#" class="btn">Order Now</a>
					</div>
					<!-- End Pricing Plan -->
				<?php 
				}
				?>
			</div>
			<!-- End Pricing Plans Wrapper -->
		</div>
	</div>
</div>
<!-- End Pricing Table -->
<!-- for debug begin -->
<?php //echo str_replace("\n", "<br/>", print_r($makes, true)) . "#$"; ?>
<!-- for debug end -->