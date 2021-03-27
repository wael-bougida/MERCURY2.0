<?php include('../templates/header.php'); ?>

<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>
<!-- name, age, contact_num, cid -->

<!-- When adding new rooms -> Default of availability: 0 (not occupied) -->

<?php

include('../../config/db_connect.php');

$name = $age = $contact_num =  $cid = "";

$errors = array('name' => '', 'age' => '', 'contact_num' => '', 'cid' => '');
$_SESSION['flag'] = 0;$_SESSION['flag'] = 0;
if (isset($_POST['submit'])) {

     //Check name
     if (empty($_POST['name'])) {
        $errors['name'] = 'A name is required';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = 'Name must be letters and spaces only';
        }
    }

    //Check contact_num
    if (empty($_POST['contact_num'])) {
        $errors['contact_num'] = 'A contact number is required';
    } else {
        $contact_num = $_POST['contact_num'];
        if (!preg_match('/^[0-9]+$/', $contact_num)) {
            $errors['contact_num'] = 'Contact number must be numbers only';
        }
    }

    //Check age number
    if (empty($_POST['age'])) {
        $errors['age'] = 'An age number is required';
    } else {
        $age = $_POST['age'];
        if (!preg_match('/^[0-9]{2}$/D', $age)) {
            $errors['age'] = 'age number two-digit number only';
        }
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        // escape sql chars
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
        $cid = mysqli_real_escape_string($conn, $_POST['cid']);
        //create sql
        $sql = "INSERT INTO Managers(name, age, contact_num, cid) VALUES ('$name', '$age', '$contact_num', '$cid')";

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




    <section class="container ">
        <h4 class="">Add a Manager</h4>

        <form class="form-custom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <div class="form-group">
                <label>Manager Name</label>
                <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
                <div class="text-danger"><?php echo $errors['name']; ?></div>
            </div>


            <div class="form-group">
                <label>Contact Number</label>
                <input class="form-control" type="text" name="contact_num" value="<?php echo htmlspecialchars($contact_num) ?>">
                <div class="text-danger"><?php echo $errors['contact_num']; ?></div>
            </div>



            <div class="form-group">
                <label>Age </label>
                <input class="form-control" type="text" name="age" value="<?php echo htmlspecialchars($age) ?>">
                <div class="text-danger"><?php echo $errors['age']; ?></div>
            </div>



            

            <!-- Choices for Colleges  -->
            <div class="form-group">
                <label for="Colleges">You must choose a college that this manager manage</label>
                <select name="cid" class="custom-select custom-select-lg mb-3" require>

                    <?php
                    // write query for all rooms
                    $sql = 'SELECT * FROM Colleges';
                    // get the result set (set of rows)
                    $result = mysqli_query($conn, $sql);
                    // fetch the resulting rows as an array
                    $colleges = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    // free the $result from memory (good practise)
                    mysqli_free_result($result);
                    ?>

                    <!-- Display the options -->
                    <?php
                    foreach ($colleges as $college) :
                    ?>
                        <?php
                        $c_cid = $college['cid'];
                        $c_name = $college['name'];
                        echo "<option value='$c_cid' > $c_name </option>"; ?>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </section>

    <?php include('../templates/footer.php'); ?>

</body>

</html>