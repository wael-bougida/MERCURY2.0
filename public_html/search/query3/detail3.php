<?php

include('../../config/db_connect.php');

?>

<?php include('../templates/header.php'); ?>

    <div class="">
        <?php
        $rid = mysqli_real_escape_string($conn, $_GET['title']);
        $sql = "SELECT * 
        FROM Rooms R
        INNER JOIN Colleges C ON C.cid = R.cid
        WHERE R.rid = $rid";

        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
            $row = mysqli_fetch_assoc(($result));
            echo "<h1>Room's Information</h1>";
            echo " <table class='table table-striped table-hover'>
                <tr scope='row'> 
                <td scope='col'>Room's Number</td>
                <td scope='col'>" . $row['rnumber'] . " </td>
                </tr>
                <tr> 
                <td>Floor </td>
                <td>" . $row['floor'] . "</td>
                </tr>
                <tr> 
                <td>Mailbox </td>
                <td>" . $row['mailbox'] . "</td>
                </tr>
                <tr> 
                <td>Availability </td>
                <td>" . $row['availability'] . "</td>
                </tr>
                <tr>
                <td>College </td>
                <td>" . $row['name'] . "</td>
                </tr>
                </table>";
        } else {
            echo "<p>There are no results matching your search</p>";
        }

        mysqli_free_result($result);
        ?>

    </div>



    <?php include('../templates/footer.php'); ?>

</body>

</html>