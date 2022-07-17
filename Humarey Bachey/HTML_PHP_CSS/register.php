<?php

  require 'dbh.php';
  if (isset($_POST["submit"])){

    /* Student Record */
    $stu_fname = $_POST["stu-fname"];
    $stu_lname = $_POST["stu-lname"];
    $stu_gender = $_POST["gender"];
    $stu_dob = $_POST["stu-dob"];
	$stu_co = $_POST["co"];

    $stu_id = generateStudentID($con);
    /* Mother Record */
    $mother_fname = $_POST["m-fname"];
    $mother_lname = $_POST["m-lname"];
    $mother_address = $_POST["m-address"];
    $mother_email = $_POST["m-email"];
    $mother_cnic = $_POST["m-cnic"];
    $mother_contact = $_POST["m-contact"];

    /* Father Record */
    $father_fname = $_POST["f-fname"];
    $father_lname = $_POST["f-lname"];
    $father_address = $_POST["f-address"];
    $father_email = $_POST["f-email"];
    $father_cnic = $_POST["f-cnic"];
    $father_contact = $_POST["f-contact"];

	if($_POST["staff"]){
		$staff  = $_POST["staff"];
	}
	else{
		$staff = 0;
	}
    /* Guardian Record */
    $g_name = $_POST["g-name"];
    $g_gender = $_POST["g-gender"];
    $relation  = $_POST["relation"];
    $g_cnic = $_POST["g-cnic"];
    $g_contact = $_POST["g-contact"];

    /* avatar */
    $tmpName = $_FILES["avatar"]["tmp_name"];
    $explode = explode(".",$_FILES["avatar"]["name"]);
    $ext = end($explode);
    if(move_uploaded_file($tmpName,"../images/".$stu_id.".".$ext))
    echo "Great Success!";

	
	$q = "select floor(MONTHS_BETWEEN(to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'), to_date('$stu_dob','yyyy-mm-dd'))/12) as STUAGE from dual";
	$query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
	$row = oci_fetch_array($query_id);

echo $stu_co;

	$stu_class = " ";
	if($stu_co == 'Y'){
	if($row["STUAGE"] == 3 || $row["STUAGE"] == 4){	
			$stu_class = "1BG";
	}
	elseif($row["STUAGE"] == 5 || $row["STUAGE"] == 6){
			$stu_class = "2BG";
		
	}
	elseif($row["STUAGE"] == 7 || $row["STUAGE"] == 8){
			$stu_class = "3BG";
		
	}	
	elseif($row["STUAGE"] >= 9 && $row["STUAGE"] <= 12){
			$stu_class = "4BG";
	}	
	else{
			echo "Cant Add Record. Student Age must be between 3-12";
			$stu_class = "Invalid";
	}	
	}
	else{
		
	if($row["STUAGE"] == 3 || $row["STUAGE"] == 4){
		if($stu_gender = 'F'){
			$stu_class = "1AG";
		}
		else{
			$stu_class = "1BM";
		}
	}
	elseif($row["STUAGE"] == 5 || $row["STUAGE"] == 6){
		if($stu_gender = 'F'){
			$stu_class = "2AG";
		}
		else{
			$stu_class = "2BM";
		}
	}
	elseif($row["STUAGE"] == 7 || $row["STUAGE"] == 8){
		if($stu_gender = 'F'){
			$stu_class = "3AG";
		}
		else{
			$stu_class = "3BM";
		}
	}	
	elseif($row["STUAGE"] >= 9 && $row["STUAGE"] <= 12){
		if($stu_gender = 'F'){
			$stu_class = "4AG";
		}
		else{
			$stu_class = "4BM";
		}
	}	
	else{
			echo "Cant Add Record. Student Age must be between 3-12";
			$stu_class = "Invalid";
	}
	}
	
	if($stu_class != "Invalid"){

    $q = "INSERT INTO Parent (CNIC, Fname, Lname, Address, Contact, Gender, Email, Member_Staff) VALUES ($mother_cnic, '$mother_fname', '$mother_lname','$mother_address', $mother_contact,'F','$mother_email',$staff)";

    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
	
    $q = "INSERT INTO Parent (CNIC, Fname, Lname, Address, Contact, Gender, Email, Spouse, Member_Staff) VALUES ($father_cnic, '$father_fname', '$father_lname', '$father_address', $father_contact,'M','$father_email', '$mother_cnic', $staff)";

    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);

    $q = "INSERT INTO Guardian (CNIC, Name, Contact, Gender, Relation) VALUES ($g_cnic, '$g_name',$mother_contact,'$g_gender', '$relation')";

    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);

    $q = "INSERT INTO Student (Stu_ID,Fname,Lname,dob,gender,father_cnic,guardian_cnic,stu_image,reg_date,classname) VALUES ('$stu_id','$stu_fname', '$stu_lname', to_date('$stu_dob', 'yyyy/mm/dd'), '$stu_gender',$father_cnic,$g_cnic,'$ext', to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'), '$stu_class')";

    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);

    header("Location: invoice.php?father-name=$father_fname&father-cnic=$father_cnic&stu-id=$stu_id&m-staff=$staff");

	}

  }

  function generateStudentID($con){

    $id  = date("Y")%2000;
    $id = $id."I-";

    $q = "SELECT * FROM ( SELECT * FROM Student WHERE STU_ID LIKE '$id%' ORDER BY STU_ID DESC) WHERE ROWNUM = 1";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
    $row;

    if (($row = oci_fetch_array($query_id, OCI_BOTH)) == false){
      $num = "1000";
      $id = $id.$num;
      return $id;
    }

    $num = substr($row["STU_ID"], 4);
    $num++;
    $id = $id.$num;

    return $id;
  }
