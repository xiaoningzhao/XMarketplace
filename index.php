<?php
	include_once('session.php');
	include_once('util.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>MARKETPLACE</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">
			
			<section id="header">

			<?php 
				include 'header.php';
			?>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Howdy. This is X Marketplace.</h2>
						<p>A cross domain marketplace</p>
					</header>
				</section>
			</section>

			<!-- Main -->
				<section id="main">
					<div class="container">
						<div class="row">
							<div class="col-12">
						<!-- Portfolio -->
							<section>
								<header class="major">
									<h2>Most Favorable Products/Services</h2>
								</header>
								<div class="row">
								<?php 

									$rating_summary = getRatingSummaryArray();
									for($i=0;$i<3;$i++){
										$productID = $rating_summary[$i]['productID'];
										$website = $rating_summary[$i]['website'];
										$product_info = getProductInfo($website, $productID);
										foreach($product_info as $value){
								?>
									<div class="col-4 col-6-medium col-12-small">
										<section class="box">
											<a href=<?php echo "\"product_detail.php?websiteName=".$website."&productID=".$productID."\""; ?> class="image featured"><img src=<?php echo "\"".$value['productImage']."\""; ?> alt="" /></a>
											<header>
												<h4><?php echo $value['productName']; ?></h4>
											</header>
											<p><?php echo $value['productDescription']; ?></p>
											<footer>
												<ul class="actions">
													<li><a href= <?php echo "\"product_detail.php?websiteName=".$website."&productID=".$productID."\""; ?> class="button alt">More</a></li>
												</ul>
											</footer>
										</section>
									</div>
									<?php 
											}
										}
									?>
								</div>
							</section>

							<section>
								<header class="major">
									<h2>Most Visited Products/Services</h2>
								</header>
								<div class="row">
								<?php 

									$visit_summary = getProductVisitArray();
									for($i=0;$i<3;$i++){
										$productID = $visit_summary[$i]['productID'];
										$website = $visit_summary[$i]['website'];
										$product_info = getProductInfo($website, $productID);
										foreach($product_info as $value){
								?>
									<div class="col-4 col-6-medium col-12-small">
										<section class="box">
											<a href=<?php echo "\"product_detail.php?websiteName=".$website."&productID=".$productID."\""; ?> class="image featured"><img src=<?php echo "\"".$value['productImage']."\""; ?> alt="" /></a>
											<header>
												<h4><?php echo $value['productName']; ?></h4>
											</header>
											<p><?php echo $value['productDescription']; ?></p>
											<footer>
												<ul class="actions">
													<li><a href= <?php echo "\"product_detail.php?websiteName=".$website."&productID=".$productID."\""; ?> class="button alt">More</a></li>
												</ul>
											</footer>
										</section>
									</div>
									<?php 
											}
										}
									?>
								</div>
							</section>

							</div>
						</div>
					</div>
				</section>
			<?php 
				include 'footer.php';
			?>
		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>