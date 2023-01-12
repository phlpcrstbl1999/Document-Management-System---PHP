<?php
    
   include('../db/db.php');
   include('../db/oracleDb.php');
   session_start();
    if(isset($_POST['submit'])) {
    $assdno = $_POST['assd_no'];
    $empid = $_POST['emp_id'];
    $bday = $_POST['birthday'];
    $tin = $_POST['tin'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM giis_assured where ASSD_NO = '$assdno'";
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    $i = 0;
    while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
        $account = $row['CORPORATE_TAG'];
        if($account == 'I') {
            $fname = $row['FIRST_NAME'];
            $mname = $row['MIDDLE_INITIAL'];
            $lname = $row['LAST_NAME'];
            $name = str_replace(str_split('?'), 'Ñ', $row['ASSD_NAME']);            
        } else {
            $name = str_replace(str_split('?'), 'Ñ', $row['ASSD_NAME']); 
        }
            $contact = $row['PHONE_NO'];
            $email = $row['EMAIL_ADDRESS'];
        $i++;
    }
     

    if($tin == '' || $bday == '' || $tin == '-' || $tin == '*' || $tin == '---') {
        $_SESSION['status_code'] = 'warning';
        $_SESSION['status'] = 'Cannot import customer';
        $_SESSION['status_text'] = 'Information is not complete.';
            header("location:../importcustomer.php");
    
        
    }else {
        $bd = date('Y-m-d', strtotime($bday));   
        $sql = "SELECT tin, bdate from customer_tbl where tin = '$tin' AND bdate = '$bd'";
        $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
        $row_count = sqlsrv_num_rows($result);
        if($row_count == 1) {
            $_SESSION['status'] = "Customer Already Exist";
            $_SESSION['status_code'] = "warning";  
            $_SESSION['status_text'] = "Please try again";
                header("location:../importcustomer.php");
        }
        else {
        date_default_timezone_set('Asia/Taipei');
        $date = date("m/d/Y") . ' ' . date("h:ia");
        if($account == 'I') {
            $sql =  "INSERT INTO customer_tbl(fullname, name_fn, name_mn, name_ln ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$fname', '$mname', '$lname', '$tin', '1', 'Individual Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace(str_split('\\/'), '-', $name);

                if(strlen($folderName) > 150) {
                  $folderName = substr($folderName,0,150);   
                }  

                $last = $folderName[strlen($folderName)-1];
                if($last == '.' || $last == ',') {
                    $newFolderName = rtrim($folderName, ".");
                    $dir = "../documents/$newFolderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                } else {
                    $dir = "../documents/$folderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                }
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] = 'Success';
                $_SESSION['status_text'] = 'Import Successfully';
                header("location:../importcustomer.php");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        } else if($account == 'C'){
            $sql =  "INSERT INTO customer_tbl(fullname, name_corp,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$name', '$tin', '1', 'Corporate Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace(str_split('\\/'), '-', $name);

                if(strlen($folderName) > 150) {
                  $folderName = substr($folderName,0,150);   
                }                  
                $last = $folderName[strlen($folderName)-1];
                if($last == '.' || $last == ',') {
                    $newFolderName = rtrim($folderName, ".");
                    $dir = "../documents/$newFolderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                } else {
                    $dir = "../documents/$folderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                }
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] = 'Success';
                $_SESSION['status_text'] = 'Import Successfully';
                header("location:../importcustomer.php");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        } else {
            $sql =  "INSERT INTO customer_tbl(fullname, name_corp,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$name', '$tin', '1', 'Joint Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace(str_split('\\/'), '-', $name);

                if(strlen($folderName) > 150) {
                  $folderName = substr($folderName,0,150);   
                }  
                $last = $folderName[strlen($folderName)-1];
                if($last == '.' || $last == ',') {
                    $newFolderName = rtrim($folderName, ".");
                    $dir = "../documents/$newFolderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                } else {
                    $dir = "../documents/$folderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                }
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] = 'Success';
                $_SESSION['status_text'] = 'Import Successfully';
                header("location:../importcustomer.php");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        }
    }
}
}

if(isset($_POST['submit2'])) {
    $interno = $_POST['interno'];
    $empid = $_POST['emp_id'];
    $bday = $_POST['birthday'];
    $tin = $_POST['tin'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM giis_intermediary where INTM_NO = '$interno'";
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    $i = 0;
    while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
            $account = $row['CORP_TAG'];
            $name = str_replace(str_split('?'), 'Ñ', $row['INTM_NAME']);
            $contact = $row['PHONE_NO'];
            $email = $row['EMAIL_ADDRESS'];
            $lic_tag = $row['LIC_TAG'];
        $i++;
    }
    if($tin == '' || $bday == '' || $tin == '-' || $tin == '*' || $tin == '---') {
        $_SESSION['status_code'] = 'warning';
        $_SESSION['status'] = 'Cannot import customer';
        $_SESSION['status_text'] = 'Information is not complete.';
            header("location:../importcustomer.php");

        
    }else {
        $bd = date('Y-m-d', strtotime($bday));   
            $sql = "SELECT tin, bdate from customer_tbl where tin = '$tin' AND bdate = '$bd'";
            $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
            $row_count = sqlsrv_num_rows($result);
            if($row_count == 1) {
                $_SESSION['status'] = "Customer Already Exist";
                $_SESSION['status_code'] = "warning";  
                $_SESSION['status_text'] = "Please try again";
                header("location:../importcustomer.php");

            }
            else {
        date_default_timezone_set('Asia/Taipei');
        $date = date("m/d/Y") . ' ' . date("h:ia");
        if($account == 'N') {
            $sql =  "INSERT INTO customer_tbl(fullname ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created, lic_tag)VALUES('$name', '$tin', '2', 'Individual Account', '$address', '$bd', '$contact', '$email', '$empid', '$date', '$lic_tag')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace(str_split('\\/'), '-', $name);

                if(strlen($folderName) > 150) {
                  $folderName = substr($folderName,0,150);   
                }  
                $last = $folderName[strlen($folderName)-1];
                if($last == '.' || $last == ',') {
                    $newFolderName = rtrim($folderName, ".");
                    $dir = "../documents/$newFolderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                } else {
                    $dir = "../documents/$folderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                }
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] = 'Success';
                $_SESSION['status_text'] = 'Import Successfully';
                header("location:../importcustomer.php");

            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        } else {
            $sql =  "INSERT INTO customer_tbl(fullname, name_corp ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created, lic_tag)VALUES('$name', '$name', '$tin', '2', 'Corporate Account', '$address', '$bd', '$contact', '$email', '$empid', '$date', '$lic_tag')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace(str_split('\\/'), '-', $name);

                if(strlen($folderName) > 150) {
                  $folderName = substr($folderName,0,150);   
                }  
                $last = $folderName[strlen($folderName)-1];
                if($last == '.' || $last == ',') {
                    $newFolderName = rtrim($folderName, ".");
                    $dir = "../documents/$newFolderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                } else {
                    $dir = "../documents/$folderName";
                    if (!mkdir($dir, 0777, true)) {//0777
                        die('Failed to create folders...');
                    }
                }
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] = 'Success';
                $_SESSION['status_text'] = 'Import Successfully';
                header("location:../importcustomer.php");

            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        }
    }
}
}
?>