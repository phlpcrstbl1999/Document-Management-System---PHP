<?php
include('../db/db.php');
session_start();
if(isset($_POST["licTag"])) {
$licTag = $_POST["licTag"];

if($licTag == 'ALL') {
    unset($_SESSION['licTag']);
    $_SESSION['selected'] = 'ALL';

header('location:../customerInformation.php');
} else if($licTag == 'LICENSED') {
    $_SESSION['selected'] = 'LICENSED';

$_SESSION['licTag'] = 'Y';
header('location:../customerInformation.php');

} else {
$_SESSION['licTag'] = 'N';
$_SESSION['selected'] = 'UNLICENSED';
header('location:../customerInformation.php');

}
}

if(isset($_POST["licTagDocu"])) {
    $licTag = $_POST["licTagDocu"];
    
    if($licTag == 'ALL') {
        unset($_SESSION['licTagDocu']);
        $_SESSION['selectedDocu'] = 'ALL';
    
    header('location:../customerDocument.php');
    } else if($licTag == 'LICENSED') {
        $_SESSION['selectedDocu'] = 'LICENSED';
    
    $_SESSION['licTagDocu'] = 'Y';
    header('location:../customerDocument.php');
    
    } else {
    $_SESSION['licTagDocu'] = 'N';
    $_SESSION['selectedDocu'] = 'UNLICENSED';
    header('location:../customerDocument.php');
    
    }
    }
?>