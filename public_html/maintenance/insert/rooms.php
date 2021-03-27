<?php include('../templates/header.php'); ?>


<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: ../../login.php");
  exit;
}
?>
<!-- rnumber, floor, mailbox, cid -->

<!-- When adding new rooms -> Default of availability: 0 (not occupied) -->

<?php

include('../../config/db_connect.php');

$rnumber = $floor = $mailbox =  $cid = "";

$errors = array('rnumber' => '', 'floor' => '', 'mailbox' => '', 'cid' => '');
$_SESSION['flag'] = 0;
if (isset($_POST['submit'])) {

    //Check rnumber
    if (empty($_POST['rnumber'])) {
        $errors['rnumber'] = 'A rnumber is required';
    } else {
        $rnumber = $_POST['rnumber'];
        if (!preg_match('/^[A-Z0-9\s]{5}$/', $rnumber)) {
            $errors['rnumber'] = 'Room number must be a combination of 2 letters and 3 digits e.g NB123';
        }
    }

    //Check mailbox
    if (empty($_POST['mailbox'])) {
        $errors['mailbox'] = 'A mailbox is required';
    } else {
        $mailbox = $_POST['mailbox'];
        if (!preg_match('/^[A-Z0-9\s]{5}$/', $mailbox)) {
            $errors['mailbox'] = 'Mailbox number must be a combination of 2 letters and 3 digits e.g NB123';
        }
    }

    //Check floor number
    if (empty($_POST['floor'])) {
        $errors['floor'] = 'A floor number is required';
    } else {
        $floor = $_POST['floor'];
        if (!preg_match('/^[1-3]$/D', $floor)) {
            $errors['floor'] = 'Floor number one-digit number only';
        }
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        // escape sql chars
        $rnumber = mysqli_real_escape_string($conn, $_POST['rnumber']);
        $floor = mysqli_real_escape_string($conn, $_POST['floor']);
        $mailbox = mysqli_real_escape_string($conn, $_POST['mailbox']);
        $cid = mysqli_real_escape_string($conn, $_POST['cid']);
        //create sql
        $sql = "INSERT INTO Rooms(rnumber, floor, mailbox, cid, availability) VALUES ('$rnumber', '$floor', '$mailbox', '$cid', 0)";

        // save to db and check
        if(mysqli_query($conn, $sql)) {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['msg'] = 'Room inserted into the database.';
            
            
        } else {
            header('Location: http://clabsql.clamv.jacobs-university.de/~tpham/maintenance/insert/feedback.php');
            $_SESSION['flag'] = 1;
            $_SESSION['msg'] = 'Failed to insert Room: ' . $conn->error;
        }
    }
} // end POST check

?>


    

    <section class="container ">
        <h4 class="">Add a Room</h4>

        <form class="form-custom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <div class="form-group">
                <label>Room Number</label>
                <input class="form-control" type="text" name="rnumber" value="<?php echo htmlspecialchars($rnumber) ?>">
                <div class="text-danger"><?php echo $errors['rnumber']; ?></div>
            </div>


            <div class="form-group">
                <label>Mailbox</label>
                <input class="form-control" type="text" name="mailbox" value="<?php echo htmlspecialchars($mailbox) ?>">
                <div class="text-danger"><?php echo $errors['mailbox']; ?></div>
            </div>



            <div class="form-group">
                <label>Floor </label>
                <input class="form-control" type="text" name="floor" value="<?php echo htmlspecialchars($floor) ?>">
                <div class="text-danger"><?php echo $errors['floor']; ?></div>
            </div>



            

            <!-- Choices for Colleges  -->
            <div class="form-group">
                <label for="Colleges">You must choose a college for this room</label>
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