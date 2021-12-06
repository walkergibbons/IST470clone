<?php

    include "db.php";

    global $con;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    if (isset($_POST['search'])) {

        $Query = $con -> query("SELECT * FROM coordinates WHERE bcode = '".$_POST['search']."'");

        if($Query) {           
            $row = mysqli_fetch_assoc($Query); 
            echo $row['lat'] . ", " . $row['lon'];     
        }          
    } 
?>
