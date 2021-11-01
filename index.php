<!DOCTYPE html>
<html lang='en'>
<head>
	<title> IST 470 Campus Directions </title>
	<meta charset='utf-8'>
<header style = "text-align: center; background-color: #565657; font: large Arial">

<h1> IST470 Campus Directions Project </h1>

 </header>


 <!-- this part is supposed to connect to the database -->
<?php
	$con = new mysqli('localhost', 'root', 'PC5X6e4qejsK3s', 'ist470');
	if ($con->connect_error)
	{
		die('could not connect to mySQL: ' . $con->connect_error);
	}
	else
	//	echo "Successfully Connected to Database. ";


	$centerData = $con->query("SELECT * FROM coordinates WHERE bcode = 'UC'");

	if ($centerData)
	{
		$center = $centerData->fetch_assoc();
	//	echo "Successfully Retreived Center Data. ";
	}
	else
		die("SELECT CENTER FAILED");
?>
</head>



<div id = 'origin'>

<!-- This div is gonna be used to ask the user for their starting location. This should ask the user to search for a building code or name from the database, pull it, and apply it as the origin parameter. Probably best to use a JS method here  -->
<!-- Ideally, this bitch will appear and say 'Hey, please select a starting location' and then disappear after user input -->

</div>



<body style = 'font: Impact, sans-serif; background-color:#b3b3b3; text-align:center'>

<div id = 'googleMap' style = "width:100%; height:700px; font: sans-serif "></div>

<!--
	<script>
	function myMap()
	{

		var mapProp=
		{

			center:new google.maps.LatLng(<?php echo $center['lat'] . ", " . $center['Lon']?>),
				zoom:6,

		};

		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);


	-->
	
<!-- currently the PHP isnt working for pulling a Map Center from the database. Probably because the method it's calling doesnt exist -->
	<script>
	function myMap()
	{

		var mapProp=
		{

			center:new google.maps.LatLng('32.8275', '-83.6494'),
				zoom:16,

		};

	
		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

//code for placing markers on the map. Gonna be useful for pulling waypoints for the beginning/end of the directions line. 

	<?php

	$markerData = $con->query("SELECT * FROM markers WHERE type = 'm'");

	if($markerData)
	{
		while($row = $markerData->fetch_assoc())
		{
	
			
			echo "var m" . $row['ID'] . " =new google.maps.Marker({position:new google.maps.LatLng(".$row['Lat'] . ", " . $row['Lon'] . ")});\n";
			echo "m" . $row['ID'] . ".setMap(map);\n";
			echo "var i" . $row['ID'] . " = new google.maps.InfoWindow({content: '".htmlentities($row['Description']) . "'});\n";
			echo "m" . $row['ID'] . ".addListener('click', function()  {i" . $row['ID'] . ".open(map, m" . $row['ID'] . ");});\n";

	
		//	echo "Successfully Retreived Map Marker Data";
		}


	}
	
	?>
	
	}

	</script>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA8OXkLqtVF7X51RpqSBL5MjTPZqTNdIo&callback=myMap"></script>
<!--
<div style = "border: 5px solid black; font: large Arial; background-color:#565657"> 
<p> Click the link below to access the Marker Entry Form </p>
<a href="data.php">Marker Data Entry Form</a> 
</div>
-->
</body>



</html>


