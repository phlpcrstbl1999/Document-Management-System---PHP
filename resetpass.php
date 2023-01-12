<?php
    include('db/db.php');
    session_start();
    if(isset($_GET['username'])) {
        $user= $_GET['username'];
    }
    else {
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
    <title>Reset Password</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


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
    a {
        color: white;
    }
</style>
<body>


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="">
                        <img src="images/logo-1.svg" width="220px" height="220px">
                        <h2 style="color:black;">Document Management System</h2>
                    </a>
                    <br>
                </div>
                <!--  -->
                <div class="login-form">
                    <form action="backend/reset.php" method="POST" class="needs-validation" novalidate>
                        <div class="form-group">    
                        <input type="hidden" name="profile" value="<?php echo $_GET['profile']?>">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user?>" readonly>
                            <div class="invalid-feedback">
                                Please Enter Your Username.
                        </div>
                        </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="New Password" required>
                            <div class="invalid-feedback">
                                Please Enter Your New Password.
                        </div>
                        </div>
                        <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm New Password" required>
                            <div class="invalid-feedback">
                                Please Enter Confirm New Password.
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Reset Password</button>
                            </div>
                            <?php 
                                if(isset($_GET['profile'])) {
                            ?>
                            <div class="col">
                                <a href="customerInformation.php" class="btn btn-danger btn-flat m-b-30 m-t-30" role="button" aria-pressed="true">Back</a>
                            </div>
                            <?php 
                                
                                }
                            ?>
                        </div>      
                    </form>

                                        <script>
                                        (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            var forms = document.getElementsByClassName('needs-validation');
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
