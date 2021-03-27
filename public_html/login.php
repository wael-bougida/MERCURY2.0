<?php include_once "./templates/header.php" ?>
<?php
require_once "./config/db_connect.php";
 
$username = $password = "";
$username_err = $password_err = "";
 
// 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
    $sql  = "SELECT * FROM Users WHERE userName = ?;";
    $prestate = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate, $sql)) {
        // header("location: ../signlog.php?error=prestatefailed");
        exit();
    }

    mysqli_stmt_bind_param($prestate, "s", $username);
    mysqli_stmt_execute($prestate);


    $resultdata = mysqli_stmt_get_result($prestate);

    if ($row = mysqli_fetch_assoc($resultdata)) {
        if($password == $row["userPwd"]){
            session_start();              
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;                            
                                
            // redirect user to maintenance page
            header("location: maintenance.php");
        }else{
            //error message if password is not valid
            $password_err = "Incorrect password";
        }    
    } else {
    //error message if username doesn't exist
    $username_err = "Wrong username";
    $_SESSION["loggedin"] = false;
    }
    mysqli_stmt_close($prestate);
}
}
?>
 

    <div>
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form class="form-custom"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    
    <?php include_once "./templates/footer.php" ?>
</body>
</html>