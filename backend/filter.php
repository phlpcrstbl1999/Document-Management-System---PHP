<?php
   include('../db/db.php');
   include('../db/oracleDb.php');
   session_start();

   if(isset($_POST['submit'])) {
        $cusType = $_POST['cusType'];
        $filter = $_POST['filter'];
        $_SESSION['filterName'] = $filter;
        $_SESSION['filter'] = strtoupper($filter);
        $_SESSION['cusType'] = $cusType;
        header("location:../importCustomer.php");
   }
   if(isset($_POST['clear'])) {
      unset($_SESSION['filterName']);
      unset($_SESSION['filter']);
      unset($_SESSION['custID']);
      unset($_SESSION['cusType']);
      header("location:../importCustomer.php");

   }

?>