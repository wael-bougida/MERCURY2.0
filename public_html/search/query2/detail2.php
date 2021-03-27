<?php

include('../../config/db_connect.php');

?>


<?php include('../templates/header.php'); ?>

    <div class="">
        <?php
        $sid = mysqli_real_escape_string($conn, $_GET['title']);
        $sql = "SELECT * 
    FROM Students S
    WHERE S.sid = $sid";

        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
            $row = mysqli_fetch_assoc(($result));
            echo "<h1>Student's Information</h1>";
            echo " <table class='table table-striped table-hover'>
                <tr scope='row'> 
                <td scope='col'>Name</td>
                <td scope='col'>" . $row['name'] . " </td>
                </tr>
                <tr> 
                <td>Matriculation Number </td>
                <td>" . $row['mat_num'] . "</td>
                </tr>
                <tr> 
                <td>Birthday </td>
                <td>" . $row['birthday'] . "</td>
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