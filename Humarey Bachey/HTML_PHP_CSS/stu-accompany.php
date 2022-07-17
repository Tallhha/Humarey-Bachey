<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Accompanying Form | Humarey Bachchey</title>

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
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Student Accompanying Form</h1><hr>
      <form action="" method="post">
        <h2>Student Information</h2><hr>
        <div class="form-input">
          <table>
            <tr>
              <td><label for="">Student ID: </label></td>
              <td><input type="text" name="stu-id" required></td>
            </tr>
            <tr>
              <td><label for="">Student Name: </label></td>
              <td><input type="text" name="stu-name" required></td>
            </tr>
            <tr>
              <td><label for="">Student Class: </label></td>
              <td><input type="text" name="stu-dob" required></td>
            </tr>
          </table>
        </div>
        <h2><hr>Guardian Information</h2><hr>
        <div class="form-input-2" style="top: 230px;">
        </div>
        <div class="form-input">
          <table>
            <tr>
              <td><label for="">CNIC: </label></td>
              <td><input type="text" name="g-cnic" required></td>
            </tr>
            <tr>
              <td><label for="">Name: </label></td>
              <td><input type="text" name="g-name" required></td>
            </tr>
			<tr>
              <td><label for="">Pregnant: </label></td>
              <td>
                Yes<input type="radio" name="preg" value="1">
                No<input type="radio" name="preg" value="0">
              </td>
			</tr>
			<tr>
              <td><label for="">Reason for Absence: </label></td>
              <td><textarea rows="4" cols="50"></textarea></td>
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
	$g_cnic = $_POST["g-cnic"];
	$preg  = $_POST["preg"];
	
		
	$q = "select * from student where stu_id = '$stu_id'";
	$query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
	$row = oci_fetch_array($query_id);
	
	if($row["STU_ID"]){

	$q = "update student set guardian_cnic = $g_cnic where stu_id = '$stu_id'";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
	
	$q = "Insert into ACCOMPANIES (STU_ID,GUARDIAN_CNIC,IS_PREGNANT) values ('$stu_id',$g_cnic,$preg)";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
		if($r){
			echo "<HR>SUBMITTED<HR>";
		}
		else{
			echo "<HR>Guardian already accomapnied to given student<hr>";
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
