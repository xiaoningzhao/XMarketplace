<?php
	include_once('session.php');
	include_once('util.php');
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Sign Up</title>
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

										if($password == $vpassword){
											$userarray = array("userID"=>$userID, "password"=>MD5($password), "first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email, "home_address"=>$home_address,"home_phone"=>$home_phone,"cellphone"=>$cellphone);

											$result = addUser("X Consulting", $userarray);

											if ($result['result']===true) {
												echo "<header class='major'><h2>Sign Up Successful!<h2></header>";
											}else{
												echo "<header class='major'><h2>Sign Up Failed!</h2></header>";
											}
										}else{
											echo "<header class='major'><h2>Passwords do not match!<h2></header>";
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