<!DOCTYPE html>
<html lang='en'>

<head>

	<title> Mercer University Campus Map </title>

	<header style="text-align: center; background-color: #f76800; font: Optima; border-bottom-style:solid">


		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<div class = "row">
<div class = "col">
<!-- Hamburger Menu-->
<nav role="navigation">
  <div id="menuToggle">

    <input type="checkbox" />

    <span></span>
    <span></span>
    <span></span>
    

    <ul id="menu">
      <a href="#"><li>Building Codes</li></a>
      <a href="https://residencelife.mercer.edu/www/images/MaconCampusMap19-20.jpg" target="_blank"><li>Printable Map</li></a>
      <a href="https://www.mercer.edu/" target="_blank"><li>Mercer Website</li></a>   
    </ul>
  </div>
</nav>
</div>

	<div class = "col">
	<img src="https://www.mercer.edu/wp-content/uploads/2019/04/cropped-android-chrome-512x512.png" alt="Mercer Logo" width="80" height="80">
		<h1> Mercer University Campus Map </h1>
	</div>
	<div class = "col">

		<!-- Trigger/Open The Modal -->
		<button id="myBtn" class="epicMealTime">Input Directions Here!</button>

	</div>
</div>


			<!-- The Modal -->
		<div id="myModal" class="modal">

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
				<input type="text" autocomplete="off" id="search" placeholder="Select Building Code" />
				<br>
				<b>Ex: </b><i>WSC, UC, CSC, SEB</i>
				<br />
				<!-- Suggestions will be displayed in below div. -->
				<div id="display"></div>

				<input type="button" id="button" name="origin" value="Get Coordinates" />
			</div>

			<div class="col" style='background-color: white'>
				<p> Origin Information </p>
				<div id='originresult' style='background-color: lightgrey'></div>
			</div>

			<div class="col" style='background-color: lightgrey'>
				<p> Destination Information </p>
				<div id='destinationresult' style='background-color: white'></div>

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
		

	</div>
		<?php

		/*code for connecting to phpmyadmin database. */

		$con = new mysqli('localhost', 'root', 'ro34k189sKp7Af', 'ist470');

		if ($con->connect_error) {
			die('could not connect to mySQL: ' . $con->connect_error);
		}


		$centerData = $con->query("SELECT * FROM coordinates WHERE bcode = 'UC'");

		if ($centerData) {
			$center = $centerData->fetch_assoc();

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

	</div>
	</header>

<body>




	<div id="map" style="width:100%;height:800px;"></div>
	<script>
		function myMap() {

			var mapProp = {
				center: new google.maps.LatLng('32.8275', '-83.6494'),
				zoom: 16,
				//does the hide thing
				mapTypeId: google.maps.MapTypeId.ROADMAP,
  styles: [
    {
      "featureType": "poi",
      "stylers": [
        { "visibility": "off" }
      ]
    }
  ]
			};

			var map = new google.maps.Map(document.getElementById("map"), mapProp);

			<?php addMarkers(); ?>

		}
	</script>









	<div hidden id='urlholder'></div>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA8OXkLqtVF7X51RpqSBL5MjTPZqTNdIo&callback=myMap"> </script>

	<script type="text/javascript" src="scripts.js"></script>
</body>

</html>
