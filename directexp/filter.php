<?php 

//code for putting up/taking down markers on the fly

    include "db.php";

    global $con;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $input = $_POST['input'];

    if (isset($input)){

        $filterQuery = $con -> query("SELECT bcode FROM coordinates WHERE bname LIKE '%". $input ."%'");

       while($row = mysqli_fetch_assoc($filterQuery)){
           $r[] = $row['bcode']; 
       }}
    else 
    echo "query failed";

    echo json_encode($r);
?>