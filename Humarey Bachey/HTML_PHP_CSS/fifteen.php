<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Parent Info Form | Humarey Bachchey</title>

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
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>Parent Info</h1><hr>
 
	<BODY>

	
	<center>
	
	<form action="" method="post">
		
		<p> Enter Parent CNIC:     <input type="text" name="num" /></p>
		OR
	<p> Enter Parent First Name: <input type="text" name="num1" /> <br><br> Enter Parent Last Name :  <input type="text" name="num2" /> </p>
		<input type="submit" name="cal" value="Search the Record" />
	
		<hr>
	</form>
	
<?php  // creating a database connection 

	$Target_ID = " ";   //Parent ID
	$Target_ID1 = " ";	//Parent Fname
	$Target_ID2 = " ";	//Parent Lname
	
if(isset($_POST["cal"]) && (($_POST["num"]) || ($_POST["num1"] && $_POST["num2"]))){

	require 'dbh.php';

//If CNIC is given:
	if($_POST["num"]){
		$Target_ID  = $_POST["num"]; 

		$q1 = "select gender from parent where cnic = ".$Target_ID;

	}
//If Name is given:	
	elseif($_POST["num1"] && $_POST["num2"]){
		$Target_ID1  = $_POST["num1"]; 
		$Target_ID2  = $_POST["num2"]; 

		$q1 = "select cnic, gender from parent where fname = '".$Target_ID1."' and lname = '".$Target_ID2."'";		
		$Target_ID = $row1["CNIC"];

	}
//If Incorrect:
	else{
			echo "Enter Both First and Last Name or Enter Correct CNIC<br><br>";
	}		

	$query_id1 = oci_parse($con, $q1); 		
	$r1 = oci_execute($query_id1); 
	$row1 = oci_fetch_array($query_id1);

//If Mother Name was Provided(Searches for Father):


	if($row1["GENDER"] == 'F'){
		$q3 = "select mother.fname, father.fname as HusbandName,father.cnic as FCNIC  from parent mother, parent father where (mother.gender='F' AND father.spouse= mother.cnic and mother.cnic = '".$Target_ID."')";
		
		$query_id3 = oci_parse($con, $q3); 		
		$r3 = oci_execute($query_id3);  
		$row3 = oci_fetch_array($query_id3);
		
		$Target_ID = $row3["FCNIC"];

	}
	
	$q2 = "select distinct s.classname, LPAD(((s.reg_date - s.DOB)/365),3) as CHILD_AGE, G.NAME as GNAME, s.fname as SNAME, mother.fname as MANAME, father.fname as FANAME from parent mother, parent father, student s, guardian g where (mother.gender='F' AND father.spouse = mother.cnic AND s.father_cnic = father.cnic and g.cnic = s.guardian_cnic) and father.cnic = '".$Target_ID."'";
	$query_id2 = oci_parse($con, $q2); 		
	$r2 = oci_execute($query_id2); 
	 
	echo "<table border = 2>";
	
//Display Info:
	$i = 1;
	while($row = oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS)) 
    {
	echo "<tr>";
	echo "<td width = 400> Child No: ".$i.":</td><td width = 500 align = left>";
			
	echo "Child Name: ".$row["SNAME"]."<br><br>";
	
	echo "Child Age: ".$row["CHILD_AGE"]."<br><br>";

	echo "Child Class: ".$row["CLASSNAME"]."<br><br>";

	echo "Father Name: ".$row["FANAME"]."<br><br>";

	echo "Mother Name: ".$row["MANAME"]."<br><br>";

	echo "Gaurdian Name: ".$row["GNAME"]."<br><br>";
	
	$i = $i + 1;

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
