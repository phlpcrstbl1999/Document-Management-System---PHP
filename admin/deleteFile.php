<?php
    include('../db/db.php');
            session_start();
            if(isset($_SESSION['del'])) {
            $file_id = $_POST['file_id'];
            $file_name = $_POST['file_name'];
            
            $sql = "DELETE from docs_tbl WHERE doc_ID = '$file_id'";
            $query = sqlsrv_query($con, $sql);

            if($query) {
                unlink("../dept1/".$file_name);
                $_SESSION['delete'] = "File Deleted Successfully";
                header("location:../documentmanagement.php");
            }
            else {
            die( print_r( sqlsrv_errors(), true));
            }
        }

                  

?>