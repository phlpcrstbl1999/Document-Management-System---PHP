<?php
    include('db/db.php');
    session_start();
    if(!isset($_SESSION['status'])) {
        exit();
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
</style>
<body>
  

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/sweetalert/jquery-3.6.0.min.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
    <script>
        // $('#register').on('click', function() {
            <?php
                if($_SESSION['status'] == 'Approve') {
                    ?>
                swal.fire({
                icon: '<?php echo  $_SESSION['status_code']?>',
                title: '<?php echo $_SESSION['stat']?>',
                text: '<?php echo $_SESSION['name']?>',
                allowOutsideClick: false,
                confirmButtonText: 'OK'
                }).then(function() {
                        window.close();
                    });
                <?php
                } 
                else {
                    ?>
                    swal.fire({
                    icon: '<?php echo $_SESSION['status_code']?>',
                    title: '<?php echo $_SESSION['stat']?>',
                    text: '<?php echo $_SESSION['name']?>',
                    allowOutsideClick: false,
                    confirmButtonText: 'OK'
                    }).then(function() {
                        window.close();
                    });
                    <?php
                }
                ?>

                        

        // })
    </script>
</body>

</html>
