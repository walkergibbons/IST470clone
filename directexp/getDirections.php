<?php 

    include "db.php";

    global $con;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $originCode = $_POST['org'];
    $destCode = $_POST['dest'];

if (isset($destCode) and isset($originCode)){
        
        $orgQuery = $con -> query("SELECT * FROM coordinates WHERE bcode = '".$_POST['org']."'");

            $row = mysqli_fetch_assoc($orgQuery);

            $origin = $row['lat'] . ", " . $row['lon'];

         $destQuery = $con -> query("SELECT * FROM coordinates WHERE bcode = '".$_POST['dest']."'");

            $roww = mysqli_fetch_assoc($destQuery);

            $destination = $roww['lat'] . ", " . $roww['lon'];

            ?>

        <input hidden id='url' type='text' value='<?php echo 'https://maps.googleapis.com/maps/api/directions/json?origin='. $origin . '&destination=' . $destination . '&mode=walking&key=AIzaSyCA8OXkLqtVF7X51RpqSBL5MjTPZqTNdIo'; ?> '>

        <?php
    }

/* defunct code for testing purposes, consult Hoid on if i should deleet

    echo 'proof: ' . $_POST['org'];
    echo '<br>';
    echo 'proof: ' . $_POST['dest'];
    echo '<br>';
   

    if (isset($originCode)) {
    echo  'origin:' . $_POST['org'];
    echo '<br>';}
    else echo '<br> query failed <br>';


    if (isset($destCode)) {
    echo 'destination:' .$_POST['dest'];
    echo '<br>';}
    else echo 'query failed <br>';


    if (isset($originCode)) {

        $orgQuery = $con -> query("SELECT * FROM coordinates WHERE bcode = '".$_POST['org']."'");

            echo "Query Succesful <br>";   

            $row = mysqli_fetch_assoc($orgQuery);

            $origin = $row['lat'] . ", " . $row['lon'];

            echo $origin;
    
    }
    else echo 'query failed <br>';

    if (isset($destCode)) {

        $destQuery = $con -> query("SELECT * FROM coordinates WHERE bcode = '".$_POST['dest']."'");

            echo "Query Succesful <br>";   

            $row = mysqli_fetch_assoc($destQuery);

            $destination = $row['lat'] . ", " . $row['lon'];

            echo $destination;
    
    }
    else echo 'query failed <br>';

    */
