<?php

include('../../config/db_connect.php');

$name = '';

$errors = array('address' => '', 'name' => '');
if (isset($_POST['submit'])) {

	// check name
	if (empty($_POST['name'])) {
		$errors['name'] = 'A name is required';
	} else {
		$name = $_POST['name'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
			$errors['name'] = 'Name must be letters and spaces only';
		}
	}

	// if(array_filter($errors)){
	// 	//echo 'errors in form';
	// } else {
	// 	// escape sql chars
	// 	$address = mysqli_real_escape_string($conn, $_POST['address']);
	// 	$name = mysqli_real_escape_string($conn, $_POST['name']);

	// 	// create sql
	// 	$sql = "INSERT INTO Colleges(name,address) VALUES('$name','$address')";

	// 	// save to db and check
	// 	if(mysqli_query($conn, $sql)) {
	// 		header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
	// 		$_SESSION['msg'] = $name . ' inserted into the database.';


	// 	} else {
	// 		header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
	// 		$_SESSION['flag'] = 1;
	// 		$_SESSION['msg'] = 'Failed to insert ' . $name . ': ' . $conn->error;
	// 	}
	// }

} // end POST check

?>


<?php include('../templates/header.php'); ?>
<section class="container">
	<h4 class="">Search for available room in a college</h4>
	<form class="form-custom" action="result3.php" method="POST">

		<div class="form-group">
			<label>College Name</label>
			<input type="text" name="name" id="college_name" class="form-control" placeholder="Enter Colleges Name" value="<?php echo htmlspecialchars($name) ?>" />
			<div id="collegeList"></div>
			<div class=""><?php echo $errors['name']; ?></div>
		</div>

		<div class="">
			<button type="submit" name="submit" value="Submit" class="btn btn-primary"> Search
		</div>
	</form>
</section>



<?php include('../templates/footer.php'); ?>
</body>

</html>

<script>
	$(document).ready(function() {
		$('#college_name').autocomplete({
			source: function(request, response) {
				var query = request.term;
				if (query != '') {
					$.ajax({
						url: "../../config/ajax.php",
						method: "POST",
						data: {
							query: query
						},
						success: function(data) {
							$('#collegeList').fadeIn();
							$('#collegeList').html(data);
						}
					});
				}
			},
			autoFocus: true
		});

		$(document).on('click', 'li', function() {
			$('#college_name').val($(this).text());
			$('#collegeList').fadeOut();
		});
	});
</script>