<?php
 session_start();
  include_once 'dbconnect.php';
  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = stripslashes($email);
    $password = stripslashes($password);
    $email = mysql_real_escape_string($email);
    $password = mysql_real_escape_string($password);
    $password = sha1($password);
    $query = "select * from Registration where email ='$email' and password='$password'";
    $result = mysql_query($query) or die("Failed to query database ".mysql_error());

    $row = mysql_fetch_array($result);
    if($row){
      if($row['email']== $email && $row['password']== $password) 
      {
        $_SESSION['name']=$row['name'];
        header("Location: home.php");
      }
    }
    else{
    echo '<script language="javascript">';
    echo 'alert("Please enter correct details. Your username or password is wrong.")';
    echo '</script>';
    }
  }
  function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Page!</title>
<style>
body {font-family: Arial, Helvetica, sans-serif; background-color: black;}
form {border: 3px solid #f1f1f1; margin: 80px; z-index: 1000000;}

input[type=password],input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin-left:25%;
    border: none;
    cursor: pointer;
    width: 50%;
}

button:hover {
    opacity: 0.8;
}


.imgcontainer {
    text-align: center;
    padding: 80px;
    background-color: white;

}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
    background-color: white;
}

span.psw {
    padding-top: 16px;
}
.middle{
  margin-left: 45%;
}
h2{
  color: white;
}
/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: left;
       margin-left: 45%;
    }
}
</style>
</head>
<body>

<center><h2>Login Form</h2></center>

<form action="login.php" method="post">
  <div class="imgcontainer">
    <img src="img_avatar2.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <div>
      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" id="email" name="email">
      <span id="email_err" class="error"></span>
    </div>
    
    <div>
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" id="password" name="password">
      <span id="password_err" class="error"></span>
    </div>
    <button type="submit" name="login">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <span class="psw" >
      <a href="signup.php" class="middle">Signup Here!</a>      
    </span>
  </div>
</form>
</body>
</html>