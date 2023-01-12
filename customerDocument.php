<?php
    include('db/db.php');
    session_start();
    if(!isset($_SESSION['login'])) {
        header("location:index.php");
    }
    if(isset($_SESSION['custid'])) {
        $id = $_SESSION['custid'];
        $empid = $_SESSION['empid'];
        $custname = $_SESSION['name'];
    }
    $emp = $_SESSION['id'];
    $sql1 = "select * from user_tbl where emp_id = $emp";
    $query1 = sqlsrv_query($con, $sql1);
    if($query1) {
        while($row1 = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC)){     
               $dept = $row1['dept_id']; 
               $empEmail = $row1['emp_email'];
               $authorized = $row1['authorized'];

        }
    }
    $sql2 = "select apprv_email from dept_tbl where dept_ID = $dept";
    $query2 = sqlsrv_query($con, $sql2);
    if($query2) {
        while($row2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){     
               $headEmail = $row2['apprv_email']; 
        }
    }

    $sql2 = "select password from user_tbl where username = '$headEmail'";
    $query2 = sqlsrv_query($con, $sql2);
    if($query2) {
        while($row2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){     
                $headPass = $row2['password']; 
        }
    }
        
    ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer Document</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <script src="backend/mainjs.js"></script>

    
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
                    <!-- <li >
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li> -->
                    <!-- <li>
                        <a href="filecategory.php"> <i class="menu-icon fa fa-folder"></i>File Category</a>
                    </li> -->
                    <li>
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li>
                        <a href="backend/unset.php"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    <li  class="active">
                        <a href="customerDocument.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    <li>
                    <a href="importCustomer.php"><i class="menu-icon fa fa-user-plus"></i>Import Customer</a>
                    </li>
                    <!-- <li >
                        <a href="usermanagement.php"> <i class="menu-icon fa fa-user"></i>User Management </a>
                    </li> -->
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

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

        </header><!-- /header -->
        <!-- Header-->

        <!-- <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Customer Document</h1>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                            <div class="page-header float-left" style="background-color: transparent;">
                            <div class="page-title">
                            <?php 
                                if(isset($_SESSION['enable'])){
                            ?>
                                <h1><?php echo $custname ?> - Documents</h1>
                                <?php
                                }else {
                                ?>
                                <h1>Customer Document</h1>
                                <?php
                                }
                                // unset($_SESSION['enable']);
                             ?>
                            </div>
                        </div>
                            <?php 
                                if(isset($_SESSION['enable'])){
                            ?>
                                <div class="page-header float-right" style="background-color: transparent;">
                               <button class="btn btn-success btn-round mb-1" data-toggle="modal" data-target="#addfilecategory" style="border-radius: 40%;" onclick="clearInput()"><i class="fa fa-plus"></i></button>
                                </div>
                              <?php 
                              } else {
                                if(isset($_SESSION['selectedDocu'])) {
                                    if($_SESSION['selectedDocu'] == 'ALL') {
                                        $selectedA = "selected";
                                        $selectedL = "";
                                        $selectedUL = "";
                                    }else if($_SESSION['selectedDocu'] == 'LICENSED') {
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
                            <div class="page-header float-right" style="padding-right: 2rem; padding-top: 7.5px; background-color: transparent;">
                            <form action="backend/filterLicTag.php" method="POST">
                            <select class="custom-select" id="selectLicTag" name="licTagDocu" onchange="this.form.submit()">
                            <option value="ALL" <?php echo $selectedA?>>ALL</option>
                            <option value="LICENSED" <?php echo $selectedL?>>LICENSED</option>
                            <option value="UNLICENSED" <?php echo $selectedUL?>>UNLICENSED</option>
                            </select>
                            </form>
                            </div>

                            <?php
                                }
                            }
                            ?>
        
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="background-color: #a5a5a5;">
                                            <th>File Name</th>
                                            <th>Type of Document</th>
                                            <th>Date Uploaded</th>
                                            <th>Upload By</th>
                                            <th>Date Modified</th>
                                            <th>Modified By</th>
                                            <th><center>Edit</center></th>
                                            <!-- <th><center>Delete</center></th> -->
                                            <th><center>View</center></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                             if(isset($_SESSION['custid'])){
                                                $id = $_SESSION['custid'];
                                             
                                                $sql = "SELECT docs_tbl.doc_ID, docs_tbl.emp_ID, docs_tbl.date_modified, docs_tbl.modified_by, docs_tbl.doc_filename, doc_type.docu_name, customer_tbl.fullname, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_tbl.name_corp, user_tbl.emp_fname, user_tbl.emp_lname, docs_tbl.date_upload, docs_tbl.date_modified
                                                FROM (((docs_tbl
                                                INNER JOIN doc_type ON docs_tbl.docu_ID = doc_type.docu_ID)
                                                INNER JOIN customer_tbl ON docs_tbl.cust_ID = customer_tbl.cust_ID)
                                                INNER JOIN user_tbl ON docs_tbl.emp_ID = user_tbl.emp_ID)
                                                Where docs_tbl.cust_ID = $id";
                                             }
                                             else {
                                                if($authorized == 'Y') {
                                                    if(!isset($_SESSION['licTagDocu'])) {
                                                    $sql = "SELECT docs_tbl.doc_ID, docs_tbl.emp_ID, docs_tbl.date_modified, docs_tbl.modified_by, docs_tbl.doc_filename, doc_type.docu_name, customer_tbl.fullname, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_tbl.name_corp, user_tbl.emp_fname, user_tbl.emp_lname, docs_tbl.date_upload, docs_tbl.date_modified
                                                    FROM (((docs_tbl
                                                    INNER JOIN doc_type ON docs_tbl.docu_ID = doc_type.docu_ID)
                                                    INNER JOIN customer_tbl ON docs_tbl.cust_ID = customer_tbl.cust_ID)
                                                    INNER JOIN user_tbl ON docs_tbl.emp_ID = user_tbl.emp_ID)";
                                                    } else {
                                                        $licTag = $_SESSION['licTagDocu'];
                                                        $sql = "SELECT docs_tbl.doc_ID, docs_tbl.emp_ID, docs_tbl.date_modified, docs_tbl.modified_by, docs_tbl.doc_filename, doc_type.docu_name, customer_tbl.fullname, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_tbl.name_corp, user_tbl.emp_fname, user_tbl.emp_lname, docs_tbl.date_upload, docs_tbl.date_modified
                                                        FROM (((docs_tbl
                                                        INNER JOIN doc_type ON docs_tbl.docu_ID = doc_type.docu_ID)
                                                        INNER JOIN customer_tbl ON docs_tbl.cust_ID = customer_tbl.cust_ID)
                                                        INNER JOIN user_tbl ON docs_tbl.emp_ID = user_tbl.emp_ID) where customer_tbl.lic_tag = '$licTag'";
                                                    }
                                                } else {
                                                    $sql = "SELECT docs_tbl.doc_ID, docs_tbl.emp_ID, docs_tbl.date_modified, docs_tbl.modified_by, docs_tbl.doc_filename, doc_type.docu_name, customer_tbl.fullname, customer_tbl.name_fn, customer_tbl.name_mn, customer_tbl.name_ln, customer_tbl.name_corp, customer_tbl.lic_tag, user_tbl.emp_fname, user_tbl.emp_lname, docs_tbl.date_upload, docs_tbl.date_modified
                                                    FROM (((docs_tbl
                                                    INNER JOIN doc_type ON docs_tbl.docu_ID = doc_type.docu_ID)
                                                    INNER JOIN customer_tbl ON docs_tbl.cust_ID = customer_tbl.cust_ID)
                                                    INNER JOIN user_tbl ON docs_tbl.emp_ID = user_tbl.emp_ID) where customer_tbl.lic_tag is null OR customer_tbl.lic_tag = 'Y'";
                                                }
                                             
                                             }
                                                $query = sqlsrv_query($con, $sql);
                                                if($query) {
                                                    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
                                                        $uploader = $row['emp_fname'] . ' ' . $row['emp_lname'];
                                                        $corp = $row['name_corp'];
                                                        $modifiedID = $row['modified_by'];
                                                        if($corp == '' || $corp == null) {
                                                            $name = $row['fullname'];
                                                        }
                                                        else {
                                                            $name = $corp;
                                                        }
                                                        if($modifiedID != "") {
                                                            $sql1 = "select * from user_tbl where emp_id = '$modifiedID'";
                                                            $result1 = sqlsrv_query($con, $sql1);
                                                            if($result1){
                                                                while($row1= sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)){ 
                                                                    $modified = $row['emp_fname'] . ' ' . $row['emp_lname'];
                                                                }
                                                            }  
                                                        } else {
                                                            $modified = "";
                                                        }
                                                        

                                        ?>
                                        <tr>
                                            <td><?php echo $row['doc_filename'];?></td>
                                            <td><?php echo $row['docu_name'];?></td>
                                            <td><?php echo $row['date_upload'];?></td>
                                            <td><?php echo $uploader;?></td>
                                            <td><?php echo $row['date_modified'];?></td>
                                            <td><?php echo $modified;?></td>
                                            <?php
                                                   date_default_timezone_set('Asia/Taipei');
                                                   $date = date('m/d/Y');
                                                   $dateUploaded = date('m/d/Y', strtotime($row['date_upload']));
                                                   if(strtotime($date) == strtotime($dateUploaded) && $emp == $row['emp_ID']) {
                                            ?>
                                                <td align="center">
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" data-target="#editfilecategory<?php echo $row['doc_ID'];?>"><i class="fa fa-pencil"></i></button> 
                                                    </td>
                                                    <?php 
                                                }else if($emp != $row['emp_ID']) {
                                            ?>
                                              <td align="center">
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" data-target="#editfilecategory<?php echo $row['doc_ID'];?>" disabled><i class="fa fa-lock"></i></button> 
                                                </td>
                                            <?php
                                                } else {
                                            ?>
                                              <td align="center">
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" data-target="#editfilecategory<?php echo $row['doc_ID'];?>"><i class="fa fa-lock"></i></button> 
                                                </td>
                                            <?php
                                                }
                                            ?>
                                                
                                            <!-- <td align="center">

                                            <form method="POST" action="backend/deleteFile.php">
                                                <input type="hidden" name="file_name" value="<php echo $row['doc_filename'];?>">
                                                <input type="hidden" name="file_id" value="<php echo $row['doc_ID'];?>">
                                                <button class="btn btn-danger btn-round delete_file"><i class="fa fa-trash"></i></button> 
                                            </form>
                                            form method post action backend deletefile.php input type hidden name file name value php echo row doc file name 
                                            input type hidden name file id value php echo row doc id
                                            button class btn btn danger btn round delete file i class fa fa trash i button form form method post action backend deletefile php input
                                            type hidden name file id value php echo row doc id button class btn btn f danger btn round delete
                                            form method post action backend deletefile php input type hidden name file name value php echo row doc file name 
                                            button class btn btn danger btn round delete file i class fa fa trash i button form form method post action backend deletefile php input 
                                            button class btn btn danger btn round delete file
                                            </td> -->
                                            <!-- <td align="center"><a href="dept1/Inventory Control System.pdf" target="_blank">Board of Directors</a></td> -->
                                            <td align="center"><button type="button" id="view" class="btn btn-sm"  style="background-color:#b700b1; color: #fff;" data-toggle="modal" data-backdrop="false" data-target="#view<?php echo $row['doc_ID'];?>" ><i class="fa fa-file-text"></i> View</button></td>
                                        </tr>
        <!-- ########################################################EDITEDITEDITEDIT############################################################################################# -->
                                                        <div class="modal fade" id="editfilecategory<?php echo $row['doc_ID'];?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="backend/editFile.php" enctype="multipart/form-data">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="smallmodalLabel">Edit Document : </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                        <div class="modal-body">
                                                        <div class="card-body card-block">
                                                        <div class="form-group">
                                                        <input type="hidden" value="<?php echo $row['doc_ID'];?>" name="doc_ID">
                                                        <input type="hidden" value="<?php echo $emp;?>" name="emp_ID">

                                                            <label for="type" class=" form-control-label">Type of Document : </label>
                                                    <select name="doctype" id="select" class="form-control" disabled>
                                                    <?php
                                                        $doc = $row['doc_ID'];
                                                        $sql = "select * from docs_tbl where doc_ID = '$doc'";
                                                        $result = sqlsrv_query($con, $sql);
                                                        if($result){
                                                            while($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                                                $doctype = $row1['docu_ID'];
                                                    ?>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                                  
                                                    <?php
                                                        $sql = "select * from doc_type where docu_ID = '$doctype'";
                                                        $result = sqlsrv_query($con, $sql);
                                                        if($result){
                                                            while($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                                    ?>
                                                        <option value="<?php echo $row1['docu_ID']; ?>" ><?php echo $row1['docu_name']; ?></option>
                                                        <input type= "hidden" name="doct" value="<?php echo $row1['docu_ID']?>">   
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    </select>
                                                                 
                                                </div>
                                                    <div class="form-group"><label for="updatefirstname" class=" form-control-label">Name(Lastname,Firstname Middle Name) :</label>
                                                        <input type="text" id="updatefirstname" name="name" placeholder="Enter Firstname" value="<?php echo $name;?>" class="form-control" readonly></div>
                                                        <input type="hidden" name="file_name" value="<?php echo $row['doc_filename'];?>">
                                                        <input type= "hidden" name="deptid" value="<?php echo $dept?>">                
                                                        <div class="form-group">
                                                        <label for="country" class=" form-control-label">Upload File : </label>
                                                                <div class="custom-file">
                                                                        <input type="file" name="update_file" class="custom-file-input" id="editFile" aria-describedby="inputGroupFileAddon01">
                                                                        <label class="custom-file-label" for="editFile"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- div class form group label for updatefirstname class form control label name lastname firstname
                                                input type text id updatefirstname name name placeholder enter firstname value php echo name input type hidden 
                                                div class form group label for updatefirstname class form control label name lastname firstname input type text 
                                                id updatefirstname name name placeholder enter firstname value php echo name input type hidden div class form group 
                                                label for updatefirstname class form control label name lastname firstname input type hidden div class form group 
                                                updatefirstname classa form control label name lastname firstname input type hidden div class form group div class form
                                                group label for updatefirstname class form control label name lastname firstname input type text id update firstname name 
                                                name placeholder enter firstname value php echo name input type hidden-->
                                                <div class="modal-footer">
                                                    <?php
                                                   date_default_timezone_set('Asia/Taipei');
                                                   $date = date('m/d/Y');
                                                   $dateUploaded = date('m/d/Y', strtotime($row['date_upload']));
                                                   if(strtotime($date) == strtotime($dateUploaded)) {
                                            ?>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
                                                        <?php
                                                   } else {
                                                   ?>
                                                        <input type="password" placeholder="PASSWORD" required id="password" onkeyup="check()" class="form-control">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="submit" id="btnLock" class="btn btn-primary" disabled="true">Confirm</button>
                                                     <?php
                                                }
                                                ?>
                                                </div>
                                                    </form>
                                                    </div>

                                                    </div>
                                                        </div>
                                                            </div>
                                                          
                     <!-- ########################################################VIEWVIEWVIEWVIEW############################################################################################# -->
                    
                <div class="modal fade modal-fullscreen" id="view<?php echo $row['doc_ID'];?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" id="viewmodal" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="smallmodalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                          </div>
                      <div class="modal-body">
                     <div class="card-body card-block">

                        <div class="form-group">
                            <label for="type" class=" form-control-label">Type of Document : </label>
                            <?php
                                                         $sql2 = "select dept_name from dept_tbl where dept_ID ='$dept'";
                                                         $query2 = sqlsrv_query($con, $sql2);
                                                         if($query2) {
                                                             while($row2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){     
                                                                    $deptname = $row2['dept_name']; 
                                                             }
                                                         }
                                                        $doc = $row['doc_ID'];
                                                        $sql = "select * from docs_tbl where doc_ID = '$doc'";
                                                        $result = sqlsrv_query($con, $sql);
                                                        if($result){
                                                            while($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                                                $doctype = $row1['docu_ID'];
                                                                $docName = $row1['doc_filename'];
                                                    ?>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                <!-- div class modal fade modal fullscreen id view php echo row doc id tabindex role dialog aria labelledby smallmodallabel aria hidden true div class modal 
            dialog modal lg id viewmodal role document div class modal content div class modal header h class modal title id smallmodallabel button type button class close 
            data dismiss modal aria label close span aria hidden true times span button div div class modal body div class card body card block div class form group label for 
            type class form control label type of document label php sql select dept name from dept tbl where dept id dept query sqlsrv query con sql if query while row sqlsrv 
            fetch array query sqlsrv fetch assoc deptname row dept name doc row doc id sql select from docs tbl where doc id doc result sqlsrv query con sql if result sqlsrv 
            query con sql if result while row sqlsrv fetch array result sqlsrv fetch assoc doctype row docu id docname eow docfilename php div class modal fade modal fullscreen id
            view php echo row doc id tabindex role dialog aria labelledby smallmodallabel aria hidden true div class modal dialog modal lg id viewmodal role document div class
            modal lg id viewmodal role document div class modal content div class modal header h class modal title id smallmodallabel button type button class close data dismiss
            modal aria label close span aria hidden true times span button div div class modal body div class card body card block div class form group label for type class form
            control label type of document label php sql select dept name from dept tbl where dept id dept query sqlsrv query con sql if query while row sqlsrv fetch array query
            sqlsrv fetch assoc deptname row dept name doc row doc id sql select from docs tbl where doc id doc result sqlsrv query con sql if result sqlsrv query con sql if result
            while row sqlsrv fetch array result sqlsrv fetch assoc doctype row docu id docname row docfilename php div class modal fade modal fullscreen id modal lg id viewmodal role
            document div class modal content div class modal header h class modal title id smallmodallabel button type button class close data dismiss.-->
                            <select name="type" id="type" class="form-control" disabled>                                      
                                                    <?php
                                                        $sql = "select * from doc_type where docu_ID = '$doctype'";
                                                        $result = sqlsrv_query($con, $sql);
                                                        if($result){
                                                            while($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                                    ?>
                                                        <option value="<?php echo $row1['docu_ID']; ?>"><?php echo $row1['docu_name']; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    $folderName = str_replace(str_split('\\/'), '-', $name);
                                                    if(strlen($folderName) > 150) {
                                                      $folderName = substr($folderName,0,150);   
                                                    }  
                                                    $newFolderName = rtrim($folderName, ".");

                                                    ?>
                            </select>
                        </div>

                        <div class="form-group"><label for="updatefirstname" class=" form-control-label">Name(Lastname,Firstname Middle Name) :</label>
                                <input type="text" id="updatefirstname" value="<?php echo $name;?>" class="form-control" disabled></div>
                 <div class="form-group">
                     <label for="country" class=" form-control-label">Upload File : </label>
                            <div class="custom-file">
                                    <input type="file" name="updatefiles[]" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple disabled>
                                    <label class="custom-file-label" for="inputGroupFile01"><?php echo $docName;?></label>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="documents/<?php echo $newFolderName;?>/<?php echo $docName;?>" target="_blank" role="button">Open Document</a>
                                                    <br><br>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="viewing" class="embed-responsive-item" src="documents/<?php echo $newFolderName;?>/<?php echo $docName;?>" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
               
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
                 </div>
                    </div>
                        </div> 
                                        <?php 
                                                }
                                            }    
                                            ?>                                       
                                     </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
         <!--######################################################################### ADD MODAL DIV ###############################################################################-->
            <div class="modal fade" id="addfilecategory" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                        <form action="backend/uploadFile.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="smallmodalLabel">Fill in : </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                          </div>
                      <div class="modal-body">
                  <div class="card-header"><strong>Upload File</strong><small> Form</small></div>
                     <div class="card-body card-block">
                          <div class="form-group">
                            <label for="doctype" class="form-control-label">Type of Document : </label>
                                <select id="doctype" name="doctype" class="form-control">
                                <?php
                                    $sql = "select * from doc_type";
                                    $result = sqlsrv_query($con, $sql);
                                    if($result){
                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                ?>
                                    <option value="<?php echo $row['docu_ID']; ?>"><?php echo $row['docu_name']; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                                </select>
                        </div>
                        <div class="form-group">
                        <label id="forothers" for="others" class="form-control-label" style="display:none;">Others :</label>
                        <input type="text" id="others" name="others" class="form-control" style="display:none;">
                        </div>
                        <?php
                                    $sql = "select * from customer_tbl where cust_ID = '$id'";
                                    $result = sqlsrv_query($con, $sql);
                                    if($result){
                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                ?>
                                
                <div class="form-group">
                    <label for="name" class="form-control-label">Name :</label>
                    <input type= "hidden" name="id" value="<?php echo $id?>">
                    <input type= "hidden" name="empid" value="<?php echo $empid?>">
                    <input type= "hidden" name="deptid" value="<?php echo $dept?>"> 
                    <input type="text" id="name" name="name" placeholder="Enter Name" value = "<?php echo $custname;?>"class="form-control" readonly>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                <div class="form-group">
                    <label for="country" class=" form-control-label">Upload File : </label>
                            <div class="custom-file">
                                    <input type="file" name="files" class="custom-file-input" id="addFile" aria-describedby="inputGroupFileAddon01" required>
                                    <label class="custom-file-label" for="addFile"></label>
                            </div>
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
    <!-- Right Panel -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

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
                                                    $('.delete_file').on('click', function(e) {
                                                        e.preventDefault();
                                                        var form = event.target.form;                                                        
                                                        swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'Record will be deleted?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                         if (result.isConfirmed) {
                                                            form.submit();
                                                        }

                                                        })
                                                    })
                                                    <?php
                                                        if(isset($_SESSION['delete']) != '' ) {
                                                    ?>    
                                                        swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: '<?php echo $_SESSION['delete']; ?>'
                                                        })
                                                
                                                    <?php 
                                                        unset($_SESSION['delete']);
                                                       
                                                    }
                                                    
                                                    ?>
                                               
                </script>
                                      <script>
                                        // $('#register').on('click', function() {
                                        <?php
                                            if(isset($_SESSION['edit_status']) && $_SESSION['edit_code'] != '' ) {
                                                
                                        ?>    
                                            swal.fire({
                                                icon: '<?php echo $_SESSION['edit_code']; ?>',
                                                title: '<?php echo $_SESSION['edit_status']; ?>',
                                                text: '<?php echo $_SESSION['edit_codetext']; ?>',
                                            })
                                        // })
                                        <?php 
                                            unset($_SESSION['edit_status']);
                                            unset($_SESSION['edit_code']);
                                            unset($_SESSION['edit_codetext']);
                                        }
                                        ?>
                                    </script>      

                                     <script>
                                        // $('#register').on('click', function() {
                                        <?php
                                            if(isset($_SESSION['add_status']) && $_SESSION['add_code'] != '' ) {
                                        ?>    
                                            swal.fire({
                                                icon: '<?php echo $_SESSION['add_code']; ?>',
                                                title: '<?php echo $_SESSION['add_status']; ?>',
                                                text: '<?php echo $_SESSION['add_codetext']; ?>',

                                            })
                                        // })
                                        <?php 
                                            unset($_SESSION['add_status']);
                                            unset($_SESSION['add_code']);
                                            unset($_SESSION['add_codetext']);
                                        }
                                        $_SESSION['empid'] = $empid;
                                        ?>
                                    </script>           
                                    <script>
                                           $("#doctype").change(function (event) {
                                            event.preventDefault();
                                            var fothers = document.getElementById("forothers"); 
                                            var others = document.getElementById("others"); 
                                            var e = document.getElementById("doctype");
                                            var text = e.options[e.selectedIndex].value;
                                            if(text == "2004") {
                                                fothers.style.display = "block";
                                                others.style.display = "block";
                                            }
                                            else {
                                                fothers.style.display = "none";
                                                others.style.display = "none";
                                            }

                                        });
                                    </script>                               
                                    <script>
                                      $(document).ready(function(){
                                        $('#addFile').on('change',function(){
                                            //get the file name
                                            var fileName = $(this).val();
                                            //replace the "Choose a file" label
                                            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                                            $(this).next('.custom-file-label').html(cleanFileName);
                                        })
                                        })
                                    </script>
                                    <script>
                                      $(document).ready(function(){
                                        $('#editFile').on('change',function(){
                                            //get the file name
                                            var fileName = $(this).val();
                                            //replace the "Choose a file" label
                                            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                                            $(this).next('.custom-file-label').html(cleanFileName);
                                        })
                                        })
                                    </script>
                                      <script type="text/javascript">
                                        var MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

                                                                var pass1 = "<?php echo $headPass?>";
                                                                function check(){
                                                                var pass2 = document.getElementById("password").value;
                                                                    if (pass1 == MD5(pass2)) {
                                                                            document.getElementById("btnLock").disabled = false;
                                                                            
                                                                } 
                                                                }
                                                            </script>
      
</body> 

</html>
