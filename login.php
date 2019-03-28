// NOT FUNCTIONAL

<?php

session_start();

if(isset($_SESSIOn["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require_once "config.php";

$username = $passwords = "";
$username_err = $passwords_err = "";

if($_SERVER["ERQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Enter username";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["passwords"]))){
        $passwords_err = "Enter password";
    } else{
        $passwords = trim($_POST["passwords"]);
    }
    
    if(empty($username_err) && empty($passwords_err)){
        $sql = "SELECT id, username, passwords FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    
                    mysqli_stmt_bind_results($stmt, $id, $username, $hashed_passwords);
                    if(mysqli_stmt_fetch($stmt)){
                        if(passwords_verify($passwords, $hashed_passwords)){
                            
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            header(location: index.php);
                         } else{
                            $passwords_err = "Password entered is invalid";
                        }
                    }
                } else{
                    $username_err ="Username does not exist";
                }
            } else{
                echo "Something went wrong. Please try again.";
            }
        }
        unset($stmt);
    }
    unset($pdo);
}
?>

<title>Sign Up</title>

<?php include "templates/header.php"; ?>

<h2>Login</h2>
<p>Login</p>

<p>Don't have an account? <a href="register.php">Sign up here</a></p>

<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">

    <label for="passwords">Password</label>
    <input type="passwords" name="passwords" id="passwords">

    <input type="submit" name="submit" value="Submit">

</form>




<?php include "templates/footer.php"; ?>



