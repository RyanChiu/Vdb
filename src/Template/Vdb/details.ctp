<!-- Page Title -->
<div class="section section-breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h1 id="CarsFoundTitle">Cars found for you</h1>
			</div>
			<div class="col-md-9">
				<ur style="color:white;">
					<li>zip code: <?= isset($zip) ? $zip : '' ?></li>
					<li>under price: <?= isset($underprice) && $underprice != -1 ? $underprice : 'no limit' ?></li>
				</ur>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<?php
		if (!empty($rs)) {
			$il = 0;
			foreach ($rs as $r) {
				foreach ($r['locals'] as $local) {
					$il++;
		?>
		<div class="row">
			<!-- Product Image & Available Colors -->
			<div class="col-sm-6">
				<div class="product-image-large">
					<img src="img/cars/<?= $r['image'] ?>" alt="Item Name">
				</div>
				<div class="colors">
					<span class="color-white"></span> <span class="color-black"></span>
					<span class="color-blue"></span> <span class="color-orange"></span>
					<span class="color-green"></span>
				</div>
			</div>
			<!-- End Product Image & Available Colors -->
			<!-- Product Summary & Options -->
			<div class="col-sm-6 product-details">
				<h4><?= $r['make'] ?> (<?= $r['name'] . $r['model'] ?>)</h4>
				<div class="price">
					<span class="price-was">$<?= $local['price'] ?></span> $<?= $local['price'] - $local['discount'] ?>
				</div>
				<h5>Quick Overview</h5>
				<p><?= $r['brief'] ?></p>
				<table class="shop-item-selections">
					<!-- Color Selector -->
					<tr>
						<td><b>Color:</b></td>
						<td>
							<div class="dropdown choose-item-color">
								<a class="btn btn-sm btn-grey" data-toggle="dropdown" href="#"><span
									class="color-orange"></span> Orange <b class="caret"></b></a>
								<ul class="dropdown-menu" role="menu">
									<li role="menuitem"><a href="#"><span class="color-white"></span>
											White</a></li>
									<li role="menuitem"><a href="#"><span class="color-black"></span>
											Black</a></li>
									<li role="menuitem"><a href="#"><span class="color-blue"></span>
											Blue</a></li>
									<li role="menuitem"><a href="#"><span class="color-orange"></span>
											Orange</a></li>
									<li role="menuitem"><a href="#"><span class="color-green"></span>
											Green</a></li>
								</ul>
							</div>
						</td>
					</tr>
					<!-- Size Selector -->
					<tr>
						<td><b>Engine:</b></td>
						<td>
							<div class="dropdown">
								<a class="btn btn-sm btn-grey" data-toggle="dropdown" href="#">1.8
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li role="menuitem"><a href="#">1.6</a></li>
									<li role="menuitem"><a href="#">1.8</a></li>
									<li role="menuitem"><a href="#">2.0</a></li>
									<li role="menuitem"><a href="#">2.4</a></li>
									<li role="menuitem"><a href="#">2.8</a></li>
								</ul>
							</div>
						</td>
					</tr>
					<!-- Quantity -->
					<tr>
						<td><b>Quantity:</b></td>
						<td><input type="text" class="form-control input-sm input-micro"
							value="1"></td>
					</tr>
					<!-- Add to Cart Button -->
					<tr>
						<td>&nbsp;</td>
						<td><a href="#" class="btn btn"><i
								class="icon-shopping-cart icon-white"></i> Add to Cart</a></td>
					</tr>
				</table>
			</div>
			<!-- End Product Summary & Options -->

			<!-- Full Description & Specification -->
			<div class="col-sm-12">
				<div class="tabbable">
					<!-- Tabs -->
					<ul class="nav nav-tabs product-details-nav">
						<li class="active"><a href="#tab1_<?= $il ?>" data-toggle="tab">Description</a></li>
						<li><a href="#tab2_<?= $il ?>" data-toggle="tab">Features</a></li>
					</ul>
					<!-- Tab Content (Full Description) -->
					<div class="tab-content product-detail-info">
						<div class="tab-pane active" id="tab1_<?= $il ?>">
							<?= $r['detail'] ?>
						</div>
						<!-- Tab Content (Specification) -->
						<div class="tab-pane" id="tab2_<?= $il ?>">
							<table>
								<tr>
									<td>FUEL ECONOMY (CTY/HWY)</td>
									<td>00/00 mpg</td>
								</tr>
								<tr>
									<td>ENGINE TYPE</td>
									<td>Gas</td>
								</tr>
								<tr>
									<td>CAR TYPE</td>
									<td>--</td>
								</tr>
								<tr>
									<td>TRANSMISSION</td>
									<td>x-speed Shiftable Automatic</td>
								</tr>
								<tr>
									<td>BASIC WARRANTY</td>
									<td>--</td>
								</tr>
								<tr>
									<td>TOTAL SEATING</td>
									<td>--</td>
								</tr>
								<tr>
									<td>CYLINDERS</td>
									<td>--</td>
								</tr>
								<tr>
									<td>DRIVE TRAIN</td>
									<td>--</td>
								</tr>
								<tr>
									<td>BLUETOOTH</td>
									<td>--</td>
								</tr>
								<tr>
									<td>HEATED SEATS</td>
									<td>--</td>
								</tr>
								<tr>
									<td>NAVIGATION</td>
									<td>--</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- End Full Description & Specification -->
		</div>
		<hr style="border-width:1px;border-color:grey;"/>
		<?php
				}
			}
			if ($il == 0) {
				echo "No cars found, please try again.";
			} else {
		?>
			<script type="text/javascript">
			jQuery("#CarsFoundTitle").text("<?= $il ?> cars found for you");
			</script>
		<?php 
			}
		} else {
			echo "No cars found, please try again.";
		}
		?>
	</div>
</div>
<!-- for debug begin -->
<?php //echo str_replace("\n", "<br/>", print_r($rs, true)); ?>
<!-- for debug end -->