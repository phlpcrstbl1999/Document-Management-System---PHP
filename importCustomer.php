<?php
    ob_start("ob_gzhandler");
    header('Content-Type: text/html; charset=UTF-8');
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
                  $authorized = $row1['authorized'];
           }
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
    <link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li>
                        <a href="customerInformation.php"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    <li>
                        <a href="customerDocument.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    <li class="active">
                    <a href="importCustomer.php"><i class="menu-icon fa fa-user-plus"></i>Import Customer</a>
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
                            <div class="page-header float-left" style="background-color: transparent;">
                            <div class="page-title">
                            <form action="backend/filter.php" method="post" id="filterForm">
                            <div class="input-group" style="padding-top: 6px;">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <?php
                                if(!isset($_SESSION['cusType'])) {
                                    $checkA = 'checked';
                                    $checkI = '';
                                } else {
                                    if($_SESSION['cusType'] == 'A') {
                                        $checkA = 'checked';
                                        $checkI = '';
                                    } else {
                                        $checkA = '';
                                        $checkI = 'checked';
                                    }
                                }
                                if(!isset($_SESSION['filterName'])) {
                                    $filterName = '';
                                } else {
                                    $filterName = $_SESSION['filterName'];
                                }
                            ?>
                            <input type="radio" id="assured" value="A" name="cusType" aria-label="Radio button for following text input" required <?php echo $checkA;?>>
                            <label class="form-check-label" for="assured">
                            &nbsp&nbsp<b>Assured</b>&nbsp&nbsp&nbsp&nbsp
                            </label>
                            <input type="radio" id="intermediary" value="I" name="cusType" aria-label="Radio button for following text input" required <?php echo $checkI;?>>
                            <label class="form-check-label" for="intermediary">
                            &nbsp&nbsp<b>Intermediary</b>
                            </label>
                            </div>
                        </div>
                     
                        <input type="text" class="form-control" id="filterHolder" name="filter" value="<?php echo $filterName;?>" placeholder='Filter by Name' minlength="2" required>
                        <button type="submit" name="submit" class="btn btn-outline-success"><i class="fa fa-search" aria-hidden="true"></i> <b>Search</b></button>&nbsp
                        </form>

                        <form action="backend/filter.php" method="post">
                        <button type="submit" name="clear" onclick="myFunction()" class="btn btn-outline-success"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Clear</b></button>
                        </form>

                        </div>
                            </div>
                        </div>
                            </div>
                            <div class="card-body">
                            
                                <?php
                                            if(isset($_SESSION['filter'])) {
                                                $filter = $_SESSION['filter'];
                                                $cusType = $_SESSION['cusType'];
                                                if($cusType == 'A') {
                                ?>
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                        <tr style="background-color: #a5a5a5;">
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Birtdate</th>
                                            <th>Address</th>
                                            <th><center>Import</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                                //Getting 

                                                $sql = "SELECT * FROM giis_assured where ACTIVE_TAG = 'Y' AND ASSD_NAME LIKE '%$filter%'";
                                                $stmt = oci_parse($conn, $sql);
                                                oci_execute($stmt);
                                                $i = 0;
                                                    while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                        $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                        $birthday = $row['BIRTH_MONTH'] . ' ' . $row['BIRTH_DATE'] . ' ' . $row['BIRTH_YEAR'];
                                            ?>
                                            <tr>
                                                <td><?php echo $row['ASSD_NAME'];?></td>
                                                <td><?php echo $row['ASSD_TIN'];?></td>
                                                <td><?php echo date('m/d/Y', strtotime($birthday));?></td>
                                                <td><?php echo $address;?></td>
                                                <form method="POST" action="backend/importCustomer.php">
                                                    <input type="hidden" name="assd_no" value="<?php echo $row['ASSD_NO'];?>">
                                                    <input type="hidden" name="emp_id" value="<?php echo $emp_id;?>">
                                                    <input type="hidden" name="birthday" value="<?php echo $birthday;?>">
                                                    <input type="hidden" name="tin" value="<?php echo $row['ASSD_TIN'];?>">
                                                    <input type="hidden" name="address" value="<?php echo $address;?>">
                                                <td align="center"><button class="btn btn-info btn-sm" name="submit"><i class="fa fa-download"></i> Import</button></td>
                                                    </form>
                                            </tr>          
                                                                <?php
                                                                $i++;
                                                            }  
                                                        } else {    
                                        ?>
                                          <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                        <tr style="background-color: #a5a5a5;">
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Birtdate</th>
                                            <th>Address</th>
                                            <th>Lic_Tag</th>
                                            <th><center>Import</center></th>
                                        </tr>
                                            </thead>
                                            <tbody>
                                        
                                         <?php
                                            //Getting 
                                            if($authorized == 'Y') {
                                                $sql = "SELECT * FROM giis_intermediary where ACTIVE_TAG = 'A' AND INTM_NAME LIKE '%$filter%'";
                                            } else {
                                                $sql = "SELECT * FROM giis_intermediary where ACTIVE_TAG = 'A' AND lic_tag = 'Y' AND INTM_NAME LIKE '%$filter%'";
                                            }
                                            $stmt = oci_parse($conn, $sql);
                                            oci_execute($stmt);
                                            $i = 0;
                                                while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                    $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                    $bdate = date('m/d/Y', strtotime($row['BIRTHDATE']));
                                        ?>
                                        <tr>
                                            <td><?php echo $row['INTM_NAME'];?></td>
                                            <td><?php echo $row['TIN'];?></td>
                                            <td><?php echo $bdate;?></td>
                                            <td><?php echo $address;?></td>
                                            <td><?php echo $row['LIC_TAG'];?></td>

                                             <!--<td><php echo $row['EMAIL_ADDRESS'];?></td> -->
                                            <form method="POST" action="backend/importCustomer.php">
                                                <input type="hidden" name="interno" value="<?php echo $row['INTM_NO'];?>">
                                                <input type="hidden" name="emp_id" value="<?php echo $emp_id;?>">
                                                <input type="hidden" name="birthday" value="<?php echo $bdate;?>">
                                                <input type="hidden" name="tin" value="<?php echo $row['TIN'];?>">
                                                <input type="hidden" name="address" value="<?php echo $address;?>">
                                                
                                            <td align="center"><button class="btn btn-info btn-sm" name="submit2"><i class="fa fa-download"></i> Import</button></td>
                                                </tr>
                                                </form>           
                                                            <?php
                                                            $i++;
                                                        }
                                                    }
                                                        ?>     
                                    </tbody>
                                </table>
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
