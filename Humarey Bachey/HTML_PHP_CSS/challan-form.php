<?php

  if(isset($_POST["submit"])){

    require 'dbh.php';
    $ch_no = $_POST["ch-no"];
    $q = "SELECT * from FEE where CHALLAN_NO=$ch_no";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);

    $row = oci_fetch_array($query_id, OCI_BOTH);
    $status = $row["REMARKS"];
  }
  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Challan Form</title>
    <link rel="stylesheet" href="style.css?v=<? echo time(); ?>">
    <link rel="shortcut icon" href="favicon.ico">
  </head>
  <body>
    <div class="header">
        <center><table>
          <tr>
            <td>Humarey Bachchey</td>
          </tr>
        </table></center>
    </div>
    <div class="main" style="left: 500px; width: 24%;">
      <form method="post">
        <h2>Fee Information</h2><hr>
        <div>
          <table style="padding: 20px;">
            <tr>
              <td><label for="">Challan #</label></td>
              <td><input type="text" name="ch-no" required></td>
            </tr>
            <input type="hidden" name="stu-id" value="<?echo $_GET["stu-id"];?>">
          </table>
        </div>
        <center><button type="submit" name="submit">Submit</button></center>
      </form>
	<center>
      <?php if(isset($status)){ echo "Fee status: $status.";} 
         else{ echo "No Record Found!";} ?>
	</center> 
    </div>
  </body>
</html>
