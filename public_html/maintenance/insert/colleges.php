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

	$address = $name = '';
	
	$errors = array('address' => '', 'name' => '');
	$_SESSION['flag'] = 0;
	if(isset($_POST['submit'])){
		
		// check name
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['name'] = 'Name must be letters and spaces only';
			}
		}

		// check address
		if(empty($_POST['address'])){
			$errors['address'] = 'An address is required';
		} else{
			$address = $_POST['address'];
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $address)){
				$errors['address'] = 'Address must be letters and spaces only';
			}
		}

	
		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$name = mysqli_real_escape_string($conn, $_POST['name']);

			// create sql
			$sql = "INSERT INTO Colleges(name,address) VALUES('$name','$address')";

			// save to db and check
			if(mysqli_query($conn, $sql)) {
				header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
				$_SESSION['msg'] = $name . ' inserted into the database.';
				
				
			} else {
				header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
				$_SESSION['flag'] = 1;
				$_SESSION['msg'] = 'Failed to insert ' . $name . ': ' . $conn->error;
			}
		}

	} // end POST check

?>

	


	<section class="container">
		<h4 class="">Add a College</h4>
		<form class="form-custom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		
		<div class="form-group">
			<label>College Name</label>
			<input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class=""><?php echo $errors['name']; ?></div>
		</div>

		<div class="form-group">
			<label>College Address</label>
			<input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($address) ?>">
			<div class=""><?php echo $errors['address']; ?></div>
		</div>

			<div class="">
				<input type="submit" name="submit"  value="Submit" class="btn btn-primary">
			</div>
		</form>
	</section>

	<?php include('../templates/footer.php'); ?>

</body>
</html>