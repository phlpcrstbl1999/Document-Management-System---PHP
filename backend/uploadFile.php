<?php
    include('../db/db.php');
    // ALTER TABLE tableName AUTO_INCREMENT = 1;
   session_start();
    
        //move_upload_files();
        if(isset($_POST['submit'])) {
            $type = $_POST['doctype'];
            $name = $_POST['name'];
            $id = $_POST['id'];
            $empid = $_POST['empid'];
            $dept_id = $_POST['deptid'];  
            $others = $_POST['others'];
            if($others == ''){
                $sql = "select * from doc_type where docu_ID = '$type'";
                $result = sqlsrv_query($con, $sql);
                if($result){
                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                          $doc_type = $row['docu_name'];
                    }
                  }
            }else {
                $doc_type = strtoupper($others);
            }
      //foreach($_FILES['files']['name'] as $key=>$val) {
            if(strlen($name) > 150) {
                $name = substr($name,0,150);   
            } 
              $temp = explode(".", $_FILES["files"]["name"]);
              $newfilename = $name . ' - ' . $doc_type . '.' . end($temp);
              $ext = end($temp);
              $filename = str_replace(str_split('\\/'), '-', $newfilename);
              $like = str_replace(str_split('\\/'), '-', $name . ' - ' . $doc_type);
              $query = "select doc_filename from docs_tbl where doc_filename LIKE '%$like%'";
              $result = sqlsrv_query($con, $query, array(), array( "Scrollable" => 'static' ));
              $row_count = sqlsrv_num_rows($result);
              if($row_count == 1) {
                  $_SESSION['add_status'] = "Document Already Exist";
                  $_SESSION['add_code'] = "warning";  
                  $_SESSION['add_codetext'] = "Please try again";
                  header("location:../customerDocument.php");
              }else {
              // pdf, png, jpg, jpeg, docx, doc
              if($ext == 'pdf' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                $folderName = str_replace(str_split('\\/'), '-', $name);
                if(strlen($folderName) > 150) {
                  $folderName = substr($folderName,0,150);   
                }  
                $newFolderName = rtrim($folderName, ".");
                $move = move_uploaded_file($_FILES["files"]["tmp_name"], "../documents/$newFolderName/" . $filename);
                  if($move) {
                      date_default_timezone_set('Asia/Taipei');
                      $date = date("m/d/Y") . ' ' . date("h:ia");
                     
                      $sql = "INSERT INTO docs_tbl(doc_filename, docu_ID, cust_ID, date_upload, emp_ID)VALUES('$filename', '$type', '$id', '$date', '$empid')";
                      $stmt = sqlsrv_query($con, $sql);
                      if($stmt) {
                          $_SESSION['add_status'] = 'Upload Successful';
                          $_SESSION['add_code'] = 'success';
                          $_SESSION['add_codetext'] = '';
                          header("location:../customerDocument.php");
                      }
                      else {
                      $_SESSION['add_status'] = 'Oops';
                      $_SESSION['add_code'] = 'error';
                      $_SESSION['add_codetext'] = 'Please try again!';

                      header("location:../customerDocument.php");
                      }
                  }  
              }
              else {
                  $_SESSION['add_status'] = 'Wrong Filetype';
                  $_SESSION['add_code'] = 'error';
                  $_SESSION['add_codetext'] = 'Please try again!';
                  header("location:../customerDocument.php");
              }
        }
    }
        

?>