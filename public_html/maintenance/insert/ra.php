<?php include('../templates/header.php'); ?>


<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>
<!-- mgid, availability -->

<!-- When adding new rooms -> Default of availability: 0 (not occupied) -->

<?php

include('../../config/db_connect.php');

$mgid = $availability = "";

$errors = array('mgid' => '', 'availability' => '');
$_SESSION['flag'] = 0;
if (isset($_POST['submit'])) {


    //Check manager number
    if (empty($_POST['mgid'])) {
        $errors['mgid'] = 'A manager id is required';
	}
	
	if (empty($_POST['availability'])) {
        $errors['availability'] = 'Availability is required';
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        // escape sql chars

        
		$mgid = mysqli_real_escape_string($conn, $_POST['mgid']);
		$availability = mysqli_real_escape_string($conn, $_POST['availability']);
        //create sql
        $sql = "INSERT INTO RA(mgid, availability) VALUES ($mgid, $availability)";

        if(mysqli_query($conn, $sql)) {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['msg'] = 'RA inserted into the database.';
            
            
        } else {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['flag'] = 1;
            $_SESSION['msg'] = 'Failed to insert RA: ' . $conn->error;
        }
    }
} // end POST check

?>


    <section class="container ">
        <h4 class="">Add a RA</h4>

        <form class="form-custom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

			<!-- Choices for Rooms -->
			<div class="form-group">
                    <label for="Rooms">You must choose a manager</label>
                    <select name="mgid" class="custom-select custom-select-lg mb-3" require>

                        <?php
                        // write query for all rooms
                        $sql = 'SELECT * FROM Managers';
                        // get the result set (set of rows)
                        $result = mysqli_query($conn, $sql);
                        // fetch the resulting rows as an array
                        $managers = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // free the $result from memory (good practise)
                        mysqli_free_result($result);
                        ?>

                        <!-- Display the options -->
                        <?php
                        foreach ($managers as $manager) :
                        ?>
                            <?php
                            $m_mgid = $manager['mgid'];
                            $m_name = $manager['name'];
                            echo "<option value='$m_mgid' > $m_name </option>"; ?>
                        <?php endforeach; ?>
                    </select>

                </div>



            <div class="form-group">
                <label>RA availability</label>
				<select name="availability" require>					
				<option value='0'> Not Available </option>
				<option value='1'> Available</option>
				</select>
            </div>

            
            </div>
            <div class="">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </section>

    <?php include('../templates/footer.php'); ?>

</body>

</html>