<?php
	include_once('session.php');
	include_once('util.php');
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Review</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="no-sidebar is-preload">
		<div id="page-wrapper">

			<section id="header">

			<?php 
				include 'header.php';
			?>
			</section>
			
			<!-- Main -->
				<section id="main">
					<div class="container">
						<div class="row gtr-150">
							<div class="col-8 col-12-medium imp-medium">
									<section id="content">

									<?php

										extract($_POST);

										if($rate==null){$rate=0;}
										

										$reviewarray = array("productID"=>$productID, "review"=>$review, "rate"=>$rate,"userID"=>null,"timedate"=>date("Y-m-d H:i:s"));

										if($session_login==true){
											$reviewarray = array("productID"=>$productID, "review"=>$review, "rate"=>$rate,"userID"=>$session_userid,"timedate"=>date("Y-m-d H:i:s"));

										}

										$result = addReview($websiteName, $reviewarray);

										if ($result['result']===true) {
											echo "<header class='major'><h2>Rating Successful!<h2></header>";
										}else{
											echo "<header class='major'><h2>Rating Failed!</h2></header>";
										}
									?>

									</section>

									<section>
										<ul class="actions">
											<li><a href="#" class="button primary" onclick = "self.location=document.referrer;">Back</a></li>
										</ul>
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