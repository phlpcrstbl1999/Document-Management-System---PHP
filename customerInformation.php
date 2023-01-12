<?php
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
                  $empName = $row1['emp_fname'] . ' ' . $row1['emp_lname'];
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
    <title>Customer Information</title>
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
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li class="active">
                        <a href="customerInformation.php"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    <li>
                        <a href="customerDocument.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    <li>
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
                                <h1>Customer Information</h1>
                            </div>
                        </div>
                        <div class="page-header float-right" style="padding-right: 2rem; padding-top: 7.5px; background-color: transparent;">
                            <!-- <button type="reset" class="btn btn-success btn-round mb-1" data-toggle="modal" data-target="#addfilecategory" style="border-radius: 40%;"><i class="fa fa-plus"></i></button> -->
                          
                            <?php
                                if(isset($_SESSION['selected'])) {
                                    if($_SESSION['selected'] == 'ALL') {
                                        $selectedA = "selected";
                                        $selectedL = "";
                                        $selectedUL = "";
                                    }else if($_SESSION['selected'] == 'LICENSED') {
                                        $selectedA = "";
                                        $selectedL = "selected";
                                        $selectedUL = "";
                                    }else {
                                        $selectedA = "";
                                        $selectedL = "";
                                        $selectedUL = "selected";
                                    }
                                } else {
                                    $selectedA = "selected";
                                        $selectedL = "";
                                        $selectedUL = "";
                                }
                                if($authorized == 'Y') {

                            ?>
                            <form action="backend/filterLicTag.php" method="POST">
                            <select class="custom-select" id="selectLicTag" name="licTag" onchange="this.form.submit()">
                            <option value="ALL" <?php echo $selectedA?>>ALL</option>
                            <option value="LICENSED" <?php echo $selectedL?>>LICENSED</option>
                            <option value="UNLICENSED" <?php echo $selectedUL?>>UNLICENSED</option>
                            </select>
                            </form>
                            <?php
                                }
                            ?>
                            </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                        <tr style="background-color: #a5a5a5;">
                                            <th></th>
                                            <th>Name</th>
                                            <th>Type of Customer</th>
                                            <th>TIN</th>
                                            <th>Import By</th>
                                            <th>Import Date</th>
                                            <!-- <th><center>Edit</center></th> -->
                                            <th><center>View Docs</center></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Getting
                                            
                                            if($authorized == 'Y') {

                                                if(!isset($_SESSION['licTag'])) {
                                                    $sql = "SELECT customer_tbl.cust_ID, customer_tbl.emp_ID, customer_tbl.date_created, customer_tbl.fullname, customer_tbl.complete_add, customer_tbl.cust_type_id ,customer_tbl.name_corp, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_type.cust_type, customer_tbl.contact_num, customer_tbl.email, customer_tbl.tin, customer_tbl.bdate, customer_tbl.addr_houseno_street, customer_tbl.addr_region_cd, customer_tbl.addr_province_cd, customer_tbl.addr_city_cd, customer_tbl.addr_brgy_cd, customer_tbl.addr_zipcode
                                                    FROM customer_tbl
                                                    INNER JOIN customer_type ON customer_tbl.cust_type_id = customer_type.cust_type_id;
                                                    ";
                                                } else {
                                                    $licTag = $_SESSION['licTag'];
                                                $sql = "SELECT customer_tbl.cust_ID, customer_tbl.emp_ID, customer_tbl.date_created, customer_tbl.fullname, customer_tbl.complete_add, customer_tbl.cust_type_id ,customer_tbl.name_corp, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_type.cust_type, customer_tbl.contact_num, customer_tbl.email, customer_tbl.tin, customer_tbl.bdate, customer_tbl.addr_houseno_street, customer_tbl.addr_region_cd, customer_tbl.addr_province_cd, customer_tbl.addr_city_cd, customer_tbl.addr_brgy_cd, customer_tbl.addr_zipcode
                                                FROM customer_tbl
                                                INNER JOIN customer_type ON customer_tbl.cust_type_id = customer_type.cust_type_id where customer_tbl.lic_tag = '$licTag'";
                                                }
                                           
                                            } else {
                                            $sql = "SELECT customer_tbl.cust_ID, customer_tbl.emp_ID, customer_tbl.date_created, customer_tbl.fullname, customer_tbl.complete_add, customer_tbl.cust_type_id ,customer_tbl.name_corp, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_type.cust_type, customer_tbl.contact_num, customer_tbl.email, customer_tbl.tin, customer_tbl.bdate, customer_tbl.addr_houseno_street, customer_tbl.addr_region_cd, customer_tbl.addr_province_cd, customer_tbl.addr_city_cd, customer_tbl.addr_brgy_cd, customer_tbl.addr_zipcode
                                                    FROM customer_tbl
                                                    INNER JOIN customer_type ON customer_tbl.cust_type_id = customer_type.cust_type_id where customer_tbl.lic_tag is null OR customer_tbl.lic_tag = 'Y';
                                                    ";    
                                            }
                                        
                                            $query = sqlsrv_query($con, $sql);
                                            if($query) {
                                                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
                                                    $corp = $row['name_corp'];
                                                    if($corp == '' || $corp == null) {
                                                        $name = $row['fullname'];
                                                    }
                                                    else {
                                                        $name = $corp;
                                                    }
                                                    $importBy = $row['emp_ID'];
                                                    $sql1 = "select * from user_tbl where emp_id = $importBy";
                                                    $query1 = sqlsrv_query($con, $sql1);
                                                    if($query1) {
                                                        while($row1 = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC)){     
                                                               $empName = $row1['emp_fname'] . ' ' . $row1['emp_lname'];
                                                        }
                                                    }
                                                    $custid = $row['cust_ID'];
                                                    $sql2 = "select count(*) as status from docs_tbl where cust_ID = '$custid'";
                                                    $query2 = sqlsrv_query($con, $sql2);
                                                    if($query2) {
                                                        while($row2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){     
                                                               $status = $row2['status'];
                                                        }
                                                    }
                                        ?>
                                        <tr>
                                            <?php 
                                                if($status == 0) {
                                            ?>
                                            <td align="center" style="color:red;"><b><?php echo $status;?></b></td>
                                            <?php
                                                } else {
                                            ?>
                                            <td align="center" style="color:green"><b><?php echo $status;?></b></td>
                                            <?php
                                                }
                                            ?>
                                            <td><?php echo $name;?></td>
                                            <td><?php echo $row['cust_type'];?></td>
                                            <td><?php echo $row['tin'];?></td>
                                            <td><?php echo $empName;?></td>
                                            <td><?php echo $row['date_created'];?></td>
                                            <!-- <td align="center">
                                            <button class="btn btn-info btn-round btn-sm" data-toggle="modal" data-backdrop="false" data-target="#editfilecategory<php echo $row['cust_ID'];?>"><i class="fa fa-pencil"></i></button> 
                                                </td>    -->
                                            <form method="POST" action="backend/viewFile.php">
                                                <input type="hidden" name="cust_ID" value="<?php echo $row['cust_ID'];?>">
                                                <input type="hidden" name="name" value="<?php echo $name;?>">
                                                <input type="hidden" name="emp_id" value="<?php echo $emp_id;?>">       
                                                <td align="center"><button class="btn btn-sm" name="submit" style="background-color:green; color: #fff;"><i class="fa fa-folder-open"></i> View</button></td>
                                            </form>
                                        </tr>
        <!-- ##################################################EDITEDITEDIT############################################################################################## -->
                                    <div class="modal fade" id="editfilecategory<?php echo $row['cust_ID'];?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <form action="backend/editCustomer.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="smallmodalLabel">Fill in : </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                          </div>
                      <div class="modal-body">
                  <div class="card-header"><strong>Edit Customer</strong><small> Form</small></div>
                     <div class="card-body card-block">
                     
                          <div class="form-group row">
                            <div class="col">
                            <label for="custtype" class="form-control-label">Type of Customer : </label>
                                <select name="custtype" class="form-control" disabled>
                                <?php
                                $sql = "select * from customer_tbl where cust_ID = '$custid'";
                                $result = sqlsrv_query($con, $sql);
                                if($result){
                                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                        $type = $row['cust_type_id'];
                                        $acctype = $row['acctype_id'];
                                        $corp = $row['name_corp'];
                                        $name = $row['fullname'];
                                        $bdate = $row['bdate'];
                                        $contact = $row['contact_num'];
                                        $email = $row['email'];
                                        $address = $row['complete_add'];
                                        $tin = $row['tin'];
                                        ?>
                                <?php
                                $sql = "select * from customer_type where cust_type_id = '$type'";
                                $result = sqlsrv_query($con, $sql);
                                if($result){
                                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                            ?>
                                <option value="<?php echo $row['cust_type_id']; ?>"><?php echo $row['cust_type']; ?></option>
                            <?php
                                    }
                                }
                                ?>
                                </select>
                                </div>
                                <div class="col">
                     <input name="editcust_ID" type="hidden" value="<?php echo $custid?>">
                     <label for="custname" class="form-control-label">Type of Account : </label>
                     <select id="editcustname" name ="custname" class="form-control" disabled>

                                   <option value="<?php echo $acctype; ?>"><?php echo $acctype; ?></option>
                              
                                </select>
                            </div>
                    </div>
                    <?php 
                        if($corp != '' || $corp != null) {
                    ?>
                    <div class="form-group">
                    <label id="editforcorp" for="corp" class="form-control-label">Corporate name :</label>
                    <input type="text" id="editcorp" name="editcorp" placeholder="Enter Corporate Name" value="<?php echo $corp?>" class="form-control">
                    </div>
                    <!--  -->
                    <div class="form-group ">
                    <label for="tin"  class="form-control-label">Tin :</label>
                    <input type="text" id="tin" name="tin" placeholder="000-000-000-000" value="<?php echo $tin;?>" class="form-control">
                    </div>
                    <div class="form-group row">
                    <div class="col">
                    <label for="bdate" id="editforbdateinc" class="form-control-label">Date of Incorporation :</label>
                    <input type="date" id="editbdate" name="editbdate" value="<?php echo $bdate?>" class="form-control">
                    </div>
                    <?php
                        }else{
                    ?>
                    <input name="emp" value = "<?php echo $emp_id; ?>" hidden>
                    <label id="editforfname" for="fname" class="form-control-label">Name : </label>

                     <div class="form-group">
                    <input type="text" id="editfname" name="editfname" placeholder="Enter Name" value="<?php echo $name?>" class="form-control">
                    </div>
                    <div class="form-group ">
                    <label for="tin"  class="form-control-label">Tin :</label>
                    <input type="text" id="tin" name="tin" placeholder="000-000-000-000" value="<?php echo $tin;?>" class="form-control">
                    </div>
                    <div class="form-group row">
                    <div class="col">   
                    <label for="bdate" id="editforbdate" class="form-control-label">Birthdate :</label>
                    <input type="date" id="editbdate" name="editbdate" value="<?php echo $bdate?>" class="form-control">
                    </div>
                    <?php
                        }
                    ?>
                        <div class="col">
                    <label for="contact" class="form-control-label">Contact Number :</label>
                    <input type="text" id="editcontact" name="editcontact" pattern="^(09|\+639)\d{9}$" value="<?php echo $contact?>" placeholder="Enter Contact Number" class="form-control">
                    </div>
                    <div class="col">
                    <label for="email" class="form-control-label">Email :</label>
                    <input type="email" id="editemail" name="editemail" placeholder="Enter Email Address" value="<?php echo $email?>" class="form-control">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="housenum" class="form-control-label">Address:</label>
                    <input type="text" id="edithousenum" name="edithousenum" placeholder="Enter Address" value="<?php echo $address?>" class="form-control">
                    </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="editsubmit" class="btn btn-primary">Confirm</button>
            </div>
                </form>
                 </div>
                    </div>
                        </div>       
                        
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                        ?>                                   
<!-- ##################################################ADDADDADDADD############################################################################################## --> 
    
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal fade" id="addfilecategory" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <form action="backend/addCustomer.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="smallmodalLabel">Fill in : </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                          </div>
                      <div class="modal-body">
                  <div class="card-header"><strong>Add Customer</strong><small> Form</small></div>
                     <div class="card-body card-block">
                     
                          <div class="form-group row">
                            <div class="col">
                            <label for="custtype" class="form-control-label">Type of Customer : </label>
                                <select name="custtype" class="form-control">
                                <?php
                                $sql = "select * from customer_type";
                                $result = sqlsrv_query($con, $sql);
                                if($result){
                                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                            ?>
                                <option value="<?php echo $row['cust_type_id']; ?>"><?php echo $row['cust_type']; ?></option>
                            <?php
                                    }
                                }
                                ?>
                                </select>
                                </div>
                                <div class="col">

                     <label for="custname" class="form-control-label">Type of Account : </label>

                                <select id="custname" name ="custname" class="form-control">
                                    <option value="Individual Account">Individual Account</option>
                                    <option value="Corporate Account">Corporate Account</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                    <label id="forcorp" for="corp" class="form-control-label" style="display:none;">Corporate name :</label>
                    <input type="text" id="corp" name="corp" placeholder="Enter Corporate Name" class="form-control" style="display:none;">
                    </div>
                    <input name="emp" value = "<?php echo $emp_id; ?>" hidden>
                    <label id="forfname" for="fname" class="form-control-label">Name : </label>
                    <label id="formname" for="mname" class="form-control-label" hidden>Middlename :</label>
                    <label id="forlname" for="lname" class="form-control-label" hidden>Lastname :</label>
                     <div class="form-group row">
                    <div class="col">
                    <input type="text" id="fname" name="fname" placeholder="Enter Firstname" class="form-control" required> 
                    </div>
                    <div class="col">
                    <input type="text" id="mname" name="mname" placeholder="Enter Middlename" class="form-control" required>
                    </div>
                    <div class="col">
                    <input type="text" id="lname" name="lname" placeholder="Enter Lastname" class="form-control" required>
                    </div>
                    </div>
                    <div class="form-group ">
                    <label for="tin"  class="form-control-label">Tin :</label>
                    <input type="text" id="tin" name="tin" placeholder="000-000-000-000" class="form-control" required>
                    </div>
                    <div class="form-group row">
                    <div class="col">
                    <label for="bdate" id="forbdateinc" class="form-control-label" style="display:none;">Date of Incorporation :</label>
                    <label for="bdate" id="forbdate" class="form-control-label">Birthdate :</label>
                    <input type="date" id="bdate" name="bdate" max="<?php echo $date?>" class="form-control">
                    </div>
                        <div class="col">
                    <label for="contact" class="form-control-label">Contact Number :</label>
                    <input type="text" id="contact" name="contact" pattern="^(09|\+639)\d{9}$" placeholder="Enter Contact Number" class="form-control">
                    </div>
                    <div class="col">
                    <label for="email" class="form-control-label">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email Address" class="form-control">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="housenum" class="form-control-label">House No./ Bldg Name/ Street:</label>
                    <input type="text" id="housenum" name="housenum" placeholder="Enter House No./ Bldg Name/ Street" class="form-control">
                    </div>
                    <label for="region" class="form-control-label">Address : </label>            
                    <div class="form-group row">
                    <div class="col">

                                <select id="region" name="region" class="form-control">
                                <option value="" READONLY>Region</option>

                                <?php
                                $sql = "select * from GIIS_REGION";
                                $result = sqlsrv_query($con, $sql);
                                if($result){
                                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                            ?>
                                <option value="<?php echo strtoupper($row['REGION_CD']); ?>" data-id="<?php echo strtoupper($row['REGION_DESC']);?>"><?php echo strtoupper($row['REGION_DESC']); ?></option>
                            <?php
                                    }
                                }
                                ?>
                                </select>
                     </div>  
                     <div class="col">
                    <select id="province" name="province" class="form-control">
                        <option>Province</option>
                    </select>
                    </div>    
                    <div class="col">
                    <select id="city" name="city" class="form-control">
                    <option>City</option>
                    </select>
                    </div>       
                            </div>
                    <div class="form-group row">
                    <div class="col">
                                <select id="barangay" name="barangay" class="form-control">
                                <option>Barangay</option>
                                </select>
                     </div>     
                    <div class="col">
                    <input type="text" id="zip" name="zip" pattern="^(0-9)*\d{4}$" placeholder="Enter Zip Code" class="form-control">
                    </div>       
                            </div>
                 <div class="form-group">
                    <label for="completeaddress" class="form-control-label" hidden>Complete Address:</label>
                    <input type="text" id="completeaddress" name="completeaddress" class="form-control" hidden>
                    </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
            </div>
                </form>
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
       
        }
        ?>

    </script>       
                 
</body>
</html>
