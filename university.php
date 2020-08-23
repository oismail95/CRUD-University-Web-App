<!-- Omar Ismail -->
<!-- September 12, 2019 -->
<!-- CMP SCI 4610 -->
<!-- Instructor: Abde Mtibaa -->

<?php
	//Sets the table number.
	$mn = intval(filter_input(INPUT_GET, "mn"));
	
	//Sets the ordering attributes.
	$ud = intval(filter_input(INPUT_GET, "ud"));
	
	//Sets the attribute number based on the ordering.
	$cn = intval(filter_input(INPUT_GET, "cn"));
	
	//Sets the form to input.
	$in = intval(filter_input(INPUT_GET, "in"));
	
	//Sets the tuple number for updating.
	$tn = intval(filter_input(INPUT_GET, "tn"));

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
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>University Records</title>
    </head>
    <body>
		<style>
			body{
				background-color: rgb(255, 140, 0);
			}
			
			p{
				font-size: 18px;
				font-family: "Calibri";
				color: rgb(25, 25, 112);
			}
		</style>
		
        <table>
			<!-- Displays the name of the table to select on top of the page. -->
            <tr>
                <?php
                for ($i = 0; $i < count($optArr); $i++) {
                    ?>
                    <td style="width: 7em">
                        <?php
                        if ($mn == $i) {
                            ?>
                            <b><?php print $optArr[$i]; ?></b>
                            <?php
                        } else {
                            ?>
                            <a href="university.php?mn=<?php print $i; ?>">
                                <?php print $optArr[$i]; ?>
                            </a>
                            <?php
                        }
                        ?>
                    </td>
                    <?php
                }
                ?>
            </tr>
        </table>
        <hr />
		
		
		
        <table id="table">
            <tr>
                <?php
                for ($i = 0; $i < count($fields); $i++) {
                    ?>
                    <th style="width: 8em"><?php print $fields[$i]; ?></th>
                        <?php
                    }
                    ?>
            </tr>
			
			<!-- Displays the tuples in the table. -->
            <?php
			
			if (count($data2dArr) != null) {
				for ($j = 0; $j < count($data2dArr[0]); $j++) {
					?>
					<tr>
						<?php
						for ($k = 0; $k < count($fields); $k++) {
							?>
							<td><?php print $data2dArr[$k][$j];?></td>
							<?php
						}
						?>
						<!-- Displays the buttons to update and delete. -->
						<td><input type="image" src="edit.png" width="30px" height="30px" onclick="updateTuple(<?php print $mn; ?>, <?php print $j + 1; ?>)" value="Update"/></td>
						<td><input type="image" src="delete.png" width="30px" height="30px" onclick="deleteTuple(<?php print $mn; ?>, <?php print $j + 1; ?>)" value="Delete"/></td>
					</tr>
					<?php
				}
            ?>
			
			<tr>
				<?php
				for($i = 0; $i < count($fields); $i++){
				?>
					<td style="width: 7em;">
						<!-- Displays the buttons in ascending and descending orders on each attribute. -->
						<input type="image" src="up.jpg" width="30px" height="30px" onclick="sortTable(1,<?php print $mn; ?>,<?php print $i; ?>)" value="Up" />
						<input type="image" src="down.jpg" width="30px" height="30px" onclick="sortTable(2,<?php print $mn; ?>,<?php print $i; ?>)" value="Down" />
					</td>
				<?php
				}
			}
				?>
			</tr>
        </table>
		<hr />
		
		
		<script type="text/javascript">
			function sortTable(u,v,w) {
			   document.location.href = "university.php?mn=" + v + "&cn=" + w + "&ud=" + u;
			}
			
			function updateTuple(u,v){
				//Sets the sorting and column numbers when updating.
				var cn = document.getElementById("colnum").value;
				var ud = document.getElementById("updown").value;
				
				document.location.href = "university.php?mn=" + u + "&tn=" + v + "&cn=" + cn + "&ud=" + ud;
			}
			
			//Passes the information for deleting the tuple number from the table to deleteData.php
			function deleteTuple(u,v){
				//Sets the sorting and column numbers when deleting.
				var cn = document.getElementById("colnum").value;
				var ud = document.getElementById("updown").value;
				
				document.location.href = "deleteData.php?mn=" + u + "&dn=" + v + "&cn=" + cn + "&ud=" + ud;
			}
		</script>
		
		
		
		<!-- Here is where the button, new row, is displayed for users to submit data. -->
		<input type="button" onclick="showInputForm()" value="New Row" />
		
		
		
		<script type="text/javascript">
		   //Here is where the input boxes are shown.
		   function showInputForm(){
			   document.getElementById("inputForm").style.display = "block";
			   document.getElementById("updateForm").style.display = "none";
		   }
		</script>
		
		
		
		<!-- Here is where the text boxes are presented to insert data. -->
		<div id="inputForm" style="display: none">
		<form action="insertData.php" method="post">
		<table>
			<tr>
				<?php
				for ($i = 0; $i < count($fields); $i++) {
					?>
					<td style="width: 8em"><input type="text" name="field<?php print $i; ?>" value="" /></td>
						<?php
					}
					?>
				<td><input type="submit" value="Submit" /></td>
			</tr>
		</table>
		<!-- The hidden parameter is called to pass the specified table. -->
		<input type="hidden" name="pass_table" value=<?php print $mn; ?> />
		
		<!-- The hidden parameter is called to pass the number of attributes. -->
		<input type="hidden" name="attr_num" value=<?php print $i; ?> />
		</form>
		</div>
		
		
		<!-- Here is where the text boxes are presented to update a tuple. -->
		<?php
		  if ($tn > 0) {
	     ?>
			<div id="updateForm" style="display: block">
		<?php
		  } else {
	     ?>
		    <div id="updateForm" style="display: none">
		<?php
		  }
		?>
			<form action="updateData.php" method="post">
			<table>
				<tr>
					<?php
					for ($i = 0; $i < count($fields); $i++) {
					?>
						<td style="width: 8em"><input type="text" name="field<?php print $i; ?>" value="<?php print $data2dArr[$i][$tn-1]; ?>" /></td>
					<?php
					}
					?>
					<td><input type="submit" value="Update" /></td>
				</tr>
			</table>
			<input type="hidden" name="pass_table" value="<?php print $mn; ?>" />
			<input type="hidden" name="attr_num" value="<?php print count($fields); ?>" />
			<input type="hidden" name="tuple_num" value="<?php print $tn; ?>" />
			<input id="colnum" type="hidden" name="colnum" value=<?php print $cn; ?> />
		    <input id="updown" type="hidden" name="updown" value=<?php print $ud; ?> />
			</form>
		</div>
		
    </body>
</html>
<?php
mysqli_close($conn);
?>