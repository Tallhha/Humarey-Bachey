<?php
		
   $db_sid = 
   "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = 0.0.0.0)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = tola)
    )
  )";
 

   $db_user = "tolha";   // Oracle username e.g "scott"
   $db_pass = "1234";    // Password for user e.g "1234"
   $con = oci_connect($db_user,$db_pass,$db_sid); 
//   if($con) 
//    { echo "Oracle Connection Successful."; } 
//  else 
//      { die('Could not connect to Oracle: '); } 
  

?>
