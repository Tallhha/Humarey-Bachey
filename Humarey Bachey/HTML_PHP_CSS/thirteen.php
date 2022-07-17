<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dormant Info Form | Humarey Bachchey</title>

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
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>List of Dormant Students</h1><hr>
 
	<BODY>	

	<center>
	
	
	<form action="" method="post">
		<p> Enter Number of Months:     <input type="text" name="num" /></p>
			OR
		<p> Enter Number of Years: <input type="text" name="num1" /> <br></p>
		
		<input type="submit" name="cal" value="Search the Record" />
		<hr>
	</form>
	
<?php  // creating a database connection 

	$Target_ID = " "; //Months or Years
	
if(isset($_POST["cal"]) && (($_POST["num"]) || ($_POST["num1"]))){


	require 'dbh.php';

//If Months Given:	
	if($_POST["num"]){
		$Target_ID  = $_POST["num"]; 
	}
//If Years Given:

	else if($_POST["num1"]){
		$Target_ID  = $_POST["num1"]; 
		$Target_ID = $Target_ID * 12;
	}
//Query:	
	$q1 = " select stu_id,fname,classname,reg_date, floor(MONTHS_BETWEEN(sysdate,reg_date)) as DORMANTFOR from student where floor(MONTHS_BETWEEN(sysdate,reg_date)) >= '".$Target_ID."'";
	$query_id1 = oci_parse($con, $q1); 		
	$r1 = oci_execute($query_id1);

//Display:	
	echo "<table border = 2>";
	$i = 1;
	while($row = oci_fetch_array($query_id1, OCI_BOTH+OCI_RETURN_NULLS)) {
		
		echo "<tr>";
		echo "<td width = 400> Student No: ".$i.":</td><td width = 500 align = left>";
		echo "Student ID:  ".$row["STU_ID"]."<br><br>";
		echo "Student Name:  ".$row["FNAME"]."<br><br>";
		echo "Student Class:  ".$row["CLASSNAME"]."<br><br>";
		echo "Registration Date:  ".$row["REG_DATE"]."<br><br>";
		
		if($row["DORMANTFOR"] < 12){
			echo "Dormant for:  ".$row["DORMANTFOR"]." Months.<br><br>";
		}
		else{
			$year = $row["DORMANTFOR"];
			$month = $year - 12;
			$year = $year / 12;
			echo "Dormant for:  ".intval($year)." Years and ".$month." Months <br><br>";		
		}	
		
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
