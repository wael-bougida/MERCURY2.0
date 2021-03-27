<?php include_once "./templates/header.php" ?>


<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}else{
  header("location: login.php");
  exit;
}
?>
    <h3>Hello, You are identified as an admin. You can make changes to the database:</h3>

    <div class="list-group maintenance">
        <a href="./maintenance/insert/colleges.php" class="list-group-item list-group-item-action">Add Colleges</a>
        <a href="./maintenance/insert/students.php" class="list-group-item list-group-item-action">Add Students</a>
        <a href="./maintenance/insert/students_with_special_need" class="list-group-item list-group-item-action">Add Students with special need (On existing Students)</a>
        <a href="./maintenance/insert/rooms.php" class="list-group-item list-group-item-action">Add Rooms</a>
        <a href="./maintenance/insert/double_rooms.php" class="list-group-item list-group-item-action">Add Double Rooms(On existing Rooms)</a>
        <a href="./maintenance/insert/managers.php" class="list-group-item list-group-item-action">Add Managers</a>
        <a href="./maintenance/insert/ra.php" class="list-group-item list-group-item-action">Add RA (On existing Managers)</a>
        <a href="./maintenance/insert/rm.php" class="list-group-item list-group-item-action">Add RM (On existing Managers)</a>
    </div>

<?php include './templates/footer.php' ?>
</body>

</html>