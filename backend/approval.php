<?php
 include('../db/db.php');
 session_start();
require 'credencial.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$alphabet = '@#$123456789';
$pass = array(); //remember to declare $pass as an array
$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
for ($i = 0; $i < 3; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
$genPass = 'DMS' . implode($pass); //turn the array into a string

if(isset($_GET['email'])) {
    $email = $_GET['email'];
    $name = $_GET['name'];
    $status = $_GET['status'];

    $str = "select * from user_tbl where emp_email ='$email'";
    $query = sqlsrv_query($con, $str);    
    if($query) {
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
            $stat = $row['status'];
        }
    }

    if($status == 'Approve') {
        if($stat == 'Approve') {
            $_SESSION['status'] = $status;
            $_SESSION['stat'] = "Oops";
            $_SESSION['status_code'] = "info";  
            $_SESSION['name'] = "You already approve this user";
            header("location:../approve.php");
        }
        else {
            $_SESSION['status'] = $status;
            $_SESSION['stat'] = $status;
            $_SESSION['status_code'] = "success";  
            $_SESSION['name'] = $name . ' can now check his/her email for PhilFirst DMS credentials';
            header("location:../approve.php");
    date_default_timezone_set('Asia/Taipei');
    $date = date("m/d/Y");
    $encryptPass = md5($genPass);
    $sql = "update user_tbl set username = '$email', password = '$encryptPass', date_registered = '$date', status = '$status' where emp_email = '$email'";
    $stmt = sqlsrv_query($con, $sql);
    if($stmt) {
        $reset = "<a href='http://192.20.4.92/dms/resetpass.php?username=".$email."'>Click Here To Reset Password</a>";
        // $reset = "<a href='http://localhost/dms/reset/".$email."/".$genPass."'>Click Here To Reset Password</a>";
        require 'mailer_latest/vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->CharSet = "utf-8";                                   //Send using SMTP
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();         
            $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = UNAME;                                  //SMTP username
            $mail->Password   = PW;                                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(UNAME, 'Mailer');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'PhilFirst DMS Credentials: Username and Password';
            $mail->Body   = 'Good Day!<br><br>
                             Below is your DMS credential. Note that username and password are case-sensitive. You may change the assigned password once logged in.<br><br>
                             <style>
                            table, th, td {
                            border:1px solid black;
                            }
                            th, td {
                            padding: 0px 20px;
                            }
                            
                            </style>
                             <table>
                            <tr>
                                <th><center>USERNAME</center></th>
                                <th><center>PASSWORD</center></th>
                            </tr>
                            <tr>
                                <td><center>'.$email.'</center></td>
                                <td><center>'.$genPass.'</center></td>
                            </tr>
                            </table>
                            <br>
                            ' .$reset. '
                            <br><br><br>
                            THIS IS A SYSTEM GENERATED EMAIL. PLEASE DO NOT REPLY TO THIS.
                            ';
                            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    else {
        die( print_r( sqlsrv_errors(), true));
    }

        }
    }

    else {
        if($stat == 'Decline') {
            $_SESSION['stat'] = "Oops";
            $_SESSION['status_code'] = "info";  
            $_SESSION['name'] = "You already decline this user";
            header("location:../approve.php");
        }
        else if($stat == 'Approve') {
            $_SESSION['stat'] = "Error";
            $_SESSION['status_code'] = "info";  
            $_SESSION['name'] = "It seems that you already approve this user";
            header("location:../approve.php");
        }
        else {
            $_SESSION['stat'] = "Decline";
            $_SESSION['status_code'] = "error"; 
            $_SESSION['name'] = ""; 
            header("location:../approve.php");
            date_default_timezone_set('Asia/Taipei');
    $date = date("m/d/Y");
    $sql = "update user_tbl set status = '$status' where emp_email = '$email'";
    $stmt = sqlsrv_query($con, $sql);
    if($stmt) {
        require 'mailer_latest/vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->CharSet = "utf-8";                                 //Send using SMTP
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();         
            $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = UNAME;                                  //SMTP username
            $mail->Password   = PW;                                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(UNAME, 'Mailer');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'PhilFirst DMS Approval: Declined';
            $mail->Body   = 'Good Day!<br><br>
                
                            Your registration in PhilFirst DMS has been declined, kindly ask MIS/IT department for more information.
                            <br>
                            <br>
                            <br>
                            <br>
                            THIS IS A SYSTEM GENERATED EMAIL. PLEASE DO NOT REPLY TO THIS.
                            ';
        
                            $mail->send();
                       
                            
          
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    else {
        die( print_r( sqlsrv_errors(), true));
    }
        }
    
    

}

}
?>