<?php
    ob_start("ob_gzhandler");
    include('db/oracleDb.php');
    include('db/db.php');
    session_start();
    if(!isset($_SESSION['login'])) {
        header("location:index.php");

    }
    else {
       $emp_id = $_SESSION['id'];
       $name =  $_SESSION['name'];
       date_default_timezone_set('Asia/Taipei');
       $date = date("Y-m-d");   
       $sql1 = "select * from user_tbl where emp_id = $emp_id";
       $query1 = sqlsrv_query($con, $sql1);
       if($query1) {
           while($row1 = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC)){     
                  $dept = $row1['dept_id']; 
                  $empEmail = $row1['emp_email'];
           }
       }
    }
    $type = $_GET['Type'];
    $account = $_GET['Account'];
    if($type == 'Assured') {
        if($account == 'Individual') {
            $AI = 'active';
            $title = 'Assured - Individual Account';
            $bday = 'Birthdate';
        } else if($account == 'Corporate') {
            $AC = 'active';
            $title = 'Assured - Corporate Account';
            $bday = 'Date of Incorporation';
        } else {
            $AJ = 'active';
            $title = 'Assured - Joint Account';
            $bday = 'Date of Incorporation';
        }
    } else {
        if($account == 'Individual') {
            $II = 'active';
            $bday = 'Birthdate';
            $title = 'Intermediary - Individual Account';
        } else {
            $IC = 'active';
            $title = 'Intermediary - Corporate Account';
            $bday = 'Date of Incorporation';
        }
    }
 ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Import Customer</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">Document Management</a>
                <a class="navbar-brand hidden" href="">DM</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="customerInformation.php"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    <li>
                        <a href="customerDocument.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    <li>
                    <a href="" data-toggle="dropdown"><i class="menu-icon fa fa-user-plus"></i>Import Customer</a>
                    <div class="dropdown" style="margin-left: 7rem">
                    <div class="dropdown-menu">
                    <h5 class="dropdown-header"><b>Assured</b>Assured</h5>
                    <a class="dropdown-item <?php echo $AI?>" href="importcustomer.php?Type=Assured&Account=Individual">&nbsp&nbsp&nbsp&nbsp&nbspIndividual Account</a>
                    <a class="dropdown-item <?php echo $AC?>" href="importcustomer.php?Type=Assured&Account=Corporate">&nbsp&nbsp&nbsp&nbsp&nbspCorporate Account</a>
                    <a class="dropdown-item <?php echo $AJ?>" href="importcustomer.php?Type=Assured&Account=Joint">&nbsp&nbsp&nbsp&nbsp&nbspJoint Account</a>
                    <h5 class="dropdown-header"><b>Intermediary</b></h5>
                    <a class="dropdown-item <?php echo $II?>" href="importcustomer.php?Type=Intermediary&Account=Individual">&nbsp&nbsp&nbsp&nbsp&nbspIndividual Account</a>
                    <a class="dropdown-item <?php echo $IC?>" href="importcustomer.php?Type=Intermediary&Account=Corporate">&nbsp&nbsp&nbsp&nbsp&nbspCorporate Account</a>
                    </div>
                    </div>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <a class="navbar-brand" href="#">
                <img src="images/logo.jpg" width="250" height="50" alt="">
                    </a>
                </div>
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a class="navbar-brand" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <img class="user-avatar rounded-circle" src="images/account.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href='resetpass.php?username=<?php echo $empEmail?>&profile=true'><i class="fa fa-user"></i> Profile</a>
                            <form action="backend/logout.php" method="POST">
                            <a class="nav-link" href="backend/logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                            <div class="page-header float-left">
                            <div class="page-title">
                                <h1><?php echo $title;?></h1>
                            </div>
                        </div>
                            </div>
                            <?php if($type == 'Assured') {?>
                            <div class="card-body">
                                        <?php
                                            if($account == 'Individual') {
                                                require __DIR__ . '/backend/getCustomer/getCustomer.php';
                                                echo getIndividualdAssured(); //get the result array
                                            } else if($account == 'Corporate') {
                                                require __DIR__ . '/backend/getCustomer/getCustomer.php';
                                                echo getCorporatedAssured(); //get the result array
                                            } else {
                                                require __DIR__ . '/backend/getCustomer/getCustomer.php';
                                                echo getJointAssured(); //get the result array
                                            }
                                        ?>
                                <?php
                            } else {
                                ?>
                                   <div class="card-body">
                                    
                                                
                                        <?php
                                            //Getting 
                                            // if($account == 'Individual') {
                                            //     $sql = "SELECT * FROM giis_intermediary where ACTIVE_TAG = 'A' AND CORP_TAG = 'N'";
                                            //     } else {
                                            //     $sql = "SELECT * FROM giis_intermediary where ACTIVE_TAG = 'A' AND CORP_TAG = 'Y'";
                                            //     }
                                            if($account == 'Individual') {
                                                require __DIR__ . '/backend/getCustomer/getCustomer.php';
                                                echo getIndividualIntermediary(); //get the result array
                                            } else {
                                                require __DIR__ . '/backend/getCustomer/getCustomer.php';
                                                echo getCorporateIntermediary(); //get the result array
                                            }
                                        ?>                                     
                        </div>

                        <?php 
                            }
                    ?>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
    <script src="assets/sweetalert/jquery-3.6.0.min.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
    <script src="backend/mainjs.js"></script>
    <script>
        <?php
            if(isset($_SESSION['status']) && $_SESSION['status_code'] != '' ) {
        ?>    
            swal.fire({
                icon: '<?php echo $_SESSION['status_code']; ?>',
                title: '<?php echo $_SESSION['status']; ?>',
                text: '<?php echo $_SESSION['status_text']; ?>',
            })
        <?php 
            unset($_SESSION['status']);
            unset($_SESSION['status_code']);
            unset($_SESSION['status_text']);
        }
        ?>
    </script>       
    
</body>
</html>
