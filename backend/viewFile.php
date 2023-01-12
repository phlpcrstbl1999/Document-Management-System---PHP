<?php
include('../db/db.php');
session_start();
if(isset($_POST['submit'])) {

$custid = $_POST['cust_ID'];
$name = $_POST['name'];
$empid = $_POST['emp_id'];
$_SESSION['enable'] = 'hidden';
$_SESSION['custid'] = $custid;
$_SESSION['name'] = $name;
$_SESSION['empid'] = $empid;
header("location:../customerDocument.php");
}

if(isset($_POST['submit1'])) {

    $custid = $_POST['cust_ID'];
    $name = $_POST['name'];
    $empid = $_POST['emp_id'];
    $_SESSION['enable'] = 'hidden';
    $_SESSION['custid'] = $custid;
    $_SESSION['name'] = $name;
    $_SESSION['empid'] = $empid;
    header("location:../documentmanagement.php");
    }
?>