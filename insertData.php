<?php
	include 'db_connection.php';
	
	//Here is where the table number is retrieved.
	$mn = $_POST['pass_table'];
	
	//Here is where the attribute number is retrieved based on the table number.
	$attr_num = $_POST['attr_num'];
	$an = (int)$attr_num;
	
	//Here is where the column numbers gets initialized to insert.
	for($i = 0; $i < $an; $i++){
		$fieldArr[$i] = $_POST["field".$i];
	}
	
	//Here is where the insert queries gets created.
	if($mn == "0"){
		$sqlQuery = "INSERT INTO student (`student_number`, `name`, `class`, `major`) 
					VALUES ('$fieldArr[0]', '$fieldArr[1]', '$fieldArr[2]', '$fieldArr[3]')";
	}
	else if($mn == "1"){
		$sqlQuery = "INSERT INTO course (`course_number`, `course_name`, `credit_hours`, `department`) 
					VALUES ('$fieldArr[0]', '$fieldArr[1]', '$fieldArr[2]', '$fieldArr[3]')";
	}
	else if($mn == "2"){
		$sqlQuery = "INSERT INTO section (`section_identifier`, `course_number`, `semester`, `year`, `instructor`)
					VALUES ('$fieldArr[0]', '$fieldArr[1]', '$fieldArr[2]', '$fieldArr[3]', '$fieldArr[4]')";
	}
	else if($mn == "3"){
		$sqlQuery = "INSERT INTO grade_report (`student_number`, `section_identifier`, `grade`)
					VALUES ('$fieldArr[0]', '$fieldArr[1]', '$fieldArr[2]')";
	}
	else if($mn == "4"){
		$sqlQuery = "INSERT INTO prerequisite (`course_number`, `prerequisite_number`)
					VALUES ('$fieldArr[0]', '$fieldArr[1]')";
	}
	
	//The insert query gets submitted in the relation.
	dbQuery($sqlQuery);
	
	//The header will return the designated hyperlink page.
	header("Location: university.php?mn=$mn");
?>