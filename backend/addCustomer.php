<?php
    include('../db/db.php');
    // ALTER TABLE tableName AUTO_INCREMENT = 1;
   
    session_start();
        //move_upload_files();
        if(isset($_POST['submit'])) {
                $custname = $_POST['custname'];
                $type = $_POST['custtype'];
                $bday = $_POST['bdate'];
                $contact = $_POST['contact'];
                $email = $_POST['email'];
                $tin = $_POST['tin'];
                $emp = $_POST['emp'];
                $house = $_POST['housenum'];
                $region = $_POST['region'];
                $province = $_POST['province'];
                $city = $_POST['city'];
                $barangay = $_POST['barangay'];
                $zip = $_POST['zip'];
                $tin = $_POST['tin'];
                if(!isset($_POST['zip'])) {
                    $zip = '';
                }
                $fname = strtoupper($_POST['fname']);
                $mname = strtoupper($_POST['mname']);
                $lname = strtoupper($_POST['lname']);
                $corp = strtoupper($_POST['corp']);
                //GET BARANGAY 
                $brgy = "select BRGY from GIIS_BARANGAY where BRGY_CD ='$barangay'";
                $resultbrgy = sqlsrv_query($con, $brgy, array(), array( "Scrollable" => 'static' ));
                $brgy_id = sqlsrv_fetch_array($resultbrgy);
                $barg = $brgy_id['BRGY'];
                //GET CITY 
                $citi = "select CITY from GIIS_CITY where CITY_CD ='$city'";
                $resultciti = sqlsrv_query($con, $citi, array(), array( "Scrollable" => 'static' ));
                $citi_id = sqlsrv_fetch_array($resultciti);
                $cit = $citi_id['CITY'];
                $name = $lname . ', ' . $fname . ' ' . $mname;
                $address = $house . ', ' . $barg . ', ' . $cit;
              
                    
                    
                date_default_timezone_set('Asia/Taipei');
                        $date = date("m/d/Y") . ' ' . date("h:ia");
                //     foreach($_FILES['files']['name'] as $key=>$val) {
                    $query = "select * from customer_tbl where tin = '$tin' and bdate = '$bday'";
                    $result = sqlsrv_query($con, $query, array(), array( "Scrollable" => 'static' ));
                    $row_count = sqlsrv_num_rows($result);
                    if($row_count == 1) {
                        $_SESSION['status'] = "Customer Already Exist";
                        $_SESSION['status_code'] = "warning";  
                        $_SESSION['status_text'] = "Please try again";
                        header("location:../customerInformation.php");
                    }
                    else {
                        if($corp == '' || $corp == null){
                            $sql = "INSERT INTO customer_tbl(fullname ,tin, cust_type_id, acctype_id, complete_add, bdate, contact_num, email, addr_houseno_street, addr_region_cd, addr_province_cd, addr_city_cd, addr_brgy_cd, addr_zipcode, emp_id, date_created)VALUES('$name', '$tin', '$type', '$custname', '$address', '$bday', '$contact', '$email', '$house', '$region', '$province', '$city', '$barangay', '$zip', '$emp', '$date')";
                            $stmt = sqlsrv_query($con, $sql);
                            if($stmt) {
                                $_SESSION['status'] = "Added Successfully";
                                $_SESSION['status_code'] = "success";  
                                $_SESSION['status_text'] = "    ";
                                header("location:../customerInformation.php");
                            }
                                else {
                                $_SESSION['status'] = "Oops";
                                $_SESSION['status_code'] = "error";  
                                $_SESSION['status_text'] = "Please try again";
                                header("location:../customerInformation.php");
                                die( print_r( sqlsrv_errors(), true));
    
                            }
                    }
                    else {
                        $sql = "INSERT INTO customer_tbl(name_corp ,tin ,cust_type_id, acctype_id, complete_add, bdate, contact_num, email, addr_houseno_street, addr_region_cd, addr_province_cd, addr_city_cd, addr_brgy_cd, addr_zipcode, emp_id, date_created)VALUES('$corp', '$tin' ,'$type', '$custname', '$address', '$bday', '$contact', '$email', '$house', '$region', '$province', '$city', '$barangay', '$zip', '$emp', '$date')";
                        $stmt = sqlsrv_query($con, $sql);
                        if($stmt) {
                            $_SESSION['status'] = "Added Successfully";
                            $_SESSION['status_code'] = "success";  
                            $_SESSION['status_text'] = "";
                            header("location: ../customerInformation.php");
                        }
                        else {
                            $_SESSION['status'] = "Oops";
                            $_SESSION['status_code'] = "error";  
                            $_SESSION['status_text'] = "Please try again";
                            header("location:../customerInformation.php");
                            die( print_r( sqlsrv_errors(), true));
        


                        }
                    }
                }
                }
        

    
        

        

?>