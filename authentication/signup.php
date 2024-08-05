<?php

session_start();

include "../config/database.php";


if(isset($_POST["submit-btn"])){

// input

$name = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];

// ragex

$name_regex = "/^(?! $)[a-zA-Z ]*$/";
$email_regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
$password_regex_uopper = "/^(?=.*?[A-Z])/";
$password_regex_lower = "/^(?=.*?[a-z])/";
$password_regex_number = "/^(?=.*?[0-9])/";
$password_regex_length = "/^.{8,}/";

// dataase 

$flag = false ;


// username

if(!$name){
    $flag = true ;
     $_SESSION["username-error"] = "Input your username";
    header("location: register.php");

}

// username ragex

else if (!preg_match($name_regex , $name)){
    $flag = true ;
    $_SESSION["username-error"] = "Name can't accept any numerical number";
    header("location: register.php");
}
else{
    $_SESSION["old-username"] = "$name ";
    header("location: register.php");
}

// email error 

if(!$email){
    $flag = true ;
    $_SESSION["email-error"] = "Input your email";
    header("location: register.php");
}

// email ragex

else if (!preg_match($email_regex , $email)){
    $flag = true ;
    $_SESSION["email-error"] = "Email is not valid ";
    header("location: register.php");
}

else{
    $_SESSION["old-email"] = "$email";
    header("location: register.php");
}

// password

if(!$password){
    $flag = true ;
    $_SESSION["pass-error"] = "Input your password";
    header("location: register.php");
}

// password ragex start

// uppercase

else if(!preg_match($password_regex_uopper , $password )){
    $flag = true ;
    $_SESSION["pass-error"] = "Password need At least one upper case latter";
    header("location: register.php");
}

// lowercase

else if(!preg_match($password_regex_lower , $password )){
    $flag = true ;
    $_SESSION["pass-error"] = "Password need At least one lower case latter";
    header("location: register.php");
}

// number 

else if(!preg_match($password_regex_number , $password )){
    $flag = true ;
    $_SESSION["pass-error"] = "Password need At least one number";
    header("location: register.php");
}

// length

else if(!preg_match($password_regex_length , $password )){
    $flag = true ;
    $_SESSION["pass-error"] = "Password need At least eight character";
    header("location: register.php");
}
else{
    $_SESSION["old-password"] = "$password";
    header("location: register.php");
}
// passwor ragex end 

// confirm pass word 

if ($confirm_password != $password){
    $flag = true ;
    $_SESSION["confirm-pass-error"] = "password does'nt match";
    header("location: register.php");
}
else{
    $_SESSION["old-con-password"] = "$confirm_password";
    header("location: register.php");
}


}

// database

if($flag == false){
    $db = mysqli_connect("localhost","root","","naptune");
    $encrypt = sha1($password);
    $create_query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$encrypt')";
    mysqli_query ($db , $create_query);
    $_SESSION["register-complete"] = "Registation done";
    $_SESSION["register-name"] = "$name";
    $_SESSION["register-email"] = "$email";
    header("location:signin.php");
 }
 

else{
    header("location: register.php");
}

?>