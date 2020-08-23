<?php

	//Sets the table number.
	$mn = intval(filter_input(INPUT_GET, "mn"));
	
	//Sets the tuple number for deleting.
	$dn = intval(filter_input(INPUT_GET, "dn"));
	
	//Sets the ordering attributes.
	$ud = intval(filter_input(INPUT_GET, "ud"));
	
	//Sets the attribute number based on the ordering.
	$cn = intval(filter_input(INPUT_GET, "cn"));
	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dbname = "university";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

	if (!$conn) {
	  die('Could not connect: ' . mysqli_connect_error());
	}

	//Here is where the table name is retrieved.
	$tblArr = array();
	$tblArr[] = "student";
	$tblArr[] = "course";
	$tblArr[] = "section";
	$tblArr[] = "grade_report";
	$tblArr[] = "prerequisite";

	$table_name = $tblArr[$mn];

	$sql = "SHOW COLUMNS FROM $table_name";
	$result1 = mysqli_query($conn, $sql);

	while ($record = mysqli_fetch_array($result1)) {
		$fields[] = $record['0'];
	}
	
	//Here is where the name of the tables get displayed based on the table selected.
	$optArr = array();
	$optArr[] = "Student";
	$optArr[] = "Course";
	$optArr[] = "Section";
	$optArr[] = "Grade Report";
	$optArr[] = "Prerequisite";

	$data2dArr = array();
	
	//Here is where the query is set up to display the columns in ascending, descending, or normal relation.
    if ($ud == 1) {
		$query = "SELECT * FROM  $table_name ORDER BY $fields[$cn] ASC";
	} else if ($ud == 2) {
		$query = "SELECT * FROM  $table_name ORDER BY $fields[$cn] DESC";
	}else {
		$query = "SELECT * FROM  $table_name";
	}
	
	$result2 = mysqli_query($conn, $query);

	while ($line = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
		$i = 0;
		foreach ($line as $col_value) {
			$data2dArr[$i][] = $col_value;
			$i++;
		}
	}
	
	//Loops through the loop to get the number of attributes depending on the table.
	for($i = 0; $i < count($fields); $i++){
		$arr[] = $data2dArr[$i][$dn-1];
	}
			
	//Sets the specified table for deleting a tuple.
	if($table_name == "student"){
		$query = "DELETE FROM $table_name
				 WHERE student_number = '$arr[0]' AND name = '$arr[1]' AND class = '$arr[2]' AND major = '$arr[3]'";
	}
	else if($table_name == "course"){
		$query = "DELETE FROM $table_name 
				  WHERE course_number = '$arr[0]' AND course_name = '$arr[1]' AND credit_hours = '$arr[2]' AND department = '$arr[3]'";
	}
	else if($table_name == "section"){
		$query = "DELETE FROM $table_name
				  WHERE section_identifier = '$arr[0]' AND course_number = '$arr[1]' AND semester = '$arr[2]' AND year = '$arr[3]' AND instructor = '$arr[4]'";
	}
	else if($table_name == "grade_report"){
		$query = "DELETE FROM $table_name
				  WHERE student_number = '$arr[0]' AND section_identifier = '$arr[1]' AND grade = '$arr[2]'";
	}
	else if($table_name == "prerequisite"){
		$query = "DELETE FROM $table_name
				  WHERE course_number = '$arr[0]' AND prerequisite_number = '$arr[1]'";
	}
			
	$result = mysqli_query($conn, $query);

	header("Location: university.php?mn=$mn");
?>