<?php
	include_once('session.php');
	include_once('util.php');
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Products</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="right-sidebar is-preload">
		<div id="page-wrapper">

			<section id="header">

			<?php 
				include 'header.php';
			?>
			</section>

			<!-- Main -->
				<section id="main">
					<div class="container">
						<header class="major">
							<h2>Products/Services</h2>
						</header>
						<div class="row gtr-150">

							<div class="col-12 col-12-medium imp-medium">

								<!-- Content -->
									<section id="content">

										<div class="col-12">

										<!-- Portfolio -->

										<?php 

											$websites = getWebsites();
											if (isset($_GET['website'])){
												$websites = getWebsite($_GET['website']);
											}

											foreach ($websites as $website){

												$products = getProducts($website['website']);

												echo "<header><h3>".$website['website']."</h3></header>";

										?>
										<section>
											<div class="row">
												<?php
														foreach($products as $row => $value)
														{
												?>
												<div class="col-4 col-6-medium col-12-small">
													<section class="box">
														<a href=<?php echo "\"product_detail.php?websiteName=".$website['website']."&productID=".$value['productID']."\""; ?> class="image featured"><img src=<?php echo "\"".$value['productImage']."\""; ?> alt="" /></a>
														<header>
															<h4><?php echo $value['productName']; ?></h4>
														</header>
														<p>Price: <?php echo $value['price']; ?></p>
														<p><?php echo $value['productDescription']; ?></p>
														<footer>
															<ul class="actions">
																<li><a href= <?php echo "\"product_detail.php?websiteName=".$website['website']."&productID=".$value['productID']."\""; ?> class="button alt">More</a></li>
															</ul>
														</footer>
													</section>
												</div>
												<?php }?>
											</div>
										</section>													
										<?php } ?>
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