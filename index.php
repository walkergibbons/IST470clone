<!DOCTYPE html>
<html lang='en'>

<head>

	<title> Mercer University Campus Map </title>

	<header class="header">


		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

		<div class="row">
			<div class="col">
				<!-- Hamburger Menu-->
				<nav role="navigation">
					<div id="menuToggle">

						<input type="checkbox" />

						<span></span>
						<span></span>
						<span></span>
						
						<ul id="menu">
							<li><button id="btn" style=font-weight:bold class="modal-button" href="#myModal2"> Building Codes </button></li>

							<div id="myModal2" class="modal">
								<div class="modal-content">
									<span class="close">&times;</span>
									<div class="row">
										<div class="col">
											<h1>Building Names - Code</h1>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Connell Student Center - CSC</p>
											<p>Historical Quad - HQ</p>
											<p>Willet Science Center - WSC</p>
											<p>School of Engineering - EGR</p>
											<p>Science and Engineering Building - SEB</p>
											<p>Godsey Science Center - GSC</p>
										</div>
										<div class="col">
											<p>Knight Hall - KNT</p>
											<p>Ryals Hall - RYL</p>
											<p>Langdale Hall - LNG</p>
											<p>Groover Hall - GRV</p>
											<p>Ware Hall - WRE</p>
											<p>Wiggs Hall - WIG</p>
										</div>
										<div class="col">
											<p>Cruz Plaza - CRZ</p>
											<p>Penfield Hall - PEN</p>
											<p>Auxiliary Services - AUX</p>
											<p>Mercer Police Station - MRP</p>
											<p>Stetson Hall - STS</p>
											<p>School of Medicine - MED</p>
										</div>
										<div class="col">
											<p>Willingham Hall - WLG</p>
											<p>Boone Hall - BNE</p>
											<p>Porter Hall - PRT</p>
											<p>Dowell Hall - DOW</p>
											<p>Legacy Hall - LEG</p>
											<p>Plunkett Hall - PLN</p>
										</div>
									</div>
								</div>
							</div>


							<a href="https://residencelife.mercer.edu/www/images/MaconCampusMap19-20.jpg" target="_blank">
								<li class="nlinks">Printable Map</li>
							</a>
							<a href="https://www.mercer.edu/" target="_blank">
								<li class="nlinks">Mercer Website</li>
							</a>
						</ul>
					</div>
				</nav>
			</div>

			<div class="col">
				<img src="https://www.mercer.edu/wp-content/uploads/2019/04/cropped-android-chrome-512x512.png" alt="Mercer Logo" width="80" height="80">
				<h1> Mercer University Campus Map </h1>
			</div>

			<div class="col">
				<button class='clearDirections'> Clear Directions </button>
			</div>

			<div class="col">
				<input id='filterbar' placeholder='Filter by Building Name' value="">
			</div>

			<div class="col">
				<!-- Trigger/Open The Modal -->
				<button id="btn2" class="modal-button" href="#myModal1">Input Directions Here!</button>
			</div>





		</div>
		<!-- The Modal -->
		<div id="myModal1" class="modal">

			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<h2>Input Directions Here</h2>
					<span class="close">&times;</span>
				</div>
				<div class="modal-body">
					<div class="container" id='searchbar' style='width:70% height 400px;'>

						<div class="row">

							<div class="col" style='background-color: lightgrey'>
								<p id='input'> Please Enter Origin Location </p>
								<!-- Search box. -->
								<input type="text" autocomplete="off" id="search" placeholder="Select Origin" />
								<br>
								<input type='button' id='confirm' value='Confirm Location'>
								<br />
								<!-- Suggestions will be displayed in below div. -->
								<div id="display"></div>
								<div id='message'></div>

							</div>

							<div class="col" style='background-color: white'>
								<p id='input'> Please Enter Destination Location </p>
								<input type="text" autocomplete="off" id="search2" placeholder="Select Destination" />
								<br>
								<input type='button' id='confirm2' value='Confirm Location'>
								<br />
								<!-- Suggestions will be displayed in below div. -->
								<div id="display2"></div>
								<div id='message2'></div>
							</div>


						</div>

						<div class='row'>

							<input type="button" id="directions" value="Get Directions" />

						</div>

					</div>
				</div>
				<div class="modal-footer">
					<h3>Thank you for using Campus Directions!</h3>
				</div>
			</div>
		</div>
		<?php

		/*code for connecting to phpmyadmin database. */

		$con = new mysqli('localhost', 'root', 'xXdBLnejWq3h9s', 'mapApp');

		if ($con->connect_error) {
			die('could not connect to mySQL: ' . $con->connect_error);
		}

		$centerData = $con->query("SELECT * FROM coordinates WHERE bcode = 'UC'");

		if ($centerData) {
			$center = $centerData->fetch_assoc();
		} else
			die("SELECT CENTER FAILED");

		?>

		</div>


		<script> </script>
	</header>

<body>

	<div id='test'></div>

	<?php

	global $con;

	function utf8ize($input)
	{

		if (is_array($input)) {
			foreach ($input as $k => $v) {
				$input[$k] = utf8ize($v);
			}
		} else if (is_string($input)) {
			return utf8_encode($input);
		}
		return $input;
	};

	$markerData = $con->query("SELECT * FROM coordinates ORDER BY indx");

	$r = array();
	$count = 0;

	while ($row = mysqli_fetch_assoc($markerData)) {

		$r[] = $row;
		$count = $count + 1;
	}

	?>


	<div style="display: none" id='totalCoords'><?php echo json_encode(utf8ize($r)); ?></div>
	<input hidden id='coordinate' value='' />
	<input hidden id='coordinate2' value='' />



	<div id="map" class='map'></div>

	<div id='detailsBar' class='detailsBar'>

		<div>

			<div><img class=img-holder id='locationImage' src=''></div>
			<button class='details-pane-close'>x</button>
			<div class='details-pane-title'></div>

		</div>

		<div class='details-pane-content'></div>
	</div>

	<script type="text/javascript" src="scripts.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA8OXkLqtVF7X51RpqSBL5MjTPZqTNdIo&callback=myMap"> </script>

</body>

</html>