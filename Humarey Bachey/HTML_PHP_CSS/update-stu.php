<?php 

	require 'dbh.php';

//If Update Button Pressed:
//Fetching Info to Update:
    if(isset($_POST["update"])){

		$Target_ID = $_POST["update"];
//Student Info:

		$q2 = "Select * from student where stu_id = '".$Target_ID."'";
		$query_id2 = oci_parse($con, $q2); 		
		$r2 = oci_execute($query_id2); 
	 
		$_POST = oci_fetch_array($query_id2) ;
		
		$s_id = $_POST["STU_ID"];
		$s_fname = $_POST["FNAME"];
		$s_lname = $_POST["LNAME"];
		$s_dob = $_POST["DOB"];
		$s_gender = $_POST["GENDER"];
		$s_fcnic = $_POST["FATHER_CNIC"];
		$s_gcnic = $_POST["GUARDIAN_CNIC"];
		$s_reg = $_POST["REG_DATE"];
		$s_class = $_POST["CLASSNAME"];
		$s_img = $_POST["STU_IMAGE"];

//Father Info:
		$q2 = "Select * from parent where cnic = '".$s_fcnic."'";
		$query_id2 = oci_parse($con, $q2); 		
		$r2 = oci_execute($query_id2); 
	 
		$_POST = oci_fetch_array($query_id2) ;

	
		$f_cnic = $_POST["CNIC"];
		$f_fname = $_POST["FNAME"];
		$f_lname = $_POST["LNAME"];
		$f_address = $_POST["ADDRESS"];
		$f_gender = $_POST["GENDER"];
		$f_contact = $_POST["CONTACT"];
		$f_email = $_POST["EMAIL"];
		$f_spouse = $_POST["SPOUSE"];
		$f_staff = $_POST["MEMBER_STAFF"];

//Mother Info:
		$q2 = "Select * from parent where cnic = '".$f_spouse."'";
		$query_id2 = oci_parse($con, $q2); 		
		$r2 = oci_execute($query_id2); 
	 
		$_POST = oci_fetch_array($query_id2) ;

		$m_cnic = $_POST["CNIC"];
		$m_fname = $_POST["FNAME"];
		$m_lname = $_POST["LNAME"];
		$m_address = $_POST["ADDRESS"];
		$m_gender = $_POST["GENDER"];
		$m_contact = $_POST["CONTACT"];
		$m_email = $_POST["EMAIL"];
		$m_staff = $_POST["MEMBER_STAFF"];

//Guardian Info:
		$q2 = "Select * from guardian where cnic = '".$s_gcnic."'";
		$query_id2 = oci_parse($con, $q2); 		
		$r2 = oci_execute($query_id2); 
	 
		$_POST = oci_fetch_array($query_id2) ;

		$g_cnic = $_POST["CNIC"];
		$g_name = $_POST["NAME"];
		$g_gender = $_POST["GENDER"];
		$g_contact = $_POST["CONTACT"];
		$g_relation = $_POST["RELATION"];

	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Info Update Form | Humarey Bachchey</title>

    <link rel="stylesheet" href="style.css?v=<? echo time(); ?>">
    <link rel="shortcut icon" href="favicon.ico">
  </head>
  
   <div class="main">
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Information Update</h1><hr>
 
<BODY>

	<form action="eleven.php" method="post">

		<h1>STUDENT RECORD:</h1>
		<br/>
		
		<center> 
	
		<table border = 2>
		<tr>
		<td width = 400>
		 STUD_ID:   <input type="text" name="s_id" value="<?php echo $s_id ?>" readonly>
		</td>
		<td width = 400>
		GENDER_: 	<input type="text" name="s_gender"  value="<?php echo $s_gender ?>" />  
		</td>
		</tr>

		<tr>
		<td width = 400>
		  First Name:   <input type="text" name="s_fname" value="<?php echo $s_fname ?>"/>
		</td>
		<td width = 400>
		  Last Name: <input type="text" name="s_lname" value="<?php echo $s_lname ?>"/>  
		</td>
		</tr>
		
		<tr>
		<td width = 400>
		DOB____:   <input type="text" name="s_dob" value="<?php echo $s_dob ?>"/>
		</td>
		<td>
				
		Reg Date__: <input type="text" name="s_reg" value="<?php echo $s_reg ?>"/>  
		</td>
		</tr>
		
		
		<tr>
		<td width = 400>
		Class Name:   <input type="text" name="s_class" value="<?php echo $s_class ?>"/>
		</td>
	
		</table>
		</center>
		
<h1>FATHER RECORD:</h1>
<br/>

		<center> 
	
		<table border = 2>
		<tr>
		<td width = 400>
		 CNIC____:   <input type="text" name="f_cnic" value="<?php echo $f_cnic ?>" readonly>
		</td>
		<td width = 400>
		GENDER_: 	<input type="text" name="f_gender"  value="<?php echo $f_gender ?>" />  
		</td>
		</tr>

		<tr>
		<td width = 400>
		  First Name:   <input type="text" name="f_fname" value="<?php echo $f_fname ?>"/>
		</td>
		<td width = 400>
		  Last Name: <input type="text" name="f_lname" value="<?php echo $f_lname ?>"/>  
		</td>
		</tr>
		
		<tr>
		<td width = 400>
		ADDRESS:   <input type="text" name="f_address" value="<?php echo $f_address ?>"/>
		</td>
		<td>
				
		Contact__: <input type="text" name="f_contact" value="<?php echo $f_contact ?>"/>  
		</td>
		</tr>
		
		<tr>
		<td width = 400>
		 EMAIL___:   <input type="text" name="f_email" value="<?php echo $f_email ?>"/>
		</td>
				
		</table>
		</center>
		

<h1>MOTHER RECORD:</h1>
<br/>

		<center> 
	
		<table border = 2>
		<tr>
		<td width = 400>
		 CNIC____:   <input type="text" name="m_cnic" value="<?php echo $m_cnic ?>" readonly>
		</td>
		<td width = 400>
		GENDER_: 	<input type="text" name="m_gender"  value="<?php echo $m_gender ?>" />  
		</td>
		</tr>

		<tr>
		<td width = 400>
		  First Name:   <input type="text" name="m_fname" value="<?php echo $m_fname ?>"/>
		</td>
		<td width = 400>
		  Last Name: <input type="text" name="m_lname" value="<?php echo $m_lname ?>"/>  
		</td>
		</tr>
		
		<tr>
		<td width = 400>
		ADDRESS:   <input type="text" name="m_address" value="<?php echo $m_address ?>"/>
		</td>
		<td>
				
		Contact__: <input type="text" name="m_contact" value="<?php echo $m_contact ?>"/>  
		</td>
		</tr>
		
		<tr>
		<td width = 400>
		 EMAIL__:   <input type="text" name="m_email" value="<?php echo $m_email ?>"/>
		</td>
		</tr>
		
		</table>
		</center>
		
<h1>GUARDIAN RECORD:</h1>
<br/>
	
		<center> 
	
		<table border = 2>
		<tr>
		<td width = 400>
		 CNIC__:   <input type="text" name="g_cnic" value="<?php echo $g_cnic ?>" readonly>
		</td>
		<td width = 400>
		GENDER: 	<input type="text" name="g_gender"  value="<?php echo $g_gender ?>" />  
		</td>
		</tr>

		<tr>
		<td width = 400>
		  Name__:   <input type="text" name="g_name" value="<?php echo $g_name ?>"/>
		</td>
		<td width = 400>
		  Relation_: <input type="text" name="g_relation" value="<?php echo $g_relation ?>"/>  
		</td>
		</tr>
		
		<tr>
		<td width = 400>		
		Contact: <input type="text" name="g_contact" value="<?php echo $g_contact ?>"/>  
		</td>
		<td width = 400>		
		</td>
		</tr>
		</table>
		<br><br>
		<input type="submit" name="val" value="Update the Record" />
		</center>
				
	</form>
</div>
</body>
</html>
