<?php   
# Connection
$servername = "DESKTOP-D590JCP\SQLEXPRESS"; 
$connectionInfo = array(
    "Database"=>"dms_db", 
    "UID"=>"sa", 
    "PWD"=>"sqlserver2022"
);
$con = sqlsrv_connect($servername, $connectionInfo);
if(!$con) {
    echo "Error (sqlsrv_connect): ".print_r(sqlsrv_errors(), true);
    exit;
}
// else {
//     echo "wews";
// }
?>