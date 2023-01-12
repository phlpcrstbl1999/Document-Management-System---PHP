<?php
    include('../db/db.php');
    // ALTER TABLE tableName AUTO_INCREMENT = 1;
   
    session_start();
        //move_upload_files();
        if(isset($_POST['editsubmit'])) {
                $custid = $_POST['editcust_ID'];
                $bday = $_POST['editbdate'];
                $contact = $_POST['editcontact'];
                $email = $_POST['editemail'];
                $house = $_POST['edithousenum'];
                $tin = $_POST['tin'];
                $address = $house;
                // $query = "select * from customer_tbl where tin = '$tin' and bdate = '$bday'";
                // $result = sqlsrv_query($con, $query, array(), array( "Scrollable" => 'static' ));
                // $row_count = sqlsrv_num_rows($result);
                // if($row_count == 1) {
                //     $_SESSION['status'] = "Customer Already Exist";
                //     $_SESSION['status_code'] = "warning";  
                //     $_SESSION['status_text'] = "Please try again";
                //     header("location:../customerInformation.php");
                // }
                        date_default_timezone_set('Asia/Taipei');
                        $date = date("m/d/Y") . ' ' . date("h:ia");
                            if(isset($_POST['editfname'])) {
                                $fname = strtoupper($_POST['editfname']);
                                $sql = "update customer_tbl set fullname ='$fname', tin = '$tin', complete_add='$address', bdate ='$bday', contact_num = '$contact', email ='$email', addr_houseno_street='$house', addr_region_cd='$region', addr_province_cd='$province', addr_city_cd='$city', addr_brgy_cd='$barangay', addr_zipcode='$zip', date_modified='$date' where cust_ID = '$custid'";
                                $stmt = sqlsrv_query($con, $sql);
                                if($stmt) {
                                    $_SESSION['status'] = "Edited Successfully";
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
                                $corp = strtoupper($_POST['editcorp']);
                                $sql = "update customer_tbl set name_corp ='$corp', fullname ='$corp',  tin = '$tin',complete_add='$address', bdate ='$bday', contact_num = '$contact', email ='$email', addr_houseno_street='$house', addr_region_cd='$region', addr_province_cd='$province', addr_city_cd='$city', addr_brgy_cd='$barangay', addr_zipcode='$zip', date_modified='$date' where cust_ID = '$custid'";
                                $stmt = sqlsrv_query($con, $sql);
                                if($stmt) {
                                    $_SESSION['status'] = "Edited Successfully";
                                    $_SESSION['status_code'] = "success";  
                                    $_SESSION['status_text'] = "";
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
                        }
                    
                    
        

    
        

        

?>