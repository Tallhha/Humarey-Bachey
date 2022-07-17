<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Info Form | Humarey Bachchey</title>

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
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Student Info</h1><hr>
 
	<BODY>

	<center>
	
	<form action="" method="post">
		
		<p> Enter Student ID: <input type="text" name="num" /></p>
		OR
		<p> Enter Student First Name: <input type="text" name="num1" /> <br><br> Enter Student Last Name :  <input type="text" name="num2" /> </p>
		<input type="submit" name="cal" value="Search the Record" />
		
		<hr>
	</form>
	
<?php  // creating a database connection 


	$Target_ID = " ";   //Student ID
	$Target_ID1 = " ";	//Student Fname
	$Target_ID2 = " ";	//Student Lname
		
if(isset($_POST["cal"]) && (($_POST["num"]) || ($_POST["num1"] && $_POST["num2"]))){

	require 'dbh.php';

//If Student ID given:

	if($_POST["num"]){
		$Target_ID  = $_POST["num"]; 

		$q2 = "select S.STU_ID, S.FNAME,S.LNAME, S.CLASSNAME, LPAD(((s.reg_date - s.DOB)/365),3) as CHILD_AGE, G.NAME as GNAME, FATHER.FNAME as FANAME, MOTHER.FNAME as MANAME from parent father, parent mother, student s, guardian g where g.cnic = s.guardian_cnic and mother.gender='F' AND father.spouse = mother.cnic AND s.father_cnic = father.cnic AND s.stu_id = '".$Target_ID."'";

	}
//If Student Name Given:
	elseif($_POST["num1"] && $_POST["num2"]){
		$Target_ID1  = $_POST["num1"]; 
		$Target_ID2  = $_POST["num2"]; 

		$q2 = "select S.STU_ID, S.FNAME, S.LNAME, S.CLASSNAME, LPAD(((s.reg_date - s.DOB)/365),3) as CHILD_AGE, G.NAME as GNAME, FATHER.FNAME as FANAME, MOTHER.FNAME as MANAME from parent father, parent mother, student s, guardian g where g.cnic = s.guardian_cnic and mother.gender='F' AND father.spouse = mother.cnic AND s.father_cnic = father.cnic AND s.fname = '".$Target_ID1."' AND s.lname = '".$Target_ID2."'";				
	}
	else{
			echo "Enter Both First and Last Name or Enter Correct Roll Number<br><br>";
	}

	$query_id2 = oci_parse($con, $q2); 		
	$r2 = oci_execute($query_id2); 
	$row = oci_fetch_array($query_id2);

//Search Query:
	if($row["STU_ID"]){

		$q3 = "select distinct s1.fname, s1.lname,s1.classname from student s1, student s2 where s1.lname = s2.lname and s1.fname != s2.fname and s1.lname = '".$row["LNAME"]."' and s1.stu_id != '".$row["STU_ID"]."' order by s1.lname";
	
		$q4 = "select * from class_history where stu_id = '".$row["STU_ID"]."'";

		$query_id3 = oci_parse($con, $q3); 		
		$r3 = oci_execute($query_id3); 

		$query_id4 = oci_parse($con, $q4); 		
		$r4 = oci_execute($query_id4); 
//Display Info:
		echo "<table border = 2>";
		echo "<tr>";

		echo "<td width = 400> Student Name: </td><td width = 500 align = center>".$row["FNAME"]."</td>";
		echo "</tr><tr>";
		echo "<td width = 400> Student Age: </td><td width = 500 align = center>".$row["CHILD_AGE"]."</td>";
		echo "</tr><tr>";

		echo "<td width = 400> Student Class: </td><td width = 500 align = center>".$row["CLASSNAME"]."</td>";
		echo "</tr><tr>";

		echo "<td width = 400> Father Name: </td><td width = 500 align = center>".$row["FANAME"]."</td>";
		echo "</tr><tr>";

		echo "<td width = 400> Mother Name: </td><td width = 500 align = center>".$row["MANAME"]."</td>";
		echo "</tr><tr>";

		echo "<td width = 400> Gaurdian Name: </td><td width = 500 align = center>".$row["GNAME"]."</td>";
		echo "</tr><tr>";
	
		$i = 1;
		echo "<td width = 400> Siblings: </td><td width = 500 align = left>";
		while($row1 = oci_fetch_array($query_id3, OCI_BOTH+OCI_RETURN_NULLS)) {
			
        	echo "Sibling No ".$i.":<br> Name: ".$row1["FNAME"]."   ---  Class: ".$row1["CLASSNAME"]."<br><br>";
			
			$i = $i + 1;
		}
		if($i == 1){
			echo "No Siblings.<br>";
		}
		echo "</tr><tr>";
	
		$j = 1;
		echo "<td width = 400> Class History: </td><td width = 500 align = left>";
		while($row2 = oci_fetch_array($query_id4, OCI_BOTH+OCI_RETURN_NULLS)) {
        	echo "Change No ".$j.":<br>  ".$row2["OLD_CLASS"]."  -->  ".$row2["NEW_CLASS"]."<br><br>";		
			$j = $j +1;
		}
		if($j == 1){
			echo "No Class Change History.<br>";
		}
		echo "</table>";
	
	}
	else{
		echo "No Record with Such Roll Number or Name<br><br>";
	}
}

?>
</center>
</div>
</body>
</html>
