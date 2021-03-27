<?php include('../templates/header.php'); ?>


<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>
<!-- mgid, office_hour -->

<!-- When adding new rooms -> Default of office_hour: 0 (not occupied) -->

<?php

include('../../config/db_connect.php');

$mgid = $office_hour = "";

$errors = array('mgid' => '', 'office_hour' => '');
$_SESSION['flag'] = 0;
if (isset($_POST['submit'])) {


    //Check manager number
    if (empty($_POST['mgid'])) {
        $errors['mgid'] = 'A manager id is required';
    }

    if (empty($_POST['office_hour'])) {
        $errors['office_hour'] = 'Office hour is required';
    } else {
        $office_hour = $_POST['office_hour'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $office_hour)) {
            $errors['office_hour'] = 'Office hour must be letters and spaces only';
        }
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        // escape sql chars


        $mgid = mysqli_real_escape_string($conn, $_POST['mgid']);
        $office_hour = mysqli_real_escape_string($conn, $_POST['office_hour']);
        //create sql
        $sql = "INSERT INTO RM(mgid, office_hour) VALUES ($mgid, '$office_hour')";

        // save to db and check
        if(mysqli_query($conn, $sql)) {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['msg'] = 'RM inserted into the database.';
            
            
        } else {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['flag'] = 1;
            $_SESSION['msg'] = 'Failed to insert RM: ' . $conn->error;
        }
    }
} // end POST check

?>

    

    <section class="container ">
        <h4 class="">Add a RM</h4>

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
                <label>RM office hour</label>
                <input type="text" class="form-control" name="office_hour" value="<?php echo htmlspecialchars($office_hour) ?>">
                <div class=""><?php echo $errors['office_hour']; ?></div>
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