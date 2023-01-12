<?php
include('../db/db.php');
require 'credencial.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'mailer_latest/vendor/autoload.php';
session_start();

$email = $_POST['email'];
$alphabet = '@#$123456789';
$pass = array(); //remember to declare $pass as an array
$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
for ($i = 0; $i < 3; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
$genPass = 'DMS' . implode($pass); //turn the array into a string

if(isset($_POST['submit'])) {
    $str = "select * from user_tbl where emp_email ='$email'";
    $query = sqlsrv_query($con, $str);    
    if($query) {
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
            $fname = $row['emp_fname'];
            $lname = $row['emp_lname'];
            $user = $row['username'];
            $pass = $row['password'];
            $dept_id = $row['dept_id'];
        }
    }
    $sql = "select * from user_tbl where emp_email ='$email'";
    // It is because sqlsrv_query() uses SQLSRV_CURSOR_FORWARD cursor type by default. 
    // However, in order to get a result from sqlsrv_num_rows(), 
    // you should choose one of these cursor types below:
    //     SQLSRV_CURSOR_STATIC
    //     SQLSRV_CURSOR_KEYSET
    //     SQLSRV_CURSOR_CLIENT_BUFFERED

    $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));

    $row_count = sqlsrv_num_rows($result); 
    if($row_count == 0) {
        $_SESSION['status'] = "Invalid Email Address";
        $_SESSION['status_code'] = "error";  
        $_SESSION['status_text'] = "Please enter your company email";
        header("location:../registerForm.php");
    }

    // $sql = "select * from user_tbl where username ='$email'";
    // $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
    // $row_count = sqlsrv_num_rows($result);
    else {

        if($user == '' || $pass == '' || $user == null || $pass == null) {
                date_default_timezone_set('Asia/Taipei');
                $date = date("m/d/Y");
                        $sql1 = "select dept_name from dept_tbl where dept_ID ='$dept_id'";
                        $resultappr = sqlsrv_query($con, $sql1, array(), array( "Scrollable" => 'static' ));
                        $dept_name = sqlsrv_fetch_array($resultappr);
                        $dept = $dept_name['dept_name'];
                $_SESSION['status'] = "Email Confirmed";
                $_SESSION['status_code'] = "success";  
                $_SESSION['status_text'] = "Your registration will be send to ". $dept ." head for approval";
                header("location:../index.php");
                $a = 'Approve';
                $d = 'Decline';
                $name = $fname . ' ' . $lname;
                $approve = "<a href='http://192.20.4.92/dms/backend/approval.php?email=".$email."&status=".$a."&name=".$name."' class='btn btn-primary' style='padding: 10px; background: blue; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;
                line-height: 25px; text-align: center; width: 115px; height: 25px;'>Approve</a>";
                $decline = "<a href='http://192.20.4.92/dms/backend/approval.php?email=".$email."&status=".$d."&name=".$name."' class='btn btn-primary' style='padding: 10px; background: red; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;
                line-height: 25px; text-align: center; width: 115px; height: 25px;'>Decline</a>";
                
                $sql = "select apprv_email from dept_tbl where dept_ID ='$dept_id'";
                $resultappr = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
                $appremail = sqlsrv_fetch_array($resultappr);
                $approver = $appremail['apprv_email'];
                


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
                    $mail->addAddress($approver);     //Add a recipient
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'User Registration';
                    $mail->Body   = 'Good Day!<br><br>
                                    '.$name.' wants to register in PhilFirst DMS<br>
                                    Email: '.$email.'<br><br>
                                    '.$approve.   ' '.$decline.' <br><br><br><br>
                                    THIS IS A SYSTEM GENERATED EMAIL. PLEASE DO NOT REPLY TO THIS.';
                
                                    $mail->send();
                            
                    
                
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
    }

    else {
        $_SESSION['status'] = "Email Already Registered";
        $_SESSION['status_code'] = "info";  
        $_SESSION['status_text'] = "Please ask MIS/IT department for your credentials";
        header("location:../registerForm.php");

}
    }
}

?>