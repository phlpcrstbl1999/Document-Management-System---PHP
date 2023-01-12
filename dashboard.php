<!doctype html>
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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
                    <li class="active">
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li>
                        <a href="customerInformation.php"> <i class="menu-icon fa fa-list"></i>Customer Information </a>
                    </li>
                    <li>
                        <a href="customerDocument.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    <li>
                    <a href="importCustomer.php"><i class="menu-icon fa fa-user-plus"></i>Import Customer</a>
                    </li>
                    <!-- <li>
                        <a href="customerDocument.php"> <i class="menu-icon fa fa-file"></i>Customer Document</a>
                    </li>
                    <li>
                    <a href="importCustomer.php"><i class="menu-icon fa fa-user-plus"></i>Import Customer</a>
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
                    <div class="user-area dropdown float-right" style="padding-top: 7px">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/setting.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="index.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header -->



        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    Welcome to Document Management System.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>


            <div class="col-sm-12 col-lg-4">
                <div class="card text-black" style="background-color: #0077b6">
                    <div class="card-body pb-0">
                    <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h3 class="mb-0">
                        <?php
                                $sql = "SELECT COUNT(*) as totalCustomer FROM customer_tbl";
                                $query = sqlsrv_query($con, $sql);
                                $row = sqlsrv_fetch_array($query);
                                $totalCustomer = $row['totalCustomer'];
                            ?>
                            <span class="count"><i class="fa fa-file"></i><?php echo $totalCustomer?></span>
                        </h3>
                        <p class="text-dark"><b>Total customer</b></p>
                        <div class="chart-wrapper px-0" style="height:110px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->
            
            <div class="col-sm-6 col-lg-4">
                <div class="card text-black" style="background-color: #00b4d8">
                    <div class="card-body pb-0">
                        <h3 class="mb-0">
                        <?php
                                $sql = "SELECT COUNT(*) as totalDocument FROM docs_tbl";
                                $query = sqlsrv_query($con, $sql);
                                $row = sqlsrv_fetch_array($query);
                                $totalDocument = $row['totalDocument'];
                            ?>
                            <span class="count"><i class="fa fa-users"></i><?php echo $totalDocument?></span>
                        </h3>
                        <p class="text-dark"><b>Total documents</b></p>
                    </div>
                    <div class="chart-wrapper px-0" style="height:110px;" height="70">
                        <canvas id="widgetChart33"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <!-- <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                        <php
                                $sql = "SELECT COUNT(*) as totalCustomer FROM customer_tbl";
                                $query = sqlsrv_query($con, $sql);
                                $row = sqlsrv_fetch_array($query);
                                $totalCustomer = $row['totalCustomer'];
                            ?>
                            <span class="count"><i class="fa fa-file"></i><php echo $totalCustomer?></span>
                        </h4>
                        <p class="text-light"><b>Total customer per account type</b></p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div> -->
            <!--/.col-->


            <div class="col-sm-6 col-lg-4">
                <div class="card text-black" style="background-color: #90e0ef">
                    <div class="card-body pb-0">
                        <h3 class="mb-0">
                        <?php
                                $sql = "SELECT COUNT(*) as totalUser FROM user_tbl where status = 'Approve'";
                                $query = sqlsrv_query($con, $sql);
                                $row = sqlsrv_fetch_array($query);
                                $totalUser = $row['totalUser'];
                            ?>
                            <span class="count"><i class="fa fa-users"></i><?php echo $totalUser?></span>
                        </h3>
                        <p class="text-dark"><b>Total users</b></p>

                    </div>

                    <div class="chart-wrapper px-0" style="height:110px;" height="70">
                        <canvas id="widgetChart44"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->
              
        </div> <!-- .content -->
        <div class="col-sm-6" style="padding-top: 2rem">
        <div class="card" style="padding: 1.5rem">
        <!-- <div class="card-title"><b>YEAR 2022</b></div> -->
        <canvas id="myChart"></canvas>
        </div>
        </div>
        <div class="col-sm-6" style="padding-top: 2rem">
        <div class="card" style="padding: 1.5rem">
        <!-- <div class="card-title"><b>YEAR 2022</b></div> -->
        <canvas id="myChart2"></canvas>
        </div>
        </div>
     
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</script>
<?php     
$sql = "SELECT distinct(customer_type.cust_type) as custType, COUNT(customer_type.cust_type_id) as custCount from customer_tbl inner join customer_type on customer_tbl.cust_type_id = customer_type.cust_type_id group by customer_type.cust_type";
// $sql = "SELECT distinct(MONTH(date_upload)) AS month, COUNT(doc_ID) as doc_count from docs_tbl group by MONTH(date_upload)";
$query = sqlsrv_query($con, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    // $dateObj   = DateTime::createFromFormat('!m', $row['month']);
    // $monthName = $dateObj->format('F'); // March
    $custType[] = $row['custType'];
    $custCount[] = $row['custCount'];
}
// $monthNum  = 11;
// $dateObj   = DateTime::createFromFormat('!m', $monthNum);
// $monthName = $dateObj->format('F'); // March
// echo $monthName;
?>
    <script type="text/javascript">
        function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($custType)?>,
        datasets: [{
            label: 'Customer Type',
            backgroundColor: getRandomColor(),
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($custCount)?>
           
        }]
    },

    // Configuration options go here
    options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
});

    </script>

<?php     

$sql = "SELECT distinct(doc_type.docu_name) AS docName, COUNT(doc_type.docu_ID) as doctype_count from docs_tbl INNER JOIN doc_type on docs_tbl.docu_ID = doc_type.docu_ID group by doc_type.docu_name";
$query = sqlsrv_query($con, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $docNamee[] = $row['docName'];
    $doctype_countt[] = $row['doctype_count'];
}
// $monthNum  = 11;
// $dateObj   = DateTime::createFromFormat('!m', $monthNum);
// $monthName = $dateObj->format('F'); // March
// echo $monthName;
?>
    <script type="text/javascript">
        function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
var ctx = document.getElementById('myChart2').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($docNamee)?>,
        datasets: [{
            label: 'Document Type',
            backgroundColor: getRandomColor(),
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($doctype_countt)?>
           
        }]
    },

    // Configuration options go here
    options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
});

    </script>








<?php     

$sql = "SELECT distinct(MONTH(date_created)) AS month1, COUNT(cust_ID) as cust_count from customer_tbl group by MONTH(date_created)";
$query = sqlsrv_query($con, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $dateObj   = DateTime::createFromFormat('!m', $row['month1']);
    $monthName = $dateObj->format('F'); // March
    $month[] = $monthName;
    $cust_count[] = $row['cust_count'];
}
// $monthNum  = 11;
// $dateObj   = DateTime::createFromFormat('!m', $monthNum);
// $monthName = $dateObj->format('F'); // March
// echo $monthName;


?>
    <script>
            //WidgetChart 1
    var ctx = document.getElementById( "widgetChart1" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($month)?>,
            type: 'line',
            datasets: [ {
                data: <?php echo json_encode($cust_count)?>,
                label: 'Imported Customer',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    tension: 0.00001,
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );
        </script>
        
<?php     
$sql = "SELECT distinct(acctype_id) AS acctype, COUNT(cust_ID) as cust_count from customer_tbl group by acctype_id";
$query = sqlsrv_query($con, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $acctype[] = $row['acctype'];
    $cust_countTYPE[] = $row['cust_count'];
}
// $monthNum  = 11;
// $dateObj   = DateTime::createFromFormat('!m', $monthNum);
// $monthName = $dateObj->format('F'); // March
// echo $monthName;
?>
    
    <script>
           //WidgetChart 2
    var ctx = document.getElementById( "widgetChart2" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($acctype)?>,
            type: 'line',
            datasets: [ {
                data: <?php echo json_encode($cust_countTYPE)?>,
                label: 'Total',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    tension: 0.00001,
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );
    </script>
    <?php     

$sql = "SELECT distinct(MONTH(date_upload)) AS month2, COUNT(docu_ID) as docu_count from docs_tbl group by MONTH(date_upload)";
$query = sqlsrv_query($con, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $dateObj   = DateTime::createFromFormat('!m', $row['month2']);
    $monthName = $dateObj->format('F'); // March
    $month2[] = $monthName;
    $docu_count[] = $row['docu_count'];
}
// $monthNum  = 11;
// echo $monthName;
?>
    <script>
         //WidgetChart 3
    var ctx = document.getElementById( "widgetChart33" );
    ctx.height = 70;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($month2)?>,
            type: 'line',
            datasets: [ {
                data: <?php echo json_encode($docu_count)?>,
                label: 'Uploaded Documents',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: true,
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    borderWidth: 2
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );
    </script>
     <?php     

$sql = "SELECT distinct(MONTH(date_registered)) AS registered, COUNT(emp_id) as emp_id from user_tbl where status = 'Approve' group by date_registered";
$query = sqlsrv_query($con, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $dateObj1   = DateTime::createFromFormat('!m', $row['registered']);
    $monthName1 = $dateObj1->format('F'); // March
    $date_registered[] = $monthName1;
    $emp_id1[] = $row['emp_id'];
}
// $monthNum  = 11;
// $dateObj   = DateTime::createFromFormat('!m', $monthNum);
// $monthName = $dateObj->format('F'); // March
// echo $monthName;
?>
    <script>
            //WidgetChart 4
    var ctx = document.getElementById( "widgetChart44" );
    ctx.height = 70;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($date_registered)?>,
            type: 'line',
            datasets: [ {
                data: <?php echo json_encode($emp_id1)?>,
                label: 'Total',
                fillColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: true,
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    borderWidth: 2
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );
    </script>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widg.js"></script>

</body>

</html>
