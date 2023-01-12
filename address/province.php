<?php
    include('../db/db.php');

    if(isset($_POST["region"])) {
    $region = $_POST["region"];
    $sql = "select * from GIIS_PROVINCE where REGION_CD = '$region'";
    $result = sqlsrv_query($con, $sql);
    if($result) {
    ?>
         <option readonly>Select Province</option>
    <?php
 
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
    ?>
    <option value="<?php echo strtoupper($row["PROVINCE_CD"]);?>"><?php echo strtoupper($row["PROVINCE_DESC"]);?></option>
    <?php
    }
    }
}

        

        

?>