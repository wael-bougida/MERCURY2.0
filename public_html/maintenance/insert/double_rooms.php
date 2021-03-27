<?php include('../templates/header.php'); ?>


<!-- rid, position -->

<!-- When adding new rooms -> Default of availability: 0 (not occupied) -->

<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>
<?php

include('../../config/db_connect.php');

$rid = $position = "";
$_SESSION['flag'] = 0;
$errors = array('rid' => '', 'position' => '');

if (isset($_POST['submit'])) {


    //Check floor number
    if (empty($_POST['rid'])) {
        $errors['rid'] = 'A room number is required';
	}
	
	if (empty($_POST['position'])) {
        $errors['position'] = 'A position is required';
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        // escape sql chars

        
		$rid = mysqli_real_escape_string($conn, $_POST['rid']);
		$position = mysqli_real_escape_string($conn, $_POST['position']);
        //create sql
        $sql = "INSERT INTO Double_rooms(rid, position) VALUES ($rid, $position)";

        // save to db and check
        if(mysqli_query($conn, $sql)) {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['msg'] = 'Double room inserted into the database.';
            
            
        } else {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['flag'] = 1;
            $_SESSION['msg'] = 'Failed to insert double room: ' . $conn->error;
        }
    }
} // end POST check

?>


    
    <section class="container ">
        <h4 class="">Add a Double Room</h4>

        <form class="form-custom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

			<!-- Choices for Rooms -->
			<div class="form-group">
                    <label for="Rooms">You must choose a room</label>
                    <select name="rid" class="custom-select custom-select-lg mb-3" require>

                        <?php
                        // write query for all rooms
                        $sql = 'SELECT * FROM Rooms';
                        // get the result set (set of rows)
                        $result = mysqli_query($conn, $sql);
                        // fetch the resulting rows as an array
                        $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // free the $result from memory (good practise)
                        mysqli_free_result($result);
                        ?>

                        <!-- Display the options -->
                        <?php
                        foreach ($rooms as $room) :
                        ?>
                            <?php
                            $r_rid = $room['rid'];
                            $r_rnumber = $room['rnumber'];
                            echo "<option value='$r_rid' > $r_rnumber </option>"; ?>
                        <?php endforeach; ?>
                    </select>

                </div>



            <div class="form-group">
                <label>Room Position</label>
				<select name="position" require>					
				<option value="0"> Left </option>
				<option value="1"> Right</option>
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