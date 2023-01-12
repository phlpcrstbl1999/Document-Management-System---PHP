<?php
try{
$conn = oci_connect('sampleUser', 'samplePass', '(DESCRIPTION = 
    (ADDRESS_LIST = 
        (ADDRESS = (PROTOCOL = TCP)(Host = sampleHost)(Port = 1521)
        )
    )
    (CONNECT_DATA = (SID = sampleSID)
    )
  )');

  
if (!$conn) {
    $e = oci_error();
    die( print_r( sqlsrv_errors(), true));
	}

return $conn;
}
catch(Exception $e){
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	oci_free_statement($conn);
	oci_close($conn);
	}

?>