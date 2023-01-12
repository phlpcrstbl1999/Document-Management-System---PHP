<?php
        session_start();
        unset($_SESSION['custid']);
        unset($_SESSION['enable']);
        unset($_SESSION['empid']);
        header("location:../customermanagement.php");
        ?>   