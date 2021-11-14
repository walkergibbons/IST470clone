<?php


    include "db.php";

    global $con;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    echo $_POST['search'];
    echo "<br>";

    if (isset($_POST['search'])) {


        $_POST['search'];

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
                


            /*
            if( $row = $Query->fetch_assoc())
            {
            echo "<p> Latitude: ". $row['lat'] . " <br> Longitude ". $row['lon'];
            }
            else echo " <br> Failed to Print Coordinates";
            */


        }   
        else{echo "Query Failed";}
    }
   

     

?>
