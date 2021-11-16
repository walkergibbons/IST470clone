<!DOCTYPE html>
<html lang='en'>

<head>

	<title> IST470 Campus Directions </title>

	<header style="text-align: center; background-color: grey; font: large Arial">


		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="scripts.js"></script>


		<h1> IST470 Campus Directions </h1>

		<?php

		/*code for connecting to phpmyadmin database. */

		$con = new mysqli('localhost', 'root', 'PC5X6e4qejsK3s', 'ist470');

		if ($con->connect_error) {
			die('could not connect to mySQL: ' . $con->connect_error);
		} else
			echo "Successfully Connected to Database. ";


		$centerData = $con->query("SELECT * FROM coordinates WHERE bcode = 'UC'");

		if ($centerData) {
			$center = $centerData->fetch_assoc();
			echo "Successfully Retreived Center Data. ";
		} else
			die("SELECT CENTER FAILED");



		/*function for loading marker data into the addMarkers script*/

		function addMarkers()
		{

			global $con;

			$markerData = $con->query("SELECT * FROM coordinates");

			if ($markerData) {
				while ($row = $markerData->fetch_assoc()) {
					echo "var m" . $row['indx'] . " = new google.maps.Marker({position:new google.maps.LatLng(" . $row['lat'] . ", " . $row['lon'] . ")});\n";
					echo "m" . $row['indx'] . ".setMap(map); \n";

					/*echo "var i" . $row['ID'] . " = new google.maps.InfoWindow({content: '".htmlentities($row['Description']) . "'});\n";
		echo "m" . $row['ID'] . ".addListener('click', function()  {i" . $row['ID'] . ".open(map, m" . $row['ID'] . ");});\n"; */
				}
			}
		}



		?>

	</header>

<body>




	<div id="map" style="width:100%;height:800px;"></div>
	<script>
		function myMap() {

			var mapProp = {
				center: new google.maps.LatLng('32.8275', '-83.6494'),
				zoom: 16,
			};

			var map = new google.maps.Map(document.getElementById("map"), mapProp);

			<?php addMarkers(); ?>

		}
	</script>




	<div class="container" id='searchbar' style='width:70% height 400px;'>

		<div class="row">

			<div class="col" style='background-color: #ccffff'>
				<p id='input'> Please Enter Origin Location </p>
				<!-- Search box. -->
				<input type="text" autocomplete="off" id="search" placeholder="Select Building Code" />
				<br>
				<b>Ex: </b><i>WSC, UC, CSC, SEB</i>
				<br />
				<!-- Suggestions will be displayed in below div. -->
				<div id="display"></div>

				<input type="button" id="button" name="origin" value="Get Coordinates" />
			</div>

			<div class="col" style='background-color: #ccffcc'>
				<p> Origin Information </p>
				<div id='originresult' style='background-color: #ccffcc'></div>
			</div>

			<div class="col" style='background-color: #ffcccc'>
				<p> Destination Information </p>
				<div id='destinationresult' style='background-color: #ffcccc'></div>

			</div>
		</div>

		<div class='row'>

			<input type="button" id="directions" value="Get Directions" />

		</div>

	</div>


	<div id='test' style="background-color: green"></div>

	<div hidden id='urlholder'></div>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA8OXkLqtVF7X51RpqSBL5MjTPZqTNdIo&callback=myMap"> </script>


</body>

</html>