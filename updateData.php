<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dbname = "university";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

	if (!$conn) {
	  die('Could not connect: ' . mysqli_connect_error());
	}
	
	//Here is where the table number is retrieved.
	$mn = $_POST['pass_table'];
	
	//Here is where the attribute number is retrieved based on the table number.
	$attr_num = $_POST['attr_num'];
	$an = (int)$attr_num;
	
	//Here is where the column numbers gets initialized to insert.
	for($i = 0; $i < $an; $i++){
		$fieldArr[$i] = $_POST["field".$i];
	}
	
	//Passing the tuple number.
	$tn = $_POST['tuple_num'];
	
	//Sets the ordering attributes.
	$ud = intval(filter_input(INPUT_POST, "updown"));
	
	//Sets the attribute number based on the ordering.
	$cn = intval(filter_input(INPUT_POST, "colnum"));
	
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
	
	//Sets the specified table for deleting a tuple.
	if($mn == "0"){
		$oldValue = $data2dArr[0][$tn-1];
		
		$sqlQuery = "UPDATE student
					SET student_number = '$fieldArr[0]', name = '$fieldArr[1]', class = '$fieldArr[2]', major = '$fieldArr[3]'
					WHERE student_number = '$oldValue'";
	}
	else if($mn == "1"){
		$oldValue = $data2dArr[0][$tn-1];
		
		$sqlQuery = "UPDATE course
					SET course_number = '$fieldArr[0]', course_name = '$fieldArr[1]', credit_hours = '$fieldArr[2]', department = '$fieldArr[3]'
					WHERE course_number = '$oldValue'";
	}
	else if($mn == "2"){
		$oldValue = $data2dArr[0][$tn-1];
		
		$sqlQuery = "UPDATE section
					SET section_identifier = '$fieldArr[0]', course_number = '$fieldArr[1]', semester = '$fieldArr[2]', year = '$fieldArr[3]', instructor = '$fieldArr[4]'
					WHERE section_identifier = '$oldValue'";
	}
	else if($mn == "3"){
		$oldValue = $data2dArr[1][$tn-1];
		
		$sqlQuery = "UPDATE grade_report
					SET student_number = '$fieldArr[0]', section_identifier = '$fieldArr[1]', grade = '$fieldArr[2]'
					WHERE section_identifier = '$oldValue'";
	}
	else if($mn == "4"){
		$oldValue = $data2dArr[0][$tn-1];
		
		$sqlQuery = "UPDATE prerequisite
					SET course_number = '$fieldArr[0]', prerequisite_number = '$fieldArr[1]'
					WHERE course_number = '$oldValue'";
	}
	
	mysqli_query($conn, $sqlQuery);
	
	header("Location: university.php?mn=$mn");
?>