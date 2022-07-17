<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Per Class Form | Humarey Bachchey</title>

    <link rel="stylesheet" href="style.css?v=<? echo time(); ?>">
    <link rel="shortcut icon" href="favicon.ico">
  </head>
  
    <div class="header">
        <center><table>
          <tr>
            <td>Humarey Bachchey</td>
          </tr>
        </table></center>
    </div>
  
   <div class="main">
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Student Per Class</h1><hr>

	<BODY>

		
	<form action="student-admission.php" method="post">
	<p style="text-align:right;">
	<input type="submit" name="test" value=" + ADD NEW STUDENT" />
	</p>
	</form>


	<center>
	<form action="" method="post">
		<hr>
		
		<p> Enter Student ID: <input type="text" name="Enum" /></p>
		OR
		<p> Enter Student First Name: <input type="text" name="Enum1" /> <br><br> Enter Student Last Name :  <input type="text" name="Enum2" /> </p>
		<input type="submit" name="cal" value="Search the Record" />
		
		<hr>
	</form>
	

<?php  // creating a database connection 

	$Target_ID = " "; 	//STUDENT ID
	$Target_ID1 = " ";	//First Name
	$Target_ID2 = " ";	//Last Name

	require 'dbh.php';

//IF DELETE:
if(isset($_POST["delete"])){

//Delete Student Info:	
	 $Target_ID = $_POST["delete"];

	 $q = " DELETE FROM fee WHERE stu_id = '$Target_ID'";
	 
	 $query_id = oci_parse($con, $q); 		
	 $r = oci_execute($query_id);

	 $q = " DELETE FROM class_history WHERE stu_id = '$Target_ID'";
	 
	 $query_id = oci_parse($con, $q); 		
	 $r = oci_execute($query_id);

	
	 $q = " DELETE FROM student WHERE stu_id = '$Target_ID'";
	 
	 $query_id = oci_parse($con, $q); 		
	 $r = oci_execute($query_id);

	 if($r) {
		echo "Record Deleted<br>";
	 }
	 else {
		 echo "Record not Deleted!<br>";
		 $e = oci_error($query_id);  
		 echo $e['message'];
	 }

}
	
//IF UPDATE:
if(isset($_POST["val"])){
	
		$s_id = $_POST["s_id"];
		$s_fname = $_POST["s_fname"];
		$s_lname = $_POST["s_lname"];
		$s_dob = $_POST["s_dob"];
		$s_gender = $_POST["s_gender"];
		$s_reg = $_POST["s_reg"];
		$s_class = $_POST["s_class"];
			
		require 'dbh.php';

//Updating Student Info:
		$q="update student set fname = '$s_fname', lname = '$s_lname', dob = TO_DATE('$s_dob', 'dd-mon-yy'), reg_date = TO_DATE('$s_reg', 'dd-mon-yy'), gender = '$s_gender', classname = '$s_class' where stu_id = '$s_id'";
		$query_id = oci_parse($con, $q); 		
		$r = oci_execute($query_id); 

//Updating Father Info:	
if(isset($_POST["f_cnic"])){
	
		$f_cnic = $_POST["f_cnic"];
		$f_fname = $_POST["f_fname"];
		$f_lname = $_POST["f_lname"];
		$f_address = $_POST["f_address"];
		$f_gender = $_POST["f_gender"];
		$f_contact = $_POST["f_contact"];
		$f_email = $_POST["f_email"];


	 $q="update parent set fname = '$f_fname', lname = '$f_lname', gender = '$f_gender', contact = '$f_contact', email = '$f_email', address = '$f_address' where cnic = '$f_cnic'";
	 $query_id = oci_parse($con, $q); 		
	$r = oci_execute($query_id); 
}

//Update Mother Info:
if(isset($_POST["m_cnic"])){
	
		$m_cnic = $_POST["m_cnic"];
		$m_fname = $_POST["m_fname"];
		$m_lname = $_POST["m_lname"];
		$m_address = $_POST["m_address"];
		$m_gender = $_POST["m_gender"];
		$m_contact = $_POST["m_contact"];
		$m_email = $_POST["m_email"];
}

//Update Guardian Info:
if(isset($_POST["g_cnic"])){

	 $q="update parent set fname = '$m_fname', lname = '$m_lname', gender = '$m_gender', contact = '$m_contact', email = '$m_email', address = '$m_address' where cnic = '$m_cnic'";
	 $query_id = oci_parse($con, $q); 		
	 $r = oci_execute($query_id); 
	
		$g_cnic = $_POST["g_cnic"];
		$g_name = $_POST["g_name"];
		$g_gender = $_POST["g_gender"];
		$g_contact = $_POST["g_contact"];
		$g_relation = $_POST["g_relation"];


	 $q="update guardian set name = '$g_name', gender = '$g_gender', contact = '$g_contact', relation = '$g_relation' where cnic = '$g_cnic'";
	 $query_id = oci_parse($con, $q); 		
	 $r = oci_execute($query_id); 
	
}	
	 if($r){
			 echo "Record Updated";
	 }
	 else{
		 echo "Record not Updated!<br>";
		 $e = oci_error($query_id);  
		 echo $e['message'];
	 }

}
	
//Search one Specific Record:	
if(isset($_POST["cal"]) && (($_POST["Enum"]) || ($_POST["Enum1"] && $_POST["Enum2"]))){

//With ID:
	if($_POST["Enum"]){
		$Target_ID  = $_POST["Enum"]; 

		$q2 = "select stu_id,classname, fname, lname, LPAD(((reg_date - DOB)/365),3) as CHILD_AGE ,gender from student where stu_id = '".$Target_ID."'";

	}
//With Name:
	elseif($_POST["Enum1"] && $_POST["Enum2"]){
		$Target_ID1  = $_POST["Enum1"]; 
		$Target_ID2  = $_POST["Enum2"]; 

		$q2 = "select stu_id,classname, fname, lname, LPAD(((reg_date - DOB)/365),3) as CHILD_AGE ,gender from student where fname = '".$Target_ID1."' and lname = '".$Target_ID2."'";
				
	}
	else{
			echo "Enter Both First and Last Name or Enter Correct Roll Number<br><br>";
	}

	$query_id2 = oci_parse($con, $q2); 		
	$r2 = oci_execute($query_id2);
	$row1 = oci_fetch_array($query_id2);

	$q1 = "select classname, count(classname) as Total from student group by classname having classname = '".$row1["CLASSNAME"]."'";
	$query_id1 = oci_parse($con, $q1); 		
	$r1 = oci_execute($query_id1);
	$row = oci_fetch_array($query_id1);

//DISPLAY:	
	echo "<table border = 2>";

		echo "<tr>";
		echo "<td width = 800> Class Name: ".$row["CLASSNAME"]." ( Total Students ".$row["TOTAL"]." ): <br><br>";

		echo "<table border = 1>";
	
			echo "<tr>";
			echo "<td width = 250> Roll No: ".$row1["STU_ID"]."&emsp; &emsp; </td>";
			echo "<td width = 300> Name: ".$row1["FNAME"]." ".$row1["LNAME"]." &emsp; &emsp; </td>";
			echo "<td width = 200> Age(years): ".$row1["CHILD_AGE"]."&emsp; &emsp; </td>";
			echo "<td width = 150> Gender: ".$row1["GENDER"]."&emsp; &emsp; </td>";
			
			$temp = $row1["FNAME"]." ".$row1["LNAME"];

			$temp1 = $row1["STU_ID"]; //STUDENT ID
		
//--UPDATE BUTTON	
			echo "<td width = 150>";
			echo "<form action=\"update-stu.php\" method=\"post\">";
            echo '<button name="update" value='.$row1["STU_ID"].' type="submit">UPDATE</button>';
			echo "</form> </td>";
			
//---DELETE BUTTON			
			echo "<td width = 150>";	
			echo "<form action=\"\" method=\"post\">";
	        echo '<button name="delete" value='.$row1["STU_ID"].' type="submit">DELETE</button>';
			echo "</form> </td>";
			
			echo "</tr></td>";
			echo "</table><br><br>";
			echo "</table>";
		
}

//SHOW All Records
else{
	
	$q1 = "select classname, count(classname) as Total from student group by classname order by classname";
	$query_id1 = oci_parse($con, $q1); 		
	$r1 = oci_execute($query_id1);
	
	echo "<table border = 2>";
	$i = 1;

//Display:	
	while($row = oci_fetch_array($query_id1, OCI_BOTH+OCI_RETURN_NULLS)) 
    {	
		echo "<tr>";
		echo "<td width = 800> Class Name: ".$row["CLASSNAME"]." ( Total Students ".$row["TOTAL"]." ): <br><br>";
	
		$q2 = "select stu_id, fname,lname, LPAD(((reg_date - DOB)/365),3) as CHILD_AGE ,gender from student where classname = '".$row["CLASSNAME"]."'";
		$query_id2 = oci_parse($con, $q2); 		
		$r2 = oci_execute($query_id2);
	
		echo "<table border = 1>";
		while($row1 = oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS)) 
		{	
		
			echo "<tr>";
			echo "<td width = 250> Roll No: ".$row1["STU_ID"]."&emsp; &emsp; </td>";
			echo "<td width = 300> Name: ".$row1["FNAME"]." ".$row1["LNAME"]." &emsp; &emsp; </td>";
			echo "<td width = 200> Age(years): ".$row1["CHILD_AGE"]."&emsp; &emsp; </td>";
			echo "<td width = 150> Gender: ".$row1["GENDER"]."&emsp; &emsp; </td>";

//---UPDATE BUTTON			
			echo "<td width = 150>";
			echo "<form action=\"update-stu.php\" method=\"post\">";
            echo '<button name="update" value='.$row1["STU_ID"].' type="submit">UPDATE</button>';
			echo "</form> </td>";
			
//---DELETE BUTTON			
			echo "<td width = 150>";	
			echo "<form action=\"\" method=\"post\">";
	        echo '<button name="delete" value='.$row1["STU_ID"].' type="submit">DELETE</button>';
			echo "</form> </td>";
			
			echo "</tr>";
	
			$i = $i + 1;
		}
		echo "</table><br><br></td>";

	}
	if($i == 1){
			echo "No Record Found.<br>";
	}
	echo "</table>";	
}


?>
</center>
</div>
</body>
</html>
