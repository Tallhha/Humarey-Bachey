<?php

    require 'dbh.php';
    $stu_id = $_GET["stu-id"];
    $staff = $_GET["m-staff"];

    $fee = 10000;
    $ch_no = 1000000000;
    $q = "SELECT * FROM ( SELECT * FROM FEE ORDER BY Challan_No DESC) WHERE ROWNUM = 1";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
    if (($row = oci_fetch_array($query_id, OCI_BOTH)) == true){
      $ch_no = $row["CHALLAN_NO"];
      ++$ch_no;
    }
    $discount = 0;

    $father_cnic = $_GET["father-cnic"];

    $q = "SELECT * from Student where Father_Cnic='$father_cnic'";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);

    $num = oci_num_rows ($query_id);
    if ($num>3)
      $discount = 10;

    if ($staff == 1)
    $discount = 100;

    $discount = ($fee/100)*$discount;
    $netamount = $fee - $discount;

    $q = "INSERT INTO Fee (Challan_No, Amount, Discount, Net_Amount,STU_ID) VALUES ($ch_no, $fee, $discount,$netamount, '$stu_id')";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
	
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css">
    <style media="screen">
      table,td{
        padding: 5px;
        margin-left: 100px;
        margin-right: 100px;
      }
    </style>
  </head>
  <body>
    <div class="header">
        <center><table>
          <tr>
            <td>Humarey Bachchey</td>
          </tr>
        </table></center>
    </div>

    <div class="main" style="left: 30%; width: 40%;">
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Student Admission Form</h1><hr>
      <form action="" method="post">
        <h2>Humarey Bachchey<br>Fee Invoice</h2><hr>
        <div>
          <table>
            <tr>
              <td><label for="">Challan #:</label></td>
              <td><?php echo $ch_no; ?></td>
            </tr>
            <tr>
              <td>Father Name:</td>
              <td><?php echo $_GET["father-name"]; ?></td>
            </tr>
            <tr>
              <td>Father CNIC:</td>
              <td><?php echo $_GET["father-cnic"]; ?></td>
            </tr>
            <tr>
              <td>Fee Amount:</td>
              <td><?php  echo $fee; ?></td>
            <tr>
              <td>Discount:</td>
              <td><?php echo $discount; ?></td>
            </tr>
            <tr>
              <td>Net Amount:</td>
              <td><?php echo $netamount; ?></td>
            </tr>
            <tr>
              <td>Date issued:</td>
              <td><?php echo  date("Y/m/d"); ?></td>
            </tr>
          </table>
          <center>Deposit it to nearest Meezan Bank Account.<br>IBAN: 1200189813451671</center>
        </div>
		
  </body>
</html>
