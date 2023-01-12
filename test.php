<?php
    
   include('../db/db.php');
   include('../db/oracleDb.php');
   session_start();
    if(isset($_POST['submit'])) {
    $assdno = $_POST['assd_no'];
    $account = $_POST['acc'];
    $empid = $_POST['emp_id'];
    $bday = $_POST['birthday'];
    $tin = $_POST['tin'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    $sql = "SELECT * FROM giis_assured where ASSD_NO = '$assdno'";
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    $i = 0;
    while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
        if($account == 'Individual') {
            $fname = $row['FIRST_NAME'];
            $mname = $row['MIDDLE_INITIAL'];
            $lname = $row['LAST_NAME'];
            $name = $row['ASSD_NAME'];
        } else {
            $name = $row['ASSD_NAME'];
        }
            $contact = $row['PHONE_NO'];
            $email = $row['EMAIL_ADDRESS'];
        $i++;
    }

    if($tin == '' || $bday == '' || $tin == '-' || $tin == '*' || $tin == '---') {
        $_SESSION['status_code'] = 'warning';
        $_SESSION['status'] = 'Cannot import customer';
        $_SESSION['status_text'] = 'Information is not complete.';
        if($type == 'Assured') {
            if($account == 'Individual') {
                header("location:../importcustomer.php?Type=Assured&Account=Individual");
            } else if($account == 'Corporate') {
                header("location:../importcustomer.php?Type=Assured&Account=Corporate");
            } else {
                header("location:../importcustomer.php?Type=Assured&Account=Joint");
            }
        } else {
            if($account == 'Individual') {
                header("location:../importcustomer.php?Type=Intermediary&Account=Individual");
            } else {
                header("location:../importcustomer.php?Type=Intermediary&Account=Corporate");
            }
        }
        
    }else {
        $bd = date('Y-m-d', strtotime($bday));   
        $sql = "SELECT tin, bdate from customer_tbl where tin = '$tin' AND bdate = '$bd'";
        $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
        $row_count = sqlsrv_num_rows($result);
        if($row_count == 1) {
            $_SESSION['status'] = "Customer Already Exist";
            $_SESSION['status_code'] = "warning";  
            $_SESSION['status_text'] = "Please try again";
            if($account == 'Individual') {
                header("location:../importcustomer.php?Type=Assured&Account=Individual");
            } else if($account == 'Corporate'){
                header("location:../importcustomer.php?Type=Assured&Account=Corporate");
            } else {
                header("location:../importcustomer.php?Type=Assured&Account=Joint");
            }
        }
        else {
        date_default_timezone_set('Asia/Taipei');
        $date = date("m/d/Y") . ' ' . date("h:ia");
        if($account == 'Individual') {
            $sql =  "INSERT INTO customer_tbl(fullname, name_fn, name_mn, name_ln ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$fname', '$mname', '$lname', '$tin', '1', 'Individual Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace('/', '-', $name);
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
                header("location:../importcustomer.php?Type=Assured&Account=Individual");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        } else if($account == 'Corporate'){
            $sql =  "INSERT INTO customer_tbl(fullname, name_corp,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$name', '$tin', '1', 'Corporate Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace('/', '-', $name);
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
                header("location:../importcustomer.php?Type=Assured&Account=Corporate");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        } else {
            $sql =  "INSERT INTO customer_tbl(fullname, name_corp,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$name', '$tin', '1', 'Joint Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace('/', '-', $name);
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
                header("location:../importcustomer.php?Type=Assured&Account=Joint");
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
    $account = $_POST['acc'];
    $type = $_POST['type'];
    $empid = $_POST['emp_id'];
    $bday = $_POST['birthday'];
    $tin = $_POST['tin'];
    $address = $_POST['address'];
/*
post submit interno post interno account post acc type post type empid post emp id bday post birth

*/
    $sql = "SELECT * FROM giis_intermediary where INTM_NO = '$interno'";
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    $i = 0;
    while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
            $name = $row['INTM_NAME'];
            $contact = $row['PHONE_NO'];
            $email = $row['EMAIL_ADDRESS'];
        $i++;
    }
    if($tin == '' || $bday == '' || $tin == '-' || $tin == '*' || $tin == '---') {
        $_SESSION['status_code'] = 'warning';
        $_SESSION['status'] = 'Cannot import customer';
        $_SESSION['status_text'] = 'Information is not complete.';
        if($type == 'Assured') {
            if($account == 'Individual') {
                header("location:../importcustomer.php?Type=Assured&Account=Individual");
            } else if($account == 'Corporate') {
                header("location:../importcustomer.php?Type=Assured&Account=Corporate");
            } else {
                header("location:../importcustomer.php?Type=Assured&Account=Joint");
            }
        } else {
            if($account == 'Individual') {
                header("location:../importcustomer.php?Type=Intermediary&Account=Individual");
            } else {
                header("location:../importcustomer.php?Type=Intermediary&Account=Corporate");
            }
        }
        
    }else {
        $bd = date('Y-m-d', strtotime($bday));   
            $sql = "SELECT tin, bdate from customer_tbl where tin = '$tin' AND bdate = '$bd'";
            $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
            $row_count = sqlsrv_num_rows($result);
            if($row_count == 1) {
                $_SESSION['status'] = "Customer Already Exist";
                $_SESSION['status_code'] = "warning";  
                $_SESSION['status_text'] = "Please try again";
                if($account == 'Individual') {
                    header("location:../importcustomer.php?Type=Intermediary&Account=Individual");
                } else {
                    header("location:../importcustomer.php?Type=Intermediary&Account=Corporate");
                }
            }
            else {
        date_default_timezone_set('Asia/Taipei');
        $date = date("m/d/Y") . ' ' . date("h:ia");
        if($account == 'Individual') {
            $sql =  "INSERT INTO customer_tbl(fullname ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$tin', '2', 'Individual Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace('/', '-', $name);
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
                header("location:../importcustomer.php?Type=Intermediary&Account=Individual");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        } else {
            $sql =  "INSERT INTO customer_tbl(fullname, name_corp ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, emp_id, date_created)VALUES('$name', '$name', '$tin', '2', 'Corporate Account', '$address', '$bd', '$contact', '$email', '$empid', '$date')";
            $stmt = sqlsrv_query($con, $sql);
            if($stmt) {
                $folderName = str_replace('/', '-', $name);
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
                header("location:../importcustomer.php?Type=Intermediary&Account=Corporate");
            }
            else {
                die( print_r( sqlsrv_errors(), true));
            }
        }
    }
}
}
?>