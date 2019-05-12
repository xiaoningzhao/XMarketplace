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
							<h2><?php if(isset($_GET['websiteName'])){echo $_GET['websiteName']." ";}else{echo "Best In ";}?>Best Products / Services</h2>
						</header>
						<div class="row">
							<div class="col-6 col-12-small">
								<section class="box">
									<header><h3>Most Popular Products</h3></header>
									<div id="piechart" class="col-6"></div>
									<footer>
										Top 5 popular products
										<table>
											<thead>
												<tr>
													<th>Product</th>
													<th>Total Visit</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(isset($_GET['websiteName'])){
														$product_visit = getProductVisitSorted($_GET['websiteName']);
													}else{
														$product_visit = getProductVisitArray();
													}
													for($i=0;$i<5;$i++){
														echo "<tr>";
														echo "<td>".$product_visit[$i]['productName']."</td>";
														echo "<td>".$product_visit[$i]['Visit']."</td>";	
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
									</footer>
								</section>
							</div>
							<div class="col-6 col-12-small">
								<section class="box">
									<header><h3>Best Rating Products</h3></header>
									<div id="barchart" class="col-6"></div>
									<footer>
										Top 5 rating products
										<table>
											<thead>
												<tr>
													<th>Product</th>
													<th>Average Rating</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(isset($_GET['websiteName'])){
														$rating_summary = getRatingSummarySorted($_GET['websiteName']);
													}else{
														$rating_summary = getRatingSummaryArray();
													}
													
													for($i=0;$i<5;$i++){
														echo "<tr>";
														echo "<td>".$rating_summary[$i]['productName']."</td>";
														echo "<td>".round($rating_summary[$i]['avg_rating'],1)."</td>";	
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
									</footer>
								</section>
							</div>

							<div class="col-6 col-12-small">
								<section class="box">
									<header><h3>Five recent products you visited</h3></header>
									<div>
										<?php
										if(isset($_COOKIE['recent_page'])){
											$page = $_COOKIE['recent_page'];
											$arr = unserialize($page);
											foreach($arr as $v){
												echo $v."<br>";
											}
										}
										?>
									</div>
								</section>
							</div>

							<div class="col-6 col-12-small">
								<section class="box">
									<header><h3>Products you visited the most</h3></header>
									<div>
										<?php
										if(isset($_COOKIE['page_visits'])){
											$page_visits = $_COOKIE['page_visits'];
											$arr_visits = unserialize($page_visits);
											arsort($arr_visits);
											foreach($arr_visits as $key => $v){
												echo $key."  - times visit: ".$v."<br>";
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

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				// Load google charts
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawPieChart);
				google.charts.setOnLoadCallback(drawBarChart);

				var piedata = <?php 

								if(isset($_GET['websiteName'])){
									echo getProductVisitSortedChart($_GET['websiteName']);
								}else{
									echo getProductVisitChartArray();
								}
							?>;

				// Draw the chart and set the chart values
				function drawPieChart() {
				  var data = google.visualization.arrayToDataTable(piedata);

				  // Optional; add a title and set the width and height of the chart
				  var options = {'height':400, backgroundColor:'transparent', pieSliceText:'label', chartArea:{top:0,width:'100%',height:'75%'},legend:{position:'bottom', textStyle: {color: 'black'}}};

				  // Display the chart inside the <div> element with id="piechart"
				  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
				  chart.draw(data, options);
				}

				var bardata = <?php 

								if(isset($_GET['websiteName'])){
									echo getRatingSummarySortedChart($_GET['websiteName']);
								}else{
									echo getRatingSummaryChartArray();
								}
							?>;

				function drawBarChart() {
				  	var data = google.visualization.arrayToDataTable(bardata);

					var view = new google.visualization.DataView(data);
				      // view.setColumns([0, 1,
				      //                  { calc: "stringify",
				      //                    sourceColumn: 1,
				      //                    type: "string",
				      //                    role: "annotation" },
				      //                  2]);

					// Optional; add a title and set the width and height of the chart
					var options = {'height':400, backgroundColor:'transparent', legend: { position: 'none' }, chartArea:{top:0,width:'100%',height:'75%'}, hAxis:{viewWindow:{min:0}, textPosition:'none', gridlines:{color:'transparent'}}};

					// Display the chart inside the <div> element with id="piechart"
					var chart = new google.visualization.BarChart(document.getElementById('barchart'));
					chart.draw(view, options);
				}

			</script>

	</body>
</html>