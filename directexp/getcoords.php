<?php


    include "db.php";

    global $con;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    

    if (isset($_POST['search'])) {


        //echo "<input hidden type=text id=name value='" . $_POST['search'] . "'>";
        echo "<h5>" . $_POST['search'] . "</h5>";

        $Query = $con -> query("SELECT * FROM coordinates WHERE bcode = '".$_POST['search']."'");

        if($Query) {

            echo "Query Succesful <br>";   

            $row = mysqli_fetch_assoc($Query);

                if(!is_null($row["lat"])) {

                    echo "Latitude Found:" . $row['lat'];
                    echo "<br>";

                }
                else echo 'Failed to find Latitude';

                if(!is_null($row["lon"])) {

                    echo "Longitude Found:" . $row['lon'];
                    echo "<br>";
                }
                else echo 'Failed to find Longitude';
                    ?>
 
                
                <?php
       
        }   
        else{echo "Query Failed";}
    }
   

     

?>
