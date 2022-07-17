<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Classes Info Form | Humarey Bachchey</title>

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
      <h1>Humarey Bachchey<img src="favicon.ico" style="transform: translate(10px,12px);"><br>List of Classes</h1><hr>
 
	<BODY>

<center>	
	<form action="" method="post">

		<p> Enter Class Name:     <input type="text" name="num" /></p>
		<input type="submit" name="cal" value="Search the Record" />
		<hr>
	</form>	

<?php  // creating a database connection 

	$Target_ID = " "; //ClassName
	require 'dbh.php';
	
if(isset($_POST["cal"]) && ($_POST["num"])){


	if($_POST["num"]){
		$Target_ID  = $_POST["num"]; 

//Query:	
	$q1 = "select classname, count(case when gender='M' then 1 end) as Male, count(case when gender='F' then 1 end) as Female, count(classname) as Total from student group by classname having classname = '".$Target_ID."'";
	$query_id1 = oci_parse($con, $q1); 		
	$r1 = oci_execute($query_id1);

//Display:	
	echo "<table border = 2>";
	$i = 1;
	while($row = oci_fetch_array($query_id1, OCI_BOTH+OCI_RETURN_NULLS)) 
    {	
		echo "<tr>";
		echo "<td width = 400> Class Name: ".$row["CLASSNAME"].":</td><td width = 500 align = left>";
		echo "Total Students:  ".$row["TOTAL"]."<br><br>";
		echo "Male:  ".$row["MALE"]."<br><br>";
		echo "Female:  ".$row["FEMALE"]."<br><br>";
		
		$i = $i + 1;
	}
	if($i == 1){
			echo "No Record Found.<br>";
	}
	echo "</table>";

	}

}
else{
	
	$q1 = "select classname, count(case when gender='M' then 1 end) as Male, count(case when gender='F' then 1 end) as Female, count(classname) as Total from student group by classname order by classname";
	$query_id1 = oci_parse($con, $q1); 		
	$r1 = oci_execute($query_id1);
	
	echo "<table border = 2>";
	$i = 1;
	while($row = oci_fetch_array($query_id1, OCI_BOTH+OCI_RETURN_NULLS)) 
    {	
		echo "<tr>";
		echo "<td width = 400> Class Name: ".$row["CLASSNAME"].":</td><td width = 500 align = left>";
		echo "Total Students:  ".$row["TOTAL"]."<br><br>";
		echo "Male:  ".$row["MALE"]."<br><br>";
		echo "Female:  ".$row["FEMALE"]."<br><br>";
		
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
