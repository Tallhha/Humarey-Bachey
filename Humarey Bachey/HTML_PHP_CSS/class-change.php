<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Class Change Form | Humarey Bachchey</title>

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

    <div class="main">
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Class Assignment Form</h1><hr>
      <form action="" method="post">
        <h2>Student Information</h2><hr>
        <div class="form-input">
          <table>
            <tr>
              <td><label for="">Student ID: </label></td>
              <td><input type="text" name="stu-id" required></td>
            </tr>
            <tr>
              <td><label for="">Curr Class: </label></td>
              <td><input type="text" name="old" required></td>
            </tr>
            <tr>
              <td><label for="">New Class: </label></td>
              <td><input type="text" name="new" required></td>
            </tr>
			<tr>
              <td><label for="">Reason for Change: </label></td>
              <td><textarea rows="4" cols="50"></textarea></td>
            </tr>
			<tr>
              <td><label for="">Approved By: </label></td>
              <td><input type="text" name="temp"></td>
            </tr>
          </table>
        </div>
		   <center><button type="submit" name="submit">Submit</button></center>
      </form>

<center>
<?php

require 'dbh.php';
if (isset($_POST["submit"])){

    $stu_id = $_POST["stu-id"];
	$old = $_POST["old"];
	$new  = $_POST["new"];
	
	$q = "select * from student where stu_id = '$stu_id'";
	$query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
	$row = oci_fetch_array($query_id);
	
	if($row["STU_ID"]){
		
		$q = "select * from class where class_name = '$new'";
		$query_id = oci_parse($con, $q);
		$r = oci_execute($query_id);
		$row = oci_fetch_array($query_id);
	
		if($row["CLASS_NAME"]){
			
			$q = "update student set classname = '$new' where stu_id = '$stu_id'";
			$query_id = oci_parse($con, $q);
			$r = oci_execute($query_id);
			
			$q = "select serial_no from class_history order by serial_no desc";
			$query_id = oci_parse($con, $q);
			$r = oci_execute($query_id);
			$row = oci_fetch_array($query_id);
			
			$serial = $row["SERIAL_NO"];
			$serial = $serial + 1;
			
			$q = "Insert into CLASS_HISTORY (SERIAL_NO,STU_ID,OLD_CLASS,NEW_CLASS) values ($serial,'$stu_id','$old','$new')";
			$query_id = oci_parse($con, $q);
			$r = oci_execute($query_id);
			if($r){
				echo "<HR>Class Changed<HR>";
			}
			else{
				echo "<HR>Couldn't Change Class<hr>";
			}
		}
		else{
			echo "<hr>Class Doesn't Exist<hr>";
		}
	}	
	else{
		echo "<HR>Invalid Student ID<HR>";
	}
}
  
?>
</center>
</div>
</body>
</html>
