<?php include('../templates/header.php'); ?>


<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>

	
	<div class="alert alert-info" role="alert">
		<a href="../maintenance.php" class=>Back to maintenance page</a>
	</div>

	<section>
		<?php

		if ($_SESSION['flag'] == 1 && isset($_SESSION['msg'])) {
			echo '<h1>Failure!</h1>';
			echo '<span style = "color:red;">' . $_SESSION['msg'] . '</span>';
		}
		if ($_SESSION['flag'] == 0 && isset($_SESSION['msg'])) {
			echo '<h1>Success!</h1>';
			echo '<span style = "color:green;">' . $_SESSION['msg'] . '</span>';
		}
		if (session_id()) {
			session_unset();
			session_destroy();
		}
		?>
	</section>
	<?php include('../templates/footer.php'); ?>

</body>

</html>