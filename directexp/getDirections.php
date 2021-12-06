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

?>