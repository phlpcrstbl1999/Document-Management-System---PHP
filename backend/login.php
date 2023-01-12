<?php
include('../db/db.php');
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$pass1 = md5($pass);
if(isset($_POST['submit'])) {
    if($user == 'admin' && $pass == 'admin@#') {
        header("location:../admin/dashboard.php");
        $_SESSION['login'] = 'success';
    }
    else {
    $sql = "select emp_id, emp_fname, emp_lname from user_tbl where username ='$user' and password = '$pass1'";
    // It is because sqlsrv_query() uses SQLSRV_CURSOR_FORWARD cursor type by default. 
    // However, in order to get a result from sqlsrv_num_rows(), 
    // you should choose one of these cursor types below:
    //     SQLSRV_CURSOR_STATIC
    //     SQLSRV_CURSOR_KEYSET
    //     SQLSRV_CURSOR_CLIENT_BUFFERED

    $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
    $id = sqlsrv_fetch_array($result);
    $emp_id = $id['emp_id'];
    $emp_fname = $id['emp_fname'];
    $emp_lname = $id['emp_lname'];
    $row_count = sqlsrv_num_rows($result);
    $emp_name = $emp_fname . ' ' . $emp_lname;
    if($row_count == 1) {
        $_SESSION['login'] = 'success';
        $_SESSION['id'] = $emp_id;
        $_SESSION['name'] = $emp_name;
      header("location:../dashboard.php");
       
    }

else {
    $_SESSION['statusLogin'] = "The username or password is incorrect";
    $_SESSION['status_codeLogin'] = "error";  
    $_SESSION['status_textLogin'] = "Please try again";
    header("location:../index.php");
}
}
}
?>