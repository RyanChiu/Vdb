<!-- Page Title -->
<div class="section section-breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h1 id="CarsFoundTitle"><b>Cars found for you</b></h1>
			</div>
			<div class="col-md-9">
				<ur style="color:white;">
					<li><b>zip code:</b> <?= isset($zip) && !empty($zip) ? $zip : 'no zip code, no price' ?></li>
					<li><b>under price:</b> <?= isset($underprice) && $underprice != -1 ? $underprice : 'no limit' ?></li>
				</ur>
			</div>
		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<?php
		if (!empty($jsonArticle)) {
		?>
		<div class="row">
			<!-- Product Summary & Options -->
			<div class="col-sm-4 product-details">
				<h3><b style="color:#0033ff"><?= $jsonArticle->make->name ?> (<?= $jsonArticle->model->name ?>)</b></h3>
				<h5>Quick Overview</h5>
				<p><?= $jsonArticle->description ?></p>
				<table class="shop-item-selections">
					<?php 
					if (isset($zip) && !empty($zip)) {
					?>
					<!-- Price -->
					<tr>
						<td><b>Price:</b></td>
						<td>
							<div class="price">
								<span class="price-was">$<?= isset($jsonPrice) ? $jsonPrice->tmv->nationalBasePrice->baseMSRP : 'N/A' ?></span> $<?= isset($jsonPrice) ? $jsonPrice->tmv->nationalBasePrice->baseInvoice : 'N/A' ?>
							</div>
						</td>
					</tr>
					<?php 
					}
					?>
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
			<!-- Product Image & Available Colors -->
			<div class="col-sm-8">
				<div class="table">
					<!-- Tabs -->
					<ul class="nav nav-tabs product-details-nav">
						<li class="active"><a href="#tab1_" data-toggle="tab">Introduction</a></li>
						<li><a href="#tab2_" data-toggle="tab">More infos</a></li>
					</ul>
					<!-- Tab Content (Full Description) -->
					<div class="tab-content product-detail-info">
						<div class="tab-pane active" id="tab1_">
							<?= $jsonArticle->introduction ?>
						</div>
						<!-- Tab Content (Specification) -->
						<div class="tab-pane" id="tab2_">
							<?php 
							if (isset($jsonStyles)) {
								$i = 0;
							?>
							<table>
								<caption style="text-align:left">Style(s)</caption>
								<?php 
								foreach ($jsonStyles->styles as $style) {
									$i++;
								?>
								<tr>
									<td style="width:8px;"><?= $i ?></td>
									<td style="width:16px;"><?= $style->submodel->body ?></td>
									<td>
										<a href="#<?= $style->id ?>">
										<?= $style->name ?>
										</a>
									</td>
								</tr>
								<?php 
								}
								?>
							</table>
							<?php 
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- End Product Image & Available Colors -->

			<!-- Full Description & Specification -->
			<div class="col-sm-12">
				......
			</div>
			<!-- End Full Description & Specification -->
		</div>
		<hr style="border-width:1px;border-color:grey;"/>
		<?php
		} else {
			echo "No cars found, please try again.";
		}
		?>
	</div>
</div>

<script type="text/javascript">
//        window.sdkAsyncInit = function() {
            // Instantiate the SDK
//            var res = new EDMUNDSAPI('<?= EDMUNDS_API_KEY ?>');
            // Optional parameters
//            var options = {};
            // Callback function to be called when the API response is returned
//            function success(res) {
//                var body = document.getElementById('results-body');
//                body.innerHTML = "This photo's title is : " + JSON.stringify(res);//res.photos[0].title;
//            }
            // Oops, Houston we have a problem!
//            function fail(data) {
//                console.log(data);
//            }
            // Fire the API call
//            res.api('/api/media/v2/honda/civic/photos', options, success, fail);
            // Additional initialization code such as adding Event Listeners goes here
//        };
        // Load the SDK asynchronously
//        (function(d, s, id){
//            var js, sdkjs = d.getElementsByTagName(s)[0];
//            if (d.getElementById(id)) {return;}
//            js = d.createElement(s); js.id = id;
//            js.src = "/vdb/js/edmunds.api.sdk.js";
//            sdkjs.parentNode.insertBefore(js, sdkjs);
//        }(document, 'script', 'edmunds-jssdk'));
</script>

<!-- for debug begin -->
<?php //echo str_replace("\n", "<br/>", print_r($jsonPrice, true)); ?>
<!-- for debug end -->