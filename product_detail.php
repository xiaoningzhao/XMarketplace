<?php
	include_once('session.php');
	include_once('util.php');	
	extract($_GET);
	

	$productName = "";
	$productDescription = "";
	$productImage = "";
	$productPrice = "";

	$rating_count = array(0,0,0,0,0,0);
	$rating_total = 0;
	$rating_avg = 0.0;

	if($session_login==true){
		$history = array("productID"=>$productID, "userID"=>$session_userid, "timedate" => date("Y-m-d H:i:s"));
		addAccessHistory($websiteName,$history);
	}

	$product_info = getProductInfo($websiteName, $productID);
	if ($product_info != null) {
		foreach($product_info as $value)
		$productName = $value['productName'];
		$productDescription = $value['productDescription'];
		$productImage = $value['productImage'];
		$productPrice = $value['price'];
	}

	$product_rating = getProductRating($websiteName, $productID);
	if ($product_rating != null) {
		foreach($product_rating as $value)
			switch ($value['rating']) {
				case '0':
					$rating_count[0] = $value['ratingcount'];
					break;
				case '1':
					$rating_count[1] = $value['ratingcount'];
					break;				
				case '2':
					$rating_count[2] = $value['ratingcount'];
					break;
				case '3':
					$rating_count[3] = $value['ratingcount'];
					break;
				case '4':
					$rating_count[4] = $value['ratingcount'];
					break;
				case '5':
					$rating_count[5] = $value['ratingcount'];
					break;				
				default:
					break;
			};
	}


	$rating_total = $rating_count[0]+$rating_count[1]+$rating_count[2]+$rating_count[3]+$rating_count[4]+$rating_count[5];
	$rating_avg = 0;
	if($rating_total != 0){
		$rating_avg = ($rating_count[1]+$rating_count[2]*2+$rating_count[3]*3+$rating_count[4]*4+$rating_count[5]*5)/$rating_total;
	}

	$expire=time()+60*60*24*7;
	$page_id=$productName;

	if(isset($_COOKIE['recent_page'])){
		$page = $_COOKIE['recent_page'];
		$arr = unserialize($page);
		array_unshift($arr, $page_id);
		$arr = array_unique($arr);
		if(count($arr)>5){
			array_pop($arr);
		}
		$page = serialize($arr);
		setcookie('recent_page',$page, $expire,"/");
	}else{
		$arr[] = $page_id;
		$page = serialize($arr);
		setcookie('recent_page',$page, $expire,"/");
	}

	if(isset($_COOKIE['page_visits'])){
		$page_visits = $_COOKIE['page_visits'];
		$arr_visits = unserialize($page_visits);
		if(array_key_exists($page_id,$arr_visits)){
			$arr_visits[$page_id] = $arr_visits[$page_id] + 1;
		}else{
			$arr_visits[$page_id] = 1;
		}
		$page_visits = serialize($arr_visits);
		setcookie('page_visits',$page_visits, $expire, "/");
	}else{
		$arr_visits[$page_id] = 1;
		$page_visits = serialize($arr_visits);
		setcookie('page_visits', $page_visits, $expire, "/"); 
	}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title><?php echo $productName; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/rating.css" />
	</head>
	<body class="no-sidebar is-preload">
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=435060070580649&autoLogAppEvents=1"></script>
		<div id="page-wrapper">
			<section id="header">

			<?php 
				include 'header.php';
			?>
			</section>

			<!-- Main -->
				<section id="main">
					<div class="container">
					<article class="box post">
						<header class="major">
							<h2><?php echo $productName; ?></h2>
							<p></p>
						</header>
						<!-- Content -->
							<section id="content">
								<img src=<?php echo "'$productImage'"; ?> width="60%" height="60%" alt="" />
								<?php
									echo "<h3>$productName</h3><p>Price: $productPrice</p><p>$productDescription</p>";
									$page_url =  'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
								?>
								<div class="fb-share-button" data-href=<?php echo "\"".$page_url."\"" ?> data-layout="button_count" data-size="small"><a target="_blank" href=<?php echo "https://www.facebook.com/sharer/sharer.php?u=$page_url; src=sdkpreparse"?> class="fb-xfbml-parse-ignore">Share</a></div>
							<hr>
							<div class="col-6">
								<h3>User Rating</h3>
								<?php
									for($i=0; $i<round($rating_avg); $i++){
										echo "<span class='fa fa-star checked'></span>";
									}
									for($i=5; $i>round($rating_avg); $i--){
										echo "<span class='fa fa-star'></span>";
									}
									echo "<p><b>".round($rating_avg,1)."</b> average based on <b> $rating_total </b> reviews.</p>"; 
								?>
								<div id="barchart" class="col-6"></div>
							</div>
							<hr>

								<h4>Rating this service</h4>
								<form method="post" action="review.php">
									<div class="rate">
										<input type="radio" id="star5" name="rate" value="5" />
										<label for="star5" title="5">5 stars</label>
										<input type="radio" id="star4" name="rate" value="4" />
										<label for="star4" title="4">4 stars</label>
										<input type="radio" id="star3" name="rate" value="3" />
										<label for="star3" title="3">3 stars</label>
										<input type="radio" id="star2" name="rate" value="2" />
										<label for="star2" title="2">2 stars</label>
										<input type="radio" id="star1" name="rate" value="1" />
										<label for="star1" title="1">1 star</label>
									</div>
									<div class="col-12">
											<textarea name="review" id="review" placeholder="Enter your review" rows="6"></textarea>
									</div>
									<?php echo "<div class='col-12'><input type='hidden' name='productID' id='productID' value='$productID' /></div>"; ?>
									<?php echo "<div class='col-12'><input type='hidden' name='websiteName' id='websiteName' value='$websiteName' /></div>"; ?>
									<br>
									<div class="col-12">
										<ul class="actions">
											<li><input type="submit" value="Submit" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</form>
							</section>

							<section class="col-12">
								<h4>Reviews</h4>

								<?php 

									$product_review = getProductReview($websiteName, $productID);
									if ($product_review != null) {
										foreach($product_review as $row){
											$user_id = $row['userID'];

											if($row['userID']==null){
												$user_id = "Anonymous";
											}

											echo "<h5>".$user_id."</h5>";
											echo "<h5>".$row['timedate']."</h5>";

											for($i=0; $i<round($row['rating']); $i++){
												echo "<span class='fa fa-star checked'></span>";
											}
											for($i=5; $i>round($row['rating']); $i--){
												echo "<span class='fa fa-star'></span>";
											}
											echo "<p>Review: ".$row['review']."</p>";
											echo "<hr>";
										}
									}

								?>
							</section>

						</article>
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

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				// Load google charts
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				var rawdata = <?php $jarr = "[['Rating', 'Number', { role: 'style' }],
											 ['5 Star', ".$rating_count[5].", '#4CAF50'],            
											 ['4 Star', ".$rating_count[4].", '#2196F3'],            
											 ['3 Star', ".$rating_count[3].", '#00bcd4'],
											 ['2 Star', ".$rating_count[2].", '#ff9800' ], 
											 ['1 Star', ".$rating_count[1].", '#f44336' ],
											 ['0 Star', ".$rating_count[0].", 'purple' ]]"; 
									echo $jarr; 
								?>;

				// Draw the chart and set the chart values
				function drawChart() {
				  	var data = google.visualization.arrayToDataTable(rawdata);

					var view = new google.visualization.DataView(data);
				      view.setColumns([0, 1,
				                       { calc: "stringify",
				                         sourceColumn: 1,
				                         type: "string",
				                         role: "annotation" },
				                       2]);

					// Optional; add a title and set the width and height of the chart
					var options = {'height':400, backgroundColor:'transparent', legend: { position: 'none' }, chartArea:{left:50,top:0,width:'50%',height:'75%'}, hAxis:{viewWindow:{min:0}, textPosition:'none', gridlines:{color:'transparent'}}};

					// Display the chart inside the <div> element with id="piechart"
					var chart = new google.visualization.BarChart(document.getElementById('barchart'));
					chart.draw(view, options);
				}
			</script>
	</body>
</html>