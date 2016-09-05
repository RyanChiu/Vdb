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
					<form class="form-inline" action="/vdb/details">
						<div class="row">
							<div class="col-xs-6">
								<select class="form-control" style="width:100%">
									<option value="0">Any Make</option>
									<option value="1">FIAT</option>
								</select>
							</div>
							<div class="col-xs-6">
								<select class="form-control" style="width:100%">
									<option value="0">Any Model</option>
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
								<select class="form-control" style="width:100%">
									<option value="0">Any Price</option>
									<option value="1">00.00</option>
								</select>
							</div>
							<div class="col-xs-3">
								<input type="text" class="form-control" style="width:100%" placeholder="zip code">
							</div>
							<div class="col-xs-3">
								<button type="submit" class="btn btn-default" style="width:100%">Search</button>
							</div>
						</div>
					</form>
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