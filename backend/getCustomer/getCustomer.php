<?php
//Assured - Individual Account
function getIndividualdAssured() {
    include('db/oracleDb.php');
    include('db/db.php');
    $emp_id = $_SESSION['id'];
 
                        $output = "";
    
                        $output .="
                                <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
                                <thead>
                                        <tr style='background-color: #a5a5a5;'>
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Birthdate</th>
                                            <th>Address</th>
                                            <th><center>Import</center></th>
    

                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
                                            //Getting 
                                            $sql = "SELECT * FROM giis_assured where ACTIVE_TAG = 'Y' AND CORPORATE_TAG = 'I'";
                                            $stmt = oci_parse($conn, $sql);
                                            oci_execute($stmt);
                                                while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                    $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                    $birthday = $row['BIRTH_MONTH'] . ' ' . $row['BIRTH_DATE'] . ' ' . $row['BIRTH_YEAR'];
                                                    $bdate = date('m/d/Y', strtotime($birthday));
                        $output .= "
                                        <tr>
                                            <td>".$row['ASSD_NAME']."</td>
                                            <td>".$row['ASSD_TIN']."</td>
                                            <td>". $bdate ."</td>
                                            <td>". $address."</td>
                                            <form method='POST' action='backend/importCustomer.php'>
                                                <input type='hidden' name='interno' value=". $row['ASSD_NO'].">
                                                <input type='hidden' name='acc' value='Individual'>
                                                <input type='hidden' name='type' value='Assured'>
                                                <input type='hidden' name='emp_id' value=". $emp_id.">
                                                <input type='hidden' name='birthday' value=". $bdate.">
                                                <input type='hidden' name='tin' value=". $row['ASSD_TIN'].">
                                                <input type='hidden' name='address' value=".$address.">
                                           
                                            <td align='center'><button class='btn btn-info btn-sm' name='submit2'><i class='fa fa-download'></i> Import</button></td>
                                                </tr></form>";          
                                                        }
                        $output .= "
                                    </tbody>
                                </table>
                                ";
                        return $output;
}
//Assured - Corporate Account
function getCorporatedAssured() {
    include('db/oracleDb.php');
    include('db/db.php');
    $emp_id = $_SESSION['id'];
 
                        $output = "";
    
                        $output .="
                                <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
                                <thead>
                                        <tr style='background-color: #a5a5a5;'>
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Date of Incorporation</th>
                                            <th>Address</th>
                                            <th><center>Import</center></th>
    

                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
                                            //Getting 
                                            $sql = "SELECT * FROM giis_assured where ACTIVE_TAG = 'Y' AND CORPORATE_TAG = 'C'";
                                            $stmt = oci_parse($conn, $sql);
                                            oci_execute($stmt);
                                                while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                    $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                    $birthday = $row['BIRTH_MONTH'] . ' ' . $row['BIRTH_DATE'] . ' ' . $row['BIRTH_YEAR'];
                                                    $bdate = date('m/d/Y', strtotime($birthday));
                        $output .= "
                                        <tr>
                                            <td>".$row['ASSD_NAME']."</td>
                                            <td>".$row['ASSD_TIN']."</td>
                                            <td>". $bdate ."</td>
                                            <td>". $address."</td>
                                            <form method='POST' action='backend/importCustomer.php'>
                                                <input type='hidden' name='interno' value=". $row['ASSD_NO'].">
                                                <input type='hidden' name='acc' value='Individual'>
                                                <input type='hidden' name='type' value='Assured'>
                                                <input type='hidden' name='emp_id' value=". $emp_id.">
                                                <input type='hidden' name='birthday' value=". $bdate.">
                                                <input type='hidden' name='tin' value=". $row['ASSD_TIN'].">
                                                <input type='hidden' name='address' value=".$address.">
                                           
                                            <td align='center'><button class='btn btn-info btn-sm' name='submit2'><i class='fa fa-download'></i> Import</button></td>
                                                </tr></form>";          
                                                        }
                        $output .= "
                                    </tbody>
                                </table>
                                ";
                        return $output;
}
//Assured - Corporate Account
function getJointAssured() {
    include('db/oracleDb.php');
    include('db/db.php');
    $emp_id = $_SESSION['id'];
 
                        $output = "";
    
                        $output .="
                                <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
                                <thead>
                                        <tr style='background-color: #a5a5a5;'>
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Date of Incorporation</th>
                                            <th>Address</th>
                                            <th><center>Import</center></th>
    

                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
                                            //Getting 
                                            $sql = "SELECT * FROM giis_assured where ACTIVE_TAG = 'Y' AND CORPORATE_TAG = 'J'";
                                            $stmt = oci_parse($conn, $sql);
                                            oci_execute($stmt);
                                                while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                    $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                    $birthday = $row['BIRTH_MONTH'] . ' ' . $row['BIRTH_DATE'] . ' ' . $row['BIRTH_YEAR'];
                                                    $bdate = date('m/d/Y', strtotime($birthday));
                        $output .= "
                                        <tr>
                                            <td>".$row['ASSD_NAME']."</td>
                                            <td>".$row['ASSD_TIN']."</td>
                                            <td>". $bdate ."</td>
                                            <td>". $address."</td>
                                            <form method='POST' action='backend/importCustomer.php'>
                                                <input type='hidden' name='interno' value=". $row['ASSD_NO'].">
                                                <input type='hidden' name='acc' value='Individual'>
                                                <input type='hidden' name='type' value='Assured'>
                                                <input type='hidden' name='emp_id' value=". $emp_id.">
                                                <input type='hidden' name='birthday' value=". $bdate.">
                                                <input type='hidden' name='tin' value=". $row['ASSD_TIN'].">
                                                <input type='hidden' name='address' value=".$address.">
                                           
                                            <td align='center'><button class='btn btn-info btn-sm' name='submit2'><i class='fa fa-download'></i> Import</button></td>
                                                </tr></form>";          
                                                        }
                        $output .= "
                                    </tbody>
                                </table>
                                ";
                        return $output;
}
//Intermediary - Individual Account
function getIndividualIntermediary() {
    include('db/oracleDb.php');
    include('db/db.php');
    $emp_id = $_SESSION['id'];
 
                        $output = "";
    
                        $output .="
                                <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
                                <thead>
                                        <tr style='background-color: #a5a5a5;'>
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Birthdate</th>
                                            <th>Address</th>
                                            <!--<th>Customer Email</th> -->
                                            <th><center>Import</center></th>
    

                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
                                            //Getting 
                                            $sql = "SELECT * FROM giis_intermediary where ACTIVE_TAG = 'A' AND CORP_TAG = 'N'";
                                            $stmt = oci_parse($conn, $sql);
                                            oci_execute($stmt);
                                                while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                    $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                    $bdate = date('m/d/Y', strtotime($row['BIRTHDATE']));
                                        
                        $output .= "
                                        <tr>
                                            <td>".$row['INTM_NAME']."</td>
                                            <td>".$row['TIN']."</td>
                                            <td>". $bdate."</td>
                                            <td>". $address."</td>
                                            <form method='POST' action='backend/importCustomer.php'>
                                                <input type='hidden' name='interno' value=". $row['INTM_NO'].">
                                                <input type='hidden' name='acc' value='Individual'>
                                                <input type='hidden' name='type' value='Intermediary'>
                                                <input type='hidden' name='emp_id' value=". $emp_id.">
                                                <input type='hidden' name='birthday' value=". $bdate.">
                                                <input type='hidden' name='tin' value=". $row['TIN'].">
                                                <input type='hidden' name='address' value=".$address.">
                                           
                                            <td align='center'><button class='btn btn-info btn-sm' name='submit2'><i class='fa fa-download'></i> Import</button></td>
                                                </tr></form>";          
                                                        }
                        $output .= "
                                    </tbody>
                                </table>
                                ";
                        return $output;
}

//Intermediary - Corporate Account
function getCorporateIntermediary() {
    include('db/oracleDb.php');
    include('db/db.php');
    $emp_id = $_SESSION['id'];
 
                        $output = "";
    
                        $output .="
                                <table id='bootstrap-data-table-export' class='table table-striped table-bordered'>
                                <thead>
                                        <tr style='background-color: #a5a5a5;'>
                                            <th>Name</th>
                                            <th>TIN</th>
                                            <th>Date of Incorporation</th>
                                            <th>Address</th>
                                            <!--<th>Customer Email</th> -->
                                            <th><center>Import</center></th>
    

                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
                                            //Getting 
                                            $sql = "SELECT * FROM giis_intermediary where ACTIVE_TAG = 'A' AND CORP_TAG = 'Y'";
                                            $stmt = oci_parse($conn, $sql);
                                            oci_execute($stmt);
                                                while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)){ 
                                                    $address = $row['MAIL_ADDR1'] . ' ' . $row['MAIL_ADDR2'] . ' ' . $row['MAIL_ADDR3'];
                                                    $bdate = date('m/d/Y', strtotime($row['BIRTHDATE']));
                                        
                        $output .= "
                                        <tr>
                                            <td>".$row['INTM_NAME']."</td>
                                            <td>".$row['TIN']."</td>
                                            <td>". $bdate."</td>
                                            <td>". $address."</td>
                                            <form method='POST' action='backend/importCustomer.php'>
                                                <input type='hidden' name='interno' value=". $row['INTM_NO'].">
                                                <input type='hidden' name='acc' value='Corporate'>
                                                <input type='hidden' name='type' value='Intermediary'>
                                                <input type='hidden' name='emp_id' value=". $emp_id.">
                                                <input type='hidden' name='birthday' value=". $bdate.">
                                                <input type='hidden' name='tin' value=". $row['TIN'].">
                                                <input type='hidden' name='address' value=".$address.">
                                           
                                            <td align='center'><button class='btn btn-info btn-sm' name='submit2'><i class='fa fa-download'></i> Import</button></td>
                                                </tr></form>";          
                                                        }
                        $output .= "
                                    </tbody>
                                </table>
                                ";
                        return $output;
}
?>