<?php
    include('../db/db.php');
    session_start();
    if(!isset($_SESSION['login'])) {
        header("location:index.php");

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
    <title>Document Management- System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="../vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

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
                    <li class="active">
                        <a href="customermanagement.php"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    <li>
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
                        <h1>Customer Information</h1>
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
                            <button class="btn btn-success btn-round mb-1" data-toggle="modal" data-target="#addfilecategory" style="border-radius: 40%; margin-left: 96%"><i class="fa fa-plus"></i></button>
                            
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                        <tr style="background-color: #a5a5a5;">
                                            <th>Name</th>
                                            <th>Type of Customer</th>
                                            <th>Address</th>
                                            <th>Age</th>
                                            <th><center>Edit</center></th>
                                            <th><center>Delete</center></th>
                                            <th><center>View</center></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Getting 
                                            $sql = "SELECT customer_tbl.cust_ID, customer_tbl.name, customer_type.cust_type, customer_tbl.address, customer_tbl.age
                                                    FROM customer_tbl
                                                    INNER JOIN customer_type ON customer_tbl.cust_type_id = customer_type.cust_type_id;
                                                    ";
                                            $query = sqlsrv_query($con, $sql);
                                            if($query) {
                                                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['cust_type'];?></td>
                                            <td><?php echo $row['address'];?></td>
                                            <td><?php echo $row['age'];?></td>
                                            <td align="center">
                                            <button class="btn btn-info btn-round" data-toggle="modal" data-target="#editfilecategory<?php echo $row['doc_ID'];?>"><i class="fa fa-pencil"></i></button> 

                                                </td>
                                            <td align="center">
                                            <form method="POST" action="backend/deleteCustomer.php">
                                                <input type="hidden" name="custid" value="<?php echo $row['cust_ID'];?>">

                                                <button class="btn btn-danger btn-round delete_file"><i class="fa fa-trash"></i></button> 
                                            </form>
                                            </td>
                                            <form method="POST" action="backend/viewFile.php">
                                                <input type="hidden" name="cust_ID" value="<?php echo $row['cust_ID'];?>">
                                                <input type="hidden" name="name" value="<?php echo $row['name'];?>">
                                                <input type="hidden" name="emp_id" value="<?php echo $emp_id;?>">
                                                <td align="center"><button class="btn btn-sm" name="submit1" style="background-color:#b700b1; color: #fff;"><i class="fa fa-eye"></i> View</button></td>
                                            </form>                                         
                                           

                                            <?php 
                                                }
                                            }    
                                            ?>  
                                            
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
                    <!-- <div class="modal fade" id="changestatus" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="smallmodalLabel">Change Status : </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                          </div>
                      <div class="modal-body">
                     <div class="card-body card-block">
                          <div class="form-group"><label for="company" class=" form-control-label">Status</label>
                             <select name="select" id="select" class="form-control">
                               <option value="0">Unpublished</option>
                                 <option value="1">Published</option>
                            </select></div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 40%">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
                </form>
                 </div>
                    </div>
                        </div> -->
                           <!-- ADD MODAL DIV -->
            <div class="modal fade" id="addfilecategory" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
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
                     
                          <div class="form-group">
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
                     <div class="form-group">
                    <label for="name" class="form-control-label">Name of Customer(Lastname,Firstname Middle Name) :</label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                    </div>
                     <div class="form-group">
                    <label for="address" class="form-control-label">Address :</label>
                    <input type="text" id="address" name="address" placeholder="Enter Address" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="age" class="form-control-label">Age :</label>
                    <input type="number" id="age" name="age" placeholder="Enter Age" class="form-control" required>
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
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/js/init-scripts/data-table/datatables-init.js"></script>
    <script src="../assets/sweetalert/jquery-3.6.0.min.js"></script>
    <script src="../assets/sweetalert/sweetalert2.all.min.js"></script>
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
            if(isset($_SESSION['status']) && $_SESSION['status_code'] != '' ) {
        ?>    
            swal.fire({
                icon: '<?php echo $_SESSION['status_code']; ?>',
                title: '<?php echo $_SESSION['status']; ?>',
                text: '<?php echo $_SESSION['status_text']; ?>',

            })
        // })
        <?php 
            unset($_SESSION['status']);
            unset($_SESSION['status_code']);
        }
        
        ?>
    </script>                            

</body>

</html>
