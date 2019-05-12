<?php
	include_once('session.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Interfaces</title>
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
							<h2>Interfaces</h2>
						</header>

						<!-- Content -->
							<section id="content">
								<b>You provide</b>
								<table>
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Method</th>
											<th>Parameters</th>
											<th>Example</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>products</td>
											<td>Provide all products infomation</td>
											<td>GET</td>
											<td>None</td>
											<td><a href="http://xiaoningzhao.com/api/products.php">api/products.php</a></td>
										</tr>
										<tr>
											<td>product_info</td>
											<td>Provide single product infomation by productID</td>
											<td>GET</td>
											<td>productID</td>
											<td><a href="http://xiaoningzhao.com/api/product_info.php?productID=00001">api/product_info.php</a></td>
										</tr>
										<tr>
											<td>product_rating</td>
											<td>Provide single product rating summary by productID</td>
											<td>GET</td>
											<td>productID</td>
											<td><a href="http://xiaoningzhao.com/api/product_rating.php?productID=00001">api/product_rating.php</a></td>
										</tr>
										<tr>
											<td>product_review</td>
											<td>Provide all reviews of single product by productID</td>
											<td>GET</td>
											<td>productID</td>
											<td><a href="http://xiaoningzhao.com/api/product_review.php?productID=00001">api/product_review.php</a></td>
										</tr>
										<tr>
											<td>user_info</td>
											<td>Provide user information by userID and MD5 password.(login service)</td>
											<td>POST</td>
											<td>userID, MD5 password</td>
											<td><a href="http://xiaoningzhao.com/api/user_info_get.php?userID=00001&password=670b14728ad9902aecba32e22fa4f6bd">api/user_info.php</a></td>
										</tr>
										<tr>
											<td>product_visit</td>
											<td>Provide visit count information of all products</td>
											<td>GET</td>
											<td>None</td>
											<td><a href="http://xiaoningzhao.com/api/product_visit.php">api/product_visit.php</a></td>
										</tr>
										<tr>
											<td>rating_summary</td>
											<td>Provide rating summary information of all products</td>
											<td>GET</td>
											<td>None</td>
											<td><a href="http://xiaoningzhao.com/api/rating_summary.php">api/rating_summary.php</a></td>
										</tr>
										<tr>
											<td>add_review</td>
											<td>Add review to product</td>
											<td>POST</td>
											<td>productID, review, rate, userID, timedate</td>
											<td><a href="http://xiaoningzhao.com/api/add_review.php">api/add_review.php</a></td>
										</tr>
										<tr>
											<td>add_access_history</td>
											<td>Add product access history to member website</td>
											<td>GET</td>
											<td>productID, userID, timedate</td>
											<td><a href="http://xiaoningzhao.com/api/add_access_history.php">api/add_access_history.php</a></td>
										</tr>							
									</tbody>
								</table>
								<b>Portal provide</b>
								<table>
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Method</th>
											<th>Parameters</th>
											<th>Example</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>user_info</td>
											<td>Login service, protal will verify with every member sites.</td>
											<td>POST</td>
											<td>userID, MD5 password</td>
											<td><a href="http://xiaoningzhao.com/Marketplace/api/user_info_get.php?userID=00001&password=670b14728ad9902aecba32e22fa4f6bd">api/user_info.php</a></td>
										</tr>
									</tbody>
								</table>

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