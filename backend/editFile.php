<?php
    include('../db/db.php');
    // ALTER TABLE tableName AUTO_INCREMENT = 1;
   session_start();
    
        if(isset($_POST['submit'])) {
              $id = $_POST['doc_ID'];
              $type = $_POST['doct'];
              $filename = $_POST['file_name'];
              $name = $_POST['name'];
              $empid = $_POST['emp_ID'];
            // // // foreach($_FILES['files']['name'] as $key=>$val) {
                $sql = "select * from doc_type where docu_ID = '$type'";
                $result = sqlsrv_query($con, $sql);
                if($result){
                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                        $doc_type = $row['docu_name'];
                    }
                }   
                    
                if (!empty($_FILES["update_file"]["name"])) {
                    if($doc_type == 'OTHERS') {
                        $temp = explode(".", $_FILES["update_file"]["name"]);
                        $info = pathinfo($filename);
                        $newfilename = $info['filename'] . '.' . end($temp);
                        $ext = end($temp);
                        $filenamerep = str_replace(str_split('\\/'), '-', $newfilename);

                    } else {
                        if(strlen($name) > 150) {
                          $name = substr($name,0,150);   
                        }  
                        $temp = explode(".", $_FILES["update_file"]["name"]);
                        $newfilename = $name . ' - ' . $doc_type . '.' . end($temp);
                        $ext = end($temp);
                        $filenamerep = str_replace(str_split('\\/'), '-', $newfilename);
                    }
                    if($ext == 'pdf' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                    $folderName = str_replace(str_split('\\/'), '-', $name);
                    if(strlen($folderName) > 150) {
                      $folderName = substr($folderName,0,150);   
                    }  
                    $newFolderName = rtrim($folderName, ".");
                    unlink("../documents/$newFolderName/$filename");
                    $move = move_uploaded_file($_FILES["update_file"]["tmp_name"], "../documents/$newFolderName/" . $filenamerep);
                                          
                    if($move) {
                        date_default_timezone_set('Asia/Taipei');
                      $date = date("m/d/Y") . ' ' . date("h:ia");
                    $sql = "UPDATE docs_tbl set date_modified ='$date', doc_filename = '$filenamerep', modified_by = '$empid' where doc_ID = '$id'";
                    $stmt = sqlsrv_query($con, $sql);
                    if($stmt) {
                        $_SESSION['edit_status'] = 'Edit Successful';
                        $_SESSION['edit_code'] = 'success';
                        $_SESSION['edit_codetext'] = '';
                        header("location:../customerDocument.php");
                    }
                    else {
                    die( print_r( sqlsrv_errors(), true));
                    }
                    }
                }else {
                    $_SESSION['edit_status'] = 'Wrong Filetype';
                    $_SESSION['edit_code'] = 'error';
                    $_SESSION['edit_codetext'] = 'Please try again!';
                    header("location:../customerDocument.php");
                }
                }
                else {  
                    $_SESSION['edit_status'] = 'Empty File';
                    $_SESSION['edit_code'] = 'warning';
                    $_SESSION['edit_codetext'] = 'Please try again!';
                    header("location:../customerDocument.php");   
                }
            }
    
        

        

?>