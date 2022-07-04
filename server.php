<?php


session_start();

$username='';
$email='';
$errors= array();



//Connect to the database

$db=mysqli_connect('localhost', 'root', '', 'login');

// when we submit the form
//receive the inputs from the form
if(isset($_POST['reg_user'])){
$username = mysqli_real_escape_string($db, $_POST['username']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


//Form validation

if(empty($username)){
    array_push($errors,'Username is required');
}
if(empty($password_1)){
    array_push($errors,'password is required');
}
if($password_2 != $password_1){
    array_push($errors,'The tow passwords do not match');
}

// now let we check if the user already exists

$user_check= "SELECT * FROM usuarios WHERE username='$username' LIMIT 1 ";
$result=mysqli_query($db,$user_check);
$user=mysqli_fetch_assoc($result);
//if user exists
if($user){
  if($user['username']=== $username){
      array_push($errors, 'Username already exists');
  }
}





if(count($errors) == 0){
    //password encryption
    $password=md5($password_1);

    $query= "INSERT INTO usuarios (username, password) VALUES('$username' , '$password')";
    mysqli_query($db, $query);
    //success messages once the user log in to the dashboard
    $_SESSION['username']=$username;
    $_SESSION['success']='You Registered Successfully';
    header('location:home.php');
}
}





















?>