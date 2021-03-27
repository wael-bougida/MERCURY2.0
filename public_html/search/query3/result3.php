<?php

include('../../config/db_connect.php');

?>


<?php include('../templates/header.php'); ?>
    <h1>Result page</h1>
    <?php
    if (isset($_POST['submit'])) {
        $cname = mysqli_real_escape_string($conn, $_POST['name']);

        $sql = "SELECT *
        FROM Rooms R
        INNER JOIN Colleges C ON C.cid = R.cid AND C.name LIKE '%$cname%'
        WHERE R.availability = 1;";

        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
            echo "<table style='width:100%' class='table table-striped table-hover'>";
            echo "<thead class='thead-dark'>
            <tr>
              <th scope='col'>Room's number</th>
              <th scope='col'>Floor</th>
              <th scope='col'>Mailbox</th>
              <th scope='col'>Link to more information</th>
            </tr>
            </thead>";
            while ($row = mysqli_fetch_assoc(($result))) {

                echo " 
                <tr>
                    <td>" . $row['rnumber'] . "</td>
                    <td>" . $row['floor'] . "</td>
                    <td>" . $row['mailbox'] . "</td>
                    <td> <a href='detail3.php?title=" . $row['rid'] . "'>More information</a> </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>There are no results matching your search</p>";
        }

        mysqli_free_result($result);
    }




    ?>
    <?php include('../templates/footer.php'); ?>


</body>

</html>