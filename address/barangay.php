<?php
    include('../db/db.php');

    if(isset($_POST["city"])) {
    $city = $_POST["city"];
    $sql = "select * from GIIS_BARANGAY where CITY_CD = '$city'";
    $result = sqlsrv_query($con, $sql);
    if($result) { 
        ?>
        <option readonly>Select Barangay</option>
    <?php
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
    ?>
    <option value="<?php echo strtoupper($row["BRGY_CD"]);?>"><?php echo strtoupper($row["BRGY"]);?></option>
    <?php
    }
    }
}

        

        

?>