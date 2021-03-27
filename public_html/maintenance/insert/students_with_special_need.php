<?php include('../templates/header.php'); ?>


<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>
<?php

include('../../config/db_connect.php');

$_SESSION['flag'] = 0;
$sickness = $special_need = $sid = '';

$errors = array('sickness' => '', 'special_need' => '', 'sid'=>'');

if (isset($_POST['submit'])) {

	// check special_need
	if (empty($_POST['special_need'])) {
		$errors['special_need'] = 'A special_need is required';
	} else {
		$special_need = $_POST['special_need'];
		if (!preg_match('/^[a-zA-Z0-9\s]+$/', $special_need)) {
			$errors['special_need'] = 'special_need must be letters and spaces only';
		}
	}

	// check sickness
	if (empty($_POST['sickness'])) {
		$errors['sickness'] = 'An sickness is required';
	} else {
		$sickness = $_POST['sickness'];
		// if(!filter_var($sickness, FILTER_VALIDATE_sickness)){
		// 	$errors['sickness'] = 'sickness must be a valid sickness sickness';
		// }
		if (!preg_match('/^[a-zA-Z0-9\s]+$/', $special_need)) {
			$errors['sickness'] = 'Sickness must be letters and spaces only';
		}
	}


	if (array_filter($errors)) {
		//echo 'errors in form';
	} else {
		
		// escape sql chars
		$sid = mysqli_real_escape_string($conn, $_POST['sid']);
		$sickness = mysqli_real_escape_string($conn, $_POST['sickness']);
		$special_need = mysqli_real_escape_string($conn, $_POST['special_need']);
		
		// create sql
		$sql = "INSERT INTO Students_with_special_need(special_need,sickness, sid) VALUES('$special_need','$sickness', $sid)";

		// save to db and check
		if(mysqli_query($conn, $sql)) {
			header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
			$_SESSION['msg'] = 'Student with special need inserted into the database.';
			
			
		} else {
			header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
			$_SESSION['flag'] = 1;
			$_SESSION['msg'] = 'Failed to insert student with special need: ' . $conn->error;
		}
	}
} // end POST check

?>


	

	<section class="container">
		<h4 class="">Add Sickness and Special Need for Student</h4>




		<form class="form-custom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<!-- Choices for Students  -->
			<div class="form-group">
				<label for="Students">You must choose a college for this room</label>
				<select name="sid" class="custom-select custom-select-lg mb-3">

					<?php
					// write query for all students
					$sql = 'SELECT * FROM Students';
					// get the result set (set of rows)
					$result = mysqli_query($conn, $sql);
					// fetch the resulting rows as an array
					$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
					// free the $result from memory (good practise)
					mysqli_free_result($result);
					?>

					<!-- Display the options -->
					<?php
					foreach ($students as $student) :
					?>
						<?php
						$s_sid = $student['sid'];
						$s_name = $student['name'];
						echo "<option value='$s_sid'> $s_name </option>"; ?>
					<?php endforeach; ?>
				</select>
			</div>


			
			<div class="form-group">
				<label>Student's Sickness</label>
				<input type="text" name="sickness" class="form-control" value="<?php echo htmlspecialchars($sickness) ?>">
				<div class=""><?php echo $errors['sickness']; ?></div>
			</div>


			<div class="form-group">
				<label>Student's Special Need</label>
				<input type="text" class="form-control" name="special_need" value="<?php echo htmlspecialchars($special_need) ?>">
				<div class=""><?php echo $errors['special_need']; ?></div>
			</div>

			<div class="">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			</div>
		</form>
	</section>

	<?php include('../templates/footer.php'); ?>

</body>

</html>