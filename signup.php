<!DOCTYPE html>

<?php
include 'Connection.php';
if (isset($_POST['signup_btn'])){
$username= mysqli_real_escape_string($con,$_POST['username']);
$email= mysqli_real_escape_string($con,$_POST['email']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$c_password=mysqli_real_escape_string($con,$_POST['c_password']);
if(empty($username)){
    $error="usernsme is needed";
}
elseif(empty($email)){
      $error="email is needed";
}
elseif(empty($password)){
      $error="Password is needed";
}
elseif($password != $c_password){
    $error="Password does not match";
}
elseif(strlen($username) < 3 || strlen($username) >30){
    $error="usernamemust be between 3 to 30 Charactor";
}
elseif(strlen($password) > 6){
    $error="password must atleast 6 Charactor";
}

else{
    $check_email="SELECT * FROM student WHERE email='$email'";
    $data=mysqli_query($con,$check_email);
    $result= mysqli_fetch_array($data);
    if($result > 0){
        $error="Email already exist";
    }
    else{
        $pass=md5($password);
        $insert="INSERT INTO student (username,email,password) Values('$username','$email','$pass')";
        $q=mysqli_query($con,$insert);
        if($q){
            $success="Your account created successfully";
        }
    }
}
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="stylecss.css">

<body>
    
<div class="signup">
<p style="color: red">
    <?php
if(isset($error)){
    echo $error;
}
    ?>
</p>

<p style="color: green">
    <?php
if(isset($success)){
    echo $success;
}
    ?>
</p>

<form action="" method="POST">
    <input type="text" name="username" placeholder="username" value="<?php 
    if(isset($error)) {
        echo $username;
        } ?>">
    <br><br>

     <input type="email" name="email" placeholder="email" value="<?php if(isset($error)) {echo $email;} ?>">
    <br><br>

     <input type="password" name="password" placeholder="password" value="<?php if(isset($error)) {echo $password;} ?>">
    <br><br>

         <input type="password" name="c_password" placeholder="c_password">
    <br><br>

    <input type="submit" name="signup_btn" value="signup">
</form>

</div>

</body>
</html>