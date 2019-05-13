<?php
	include_once('session.php');
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
						<header class="major">
							<h2>Sign Up</h2>
							<p></p>
						</header>
						<!-- Form -->
							<section class="box" id="content">
								<form method="post" action="signup_process.php">
									<div class="row gtr-uniform gtr-50">
										<div class="col-4 col-12-xsmall">
											<input type="text" name="userID" id="userID" value="" placeholder="*User ID" required  maxlength="10"/>
										</div>
										<div class="col-4 col-12-xsmall">
											<input type="password" name="password" id="password" value="" placeholder="*Password" required/>
										</div>
										<div class="col-4 col-12-xsmall">
											<input type="password" name="vpassword" id="vpassword" value="" placeholder="*Password again" required/>
										</div>
										<div class="col-4 col-12-xsmall">
											<input type="text" name="first_name" id="first_name" value="" placeholder="*First Name" required/>
										</div>
										<div class="col-4 col-12-xsmall">
											<input type="text" name="last_name" id="last_name" value="" placeholder="*Last Name" required/>
										</div>
										<div class="col-4 col-12-xsmall">
											<input type="email" name="email" id="email" value="" placeholder="Email" />
										</div>
										<div class="col-12 col-12-xsmall">
											<input type="text" name="home_address" id="home_address" value="" placeholder="Home Address" />
										</div>
										<div class="col-6 col-12-xsmall">
											<input type="text" name="home_phone" id="home_phone" value="" placeholder="Home Phone" />
										</div>
										<div class="col-6 col-12-xsmall">
											<input type="text" name="cellphone" id="cellphone" value="" placeholder="Cellphone" />
										</div>
										<div class="col-12">
											<ul class="actions">
												<li><input type="submit" value="SignUp" class="primary" /></li>
												<li><input type="reset" value="Reset" /></li>
											</ul>
										</div>
									</div>
								</form>
							</section>


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