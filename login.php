<?php
	include_once('session.php');

	require_once __DIR__ . '/Facebook/autoload.php';

	$fb = new Facebook\Facebook([
	  'app_id' => '435060070580649',
	  'app_secret' => '9444061e16a010fb374cf03139e84cf0',
	  'default_graph_version' => 'v3.3',
	  ]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('https://zhiyuanyao.info/fb_callback.php', $permissions);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Sign In</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
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
							<h2>Sign In</h2>
							<p>Please sign in to access more information</p>
						</header>

						<!-- Form -->
						<div class="col-6 col-12-small">
								<form method="post" action="login_process.php">
									<div class="row aln-center gtr-0">
										<section>
										<div class="col-6 col-12-small">
											<input type="text" name="userID" id="userID" value="" placeholder="User ID" autocomplete="username"/>
										</div>
										<br>
										<div class="col-6 col-12-small">
											<input type="password" name="password" id="password" value="" placeholder="Password" autocomplete="current-password"/>
										</div>
										</section>
									</div>
									<br>
									<div class="row aln-center gtr-0">
										<ul class="actions">
											<li><input type="submit" value="Sign In" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</form>
								<div class="row aln-center gtr-0">
									<div class="col-3"></div>
									<div class="col-3 aln-center">
										<a href='<?php echo htmlspecialchars($loginUrl); ?>' class="image featured"><img src="images/facebook-login-button.png" alt="" /></a>
									</div>
									<div class="col-3"></div>
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