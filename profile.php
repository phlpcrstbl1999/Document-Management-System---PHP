<?php
    include('db/db.php');
    session_start();
    if(isset($_GET['empid'])){
        $emp = $_GET['empid'];
        
    }
    else {
        echo $_SESSION['empid'];
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
    <title>Document Management- System</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">

    <link rel="apple-touch-icon" href="apple-icon.png">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
  
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>
<style>
    body {
        background-color: #F5F5F5;
    }
</style>
<body>


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <h1  style="color: #2356b5;">Document Management System</h1>
                    </a>
                </div>
                <div class="login-form">
                    <form action="backend/register.php" method="POST" class="needs-validation" novalidate>
                    <div class="form-group">
                            <label>Department</label>
                            <select name="dept" class="form-control">
                           
                            <?php
                                $sql = "select * from dept_tbl";
                                $result = sqlsrv_query($con, $sql);
                                if($result){
                                    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){ 
                                  
                            ?>
                                <option value="<?php echo $row['dept_ID']; ?>"><?php echo $row['dept_name']; ?></option>
                            <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Username" required>
                            <div class="invalid-feedback">
                                Please Enter Your Name.
                        </div>
                            </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                            <div class="invalid-feedback">
                                Please Enter Your Username.
                        </div>
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Please Enter Your Password.
                        </div>
                        </div>

                                <button type="submit" id="register" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Register</button>
                                <div class="social-login-content">
                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>Already have an account?<a href="index.php"> Sign In Here</a></p>
                                </div>
                    </form>

                    <script>
                                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                                        (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                            form.addEventListener('submit', function(event) {
                                                if (form.checkValidity() === false) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                            });
                                        }, false);
                                        })();
                                        </script>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/sweetalert/jquery-3.6.0.min.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
    <script>
        // $('#register').on('click', function() {
        <?php
            if(isset($_SESSION['status']) && $_SESSION['status_code'] != '' ) {
        ?>    
            swal.fire({
                icon: '<?php echo $_SESSION['status_code']; ?>',
                title: '<?php echo $_SESSION['status']; ?>',
                text: '<?php echo $_SESSION['status_text']; ?>'
            })
        // })
        <?php 
            unset($_SESSION['status']);
            unset($_SESSION['status_code']);
            unset($_SESSION['status_text']);
        }
        
        ?>
    </script>
</body>

</html>
