<?php
	include_once('session.php');
	include_once('util.php');
?>
<!-- Header -->
	<h1><a href="index.php">X MarketPlace</a></h1>
	<nav id="nav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li>
				<a href="product.php">Products</a>
				<ul>
					<?php 
						$header_websites = getWebsites();
						foreach ($header_websites as $website){
							echo "<li><a href='product.php?website=".$website['website']."'>".$website['website']."</a></li>";
						}
					?>
					<li><a href="product_analysis.php">Best Products</a>
						<ul>
							<?php 						
								foreach ($header_websites as $website){
									echo "<li><a href='product_analysis.php?websiteName=".$website['website']."'>".$website['website']."</a></li>";
								}
							?>
						</ul>
					</li>
				</ul>
			</li>
			<li><a href="news.php">News</a></li>
			<li><a href="contacts.php">Contacts</a></li>
			<?php 
				if($session_login==true){
					echo "<li><a href='#' class='button primary'>$session_name</a><ul><li><a href='user_profile.php'>Profile</a></li><li><a href='logout.php'>Sign Out</a></li></ul></li>";
				}else{
					echo "<li><a href='login.php' class='button primary'>Sign In</a><ul><li><a href='signup.php'>Sign Up</a></li></ul></li>";
				}
			?>
		</ul>
	</nav>