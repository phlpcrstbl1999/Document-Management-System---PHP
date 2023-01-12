<?php
    include('../db/db.php');

    if(isset($_POST["province"])) {
    $province = $_POST["province"];
    $sql = "select * from GIIS_CITY where PROVINCE_CD = '$province'";
    $result = sqlsrv_query($con, $sql);
    if($result) { 
        ?>
         <option readonly>Select City</option>
    <?php 
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
    ?>
    <option value="<?php echo strtoupper($row["CITY_CD"]);?>"><?php echo strtoupper($row["CITY"]);?></option>
    <?php
    }
    }
}
 

        

?>