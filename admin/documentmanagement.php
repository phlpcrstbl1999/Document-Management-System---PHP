<?php
    include('db/db.php');
    session_start();
    if(!isset($_SESSION['login'])) {
        header("location:index.php");
    }
    if(isset($_SESSION['custid'])) {
        $id = $_SESSION['custid'];
        $empid = $_SESSION['empid'];
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>File Management- System</title>
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

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">Document Management</a>
                <a class="navbar-brand hidden" href="./">DM</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- <li >
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li> -->
                    <h3 class="menu-title">Modules Management</h3><!-- /.menu-title -->
                    <!-- <li>
                        <a href="filecategory.php"> <i class="menu-icon fa fa-folder"></i>File Category</a>
                    </li> -->
                    <form method="POST" action="backend/unset1.php">
                    <li>
                        <a href="backend/unset1.php" name="unset"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    </form>
                    <li  class="active">
                        <a href="documentmanagement.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    
                    <li >
                        <a href="usermanagement.php"> <i class="menu-icon fa fa-user"></i>User Management </a>
                    </li>
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
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/account.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>
                            <form action="backend/logout.php" method="POST">
                                <a class="nav-link" href="backend/logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Customer Document</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                         <?php 
                                if(isset($_SESSION['enable'])){
                            ?>
                               <button class="btn btn-success btn-round mb-1" data-toggle="modal" data-target="#addfilecategory" style="border-radius: 40%; margin-left: 96%"><i class="fa fa-plus"></i></button>
                              <?php }
                                else {
                                }
                                // unset($_SESSION['enable']);
                             ?>

                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="background-color: #a5a5a5;">
                                            <th>File Name</th>
                                            <th>Type of Document</th>
                                            <th>Customer Name</th>
                                            <th>Date Uploaded</th>
                                            <th>Upload By</th>
                                            <th><center>Edit</center></th>
                                            <th><center>Delete</center></th>
                                            <th><center>View</center></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                             if(isset($_SESSION['custid'])){
                                                $id = $_SESSION['custid'];

                                                $sql = "SELECT docs_tbl.doc_ID, docs_tbl.doc_filename, doc_type.docu_name, customer_tbl.name, user_tbl.emp_name, docs_tbl.date_upload, docs_tbl.date_modified
                                                FROM (((docs_tbl
                                                INNER JOIN doc_type ON docs_tbl.docu_ID = doc_type.docu_ID)
                                                INNER JOIN customer_tbl ON docs_tbl.cust_ID = customer_tbl.cust_ID)
                                                INNER JOIN user_tbl ON docs_tbl.emp_ID = user_tbl.emp_ID)
                                                Where docs_tbl.cust_ID = $id;";
                                             }
                                             else {
                                                $sql = "SELECT docs_tbl.doc_ID, docs_tbl.doc_filename, doc_type.docu_name, customer_tbl.name, user_tbl.emp_name, docs_tbl.date_upload, docs_tbl.date_modified
                                                FROM (((docs_tbl
                                                INNER JOIN doc_type ON docs_tbl.docu_ID = doc_type.docu_ID)
                                                INNER JOIN customer_tbl ON docs_tbl.cust_ID = customer_tbl.cust_ID)
                                                INNER JOIN user_tbl ON docs_tbl.emp_ID = user_tbl.emp_ID);";
                                             }
                                                $query = sqlsrv_query($con, $sql);
                                                if($query) {
                                                    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
                                        ?>
                                        <tr>
                                            <td><?php echo $row['doc_filename'];?></td>
                                            <td><?php echo $row['docu_name'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['date_upload'];?></td>
                                            <td><?php echo $row['emp_name'];?></td>
                                            <td align="center">
                                            <button class="btn btn-info btn-round" data-toggle="modal" data-target="#editfilecategory<?php echo $row['doc_ID'];?>"><i class="fa fa-pencil"></i></button> 

                                                </td>
                                            <td align="center">

                                            <form method="POST" action="backend/deleteFile.php">
                                                <input type="hidden" name="file_name" value="<?php echo $row['doc_filename'];?>">
                                                <input type="hidden" name="file_id" value="<?php echo $row['doc_ID'];?>">
                                                <?php $_SESSION['del'] = 'delete';?>
                                                <button class="btn btn-danger btn-round delete_file"><i class="fa fa-trash"></i></button> 
                                            </form>
                                            </td>
                                            <!-- <td align="center"><a href="dept1/Inventory Control System.pdf" target="_blank">Board of Directors</a></td> -->
                                            <td align="center"><button type="button" class="btn btn-sm"  style="background-color:#b700b1; color: #fff;" data-toggle="modal" data-target="#view<?php echo $row['doc_ID'];?>" ><i class="fa fa-eye"></i> View</button></td>
                                        </tr>
        <!-- ########################################################EDITEDITEDITEDIT############################################################################################# -->
                                                        <div class="modal fade" id="editfilecategory<?php echo $row['doc_ID'];?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="backend/editFile.php" enctype="multipart/form-data">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="smallmodalLabel">Edit File Catergory : </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                        <div class="modal-body">
                                                    <div class="card-header"><strong>Edit File</strong><small> Form</small></div>
                                                        <div class="card-body card-block">

                                                        


                                                        <!-- <div class="form-group">
                                                    <select name="doctype" class="form-control">
                                           
                                </select>
                        </div> -->
                                                        <div class="form-group">
                                                        <input type="hidden" value="<?php echo $row['doc_ID'];?>" name="doc_ID">
                                                            <label for="type" class=" form-control-label">Type of Document : </label>
                                                    <select name="doctype" id="select" class="form-control">
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
                                                        <?php
                                                        }
                                                    }
                                                    ?>

                                                        <?php
                                                        $sql = "select * from doc_type where docu_ID <> $doctype";
                                                        $result = sqlsrv_query($con, $sql);
                                                        if($result){
                                                            while($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                                    ?>
                                                        <option value="<?php echo $row1['docu_ID']; ?>"><?php echo $row1['docu_name']; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    </select>
                                                </div>





                                                    <div class="form-group"><label for="updatefirstname" class=" form-control-label">Name(Lastname,Firstname Middle Name) :</label>
                                                        <input type="text" id="updatefirstname" name="name" placeholder="Enter Firstname" value="<?php echo $row['name'];?>" class="form-control" readonly></div>
                                                        <input type="hidden" name="file_name" value="<?php echo $row['doc_filename'];?>">

                                                        <div class="form-group">
                                                        <label for="country" class=" form-control-label">Upload File : </label>
                                                                <div class="custom-file">
                                                                        <input type="file" name="update_file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                                        <label class="custom-file-label" for="inputGroupFile01"></label>
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
                                                            </div>
                     <!-- ########################################################VIEWVIEWVIEWVIEW############################################################################################# -->
   
                <div class="modal fade modal-fullscreen" id="view<?php echo $row['doc_ID'];?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <form action="backend/uploadFile.php" method="POST" enctype="multipart/form-data">
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
                            <select name="type" id="type" class="form-control" disabled>
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
                                                        <option value="<?php echo $row1['docu_ID']; ?>"><?php echo $row1['docu_name']; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                            </select>
                        </div>

                        <div class="form-group"><label for="updatefirstname" class=" form-control-label">Name(Lastname,Firstname Middle Name) :</label>
                                <input type="text" id="updatefirstname" placeholder="Enter Firstname" value="<?php echo $row['name'];?>" class="form-control" disabled></div>
                 <div class="form-group">
                     <label for="country" class=" form-control-label">Upload File : </label>
                            <div class="custom-file">
                                    <input type="file" name="updatefiles[]" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple disabled>
                                    <label class="custom-file-label" for="inputGroupFile01"><?php echo $row['doc_filename'];?></label>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="dept1/<?php echo $row['doc_filename'];?>" target="_blank" role="button">Open Document</a>

                        <!-- <embed src="dept1/" width="100%" heigth="1000"></embed> -->
                    </div>
                </div>
               
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
                </form>
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
         <!-- ADD MODAL DIV -->
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
                                <select name="doctype" class="form-control">
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
                        <?php
                                    $sql = "select * from customer_tbl where cust_ID = '$id'";
                                    $result = sqlsrv_query($con, $sql);
                                    if($result){
                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                ?>
                                
                <div class="form-group">
                    <label for="name" class="form-control-label">Name(Lastname,Firstname Middle Name) :</label>
                    <input type= "hidden" name="id" value="<?php echo $id?>">
                    <input type= "hidden" name="empid" value="<?php echo $empid?>">
                    <input type="text" id="name" name="name" placeholder="Enter Name" value = "<?php echo $row['name'];?>"class="form-control" readonly>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                <div class="form-group">
                    <label for="country" class=" form-control-label">Upload File : </label>
                            <div class="custom-file">
                                    <input type="file" name="files" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                    <label class="custom-file-label" for="inputGroupFile01"></label>
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
        
                                        ?>
                                    </script>            
      
</body>

</html>
