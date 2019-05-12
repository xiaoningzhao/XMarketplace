<?php
	include_once('session.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>User</title>
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
							<h2>User Profile</h2>
						</header>

						<!-- Content -->
							<section id="content">
								<article class="box post">
								<h3>Hello! <?php echo $session_name; ?></h3>
								<p>Your profile:</p>
								<ul>
									<li>User ID:	<?php echo $session_userid; ?></li>
									<li>Email:		<?php echo $session_email; ?></li>
									<li>Address: 	<?php echo $session_address; ?></li>
									<li>Home Phone:	<?php echo $session_homephone; ?></li>
									<li>Cellphone: 	<?php echo $session_cellphone; ?></li>
									<li>Website: 	<?php echo $session_website; ?></li>
								</ul>

								<footer>
									<ul class="actions">
										<li><a href='logout.php' class="button">Sign Out</a></li>
									</ul>
								</footer>

								</article>
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