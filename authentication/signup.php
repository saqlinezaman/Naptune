<?php

session_start();

if(isset($_POST["submit-btn"])){

// input

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];

// ragex

$name_regex = "/^(?! $)[a-zA-Z ]*$/";


// username

if(!$username){
 $_SESSION["username-error"] = "Input your password";
 header("location: register.php");

}

// username ragex

else if (!preg_match($name_regex , $username)){
    $_SESSION["username-error"] = "Name can't accept any numerical number";
    header("location: register.php");
}


}else{
    header("location: register.php");
}

?>