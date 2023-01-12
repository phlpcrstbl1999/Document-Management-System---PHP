<?php
    include('../db/db.php');
            session_start();
    
            $cust_id = $_POST['custid'];
            $sql = "DELETE from customer_tbl WHERE cust_ID = '$cust_id'";
            $query = sqlsrv_query($con, $sql);

            if($query) {
                $_SESSION['delete'] = "File Deleted Successfully";
                header("location:../customermanagement.php");
            }
            else {
            die( print_r( sqlsrv_errors(), true));
            }

?>