<?php
    // Include the Oracle Database and Crystal Reports libraries
    include('db/oracledb.php');
    // require_once "CrystalReports/CrystalReports.php";

    // // Connect to the Oracle Database server
    // $db = new PDO("oci:dbname=myoracle", "username", "password");

    // Retrieve the data from the database
    // $stmt = $db->query("SELECT * FROM mytable");
    // $data = $stmt->fetchAll();

    // Create a new Crystal Reports report
    $report = new CrystalReport("myreport.rpt");

    // Set the database connection and retrieve the data
    $report->setDatabase("oracle", "myoracle", "username", "password");
    $report->setSQL("SELECT * FROM mytable");

    // Generate the report
    $report->generate();

    // Display the report in the web browser
    $viewer = new CrystalReportsViewer("myreport.rpt");
    $viewer->display();
?>