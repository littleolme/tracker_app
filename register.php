<?php
// NOT FUNCTIONAL

require_once "config.php";

$username = $passwords = $confirm_passwords = "";
$username_err = $passwords_err = $confirm_passwords_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Enter username";
    } else{
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                if($stmt->rowcount() == 1){
                    $username_err = "Username already taken";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Something went wrong. Please try again.";
            }
        }
        
        unset($stmt);
    }
    
    if(empty(trim($_POST["passwords"]))){
        $passwords_err = "Enter a password";
    } elseif(strlen(trim($_POST["passwords"])) < 3){
        $passwords_err = "Must have at least 3 charcaters";
    } else{
        $passwords = trim($_POST["passwords"]);
    }
    
    if (empty(trim($_POST["confirm_passwords"]))){
        $confirm_passwords_err = "Confirm passwords";
    } else{
        $confirm_passwords = trim($_POST["confirm_passwords"]);
        if(empty($passwords_err) && ($passwords != $confirm_passwords)){
            $confirm_passwords_err = "Does not match"
        }
    }
    
    if(empty($username_err) && empty($passwords_err) && empty($confirm_passwords_err)){
        
        $swl = "INSERT INTO users (username, passwords) VALUES (:username, :passwords)";
        
        if($stmt= $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":passwords", $param_passwords, PDO::PARAM_STR);
            
            $param_username = $username;
            $param_passwords = passwords_hash($passwords, PASSSWORD_DEFAULT);
            
            if($stmt->execute()){
                header("location: login.php");
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

<h2>Sign Up</h2>
<p>Fill in this form to create an account</p>

<p>Already have an account? <a href="login.php">Login here</a></p>

<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">

    <label for="passwords">Password</label>
    <input type="passwords" name="passwords" id="passwords">

    <label for="confirm_passwords">Confirm Password</label>
    <input type="passwords" name="confirm_passwords" id="confirm_passwords">

    <input type="submit" name="submit" value="Submit">

</form>




<?php include "templates/footer.php"; ?>
