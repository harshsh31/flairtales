<?php
    ob_start();
    session_start();
    include_once 'dbconnect.php';
    $error = $_POST['university_err'];
    if(isset($_POST['signup']) && $error == false){

        $name = trim($_POST['name']);
        $name = strip_tags($name);
        $name = htmlspecialchars($name);

        $university = trim($_POST['university']);
        $university = strip_tags($university);
        $university = htmlspecialchars($university);

        $phone = trim($_POST['phone']);
        $phone = strip_tags($phone);
        $phone = htmlspecialchars($phone);

        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        
        $password = trim($_POST['password']);
        $password = strip_tags($password);
        $password = htmlspecialchars($password);

        $password = sha1($password);

        $query = "INSERT INTO Registration(name,email,university,password,phone_number) VALUES('$name','$email','$university','$password','$phone')";
            $res = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

            if ($res) {
                unset($name);
                unset($email);
                unset($password);
                $_SESSION['name']= $_POST['name'];
                header("Location: home.php");
            }
    }    

?>

<!DOCTYPE html>
<html>
<title>SignUp Page!</title>
<style>
body {font-family: Arial, Helvetica, sans-serif; background-color: black;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password],input[type=email],input[type=number] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus,input[type=number] input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}
/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */

/* Float cancel and signup buttons and add an equal width */
.signupbtn {
  margin-left: 25%;
  margin-top: 2%;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
    background-color: white;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
        margin-left:50%; 
        width: 100%;
    }
}
.error{
    color: red;
    margin-left: 10px;
    margin-bottom: 10px;
}
.division{
    margin-bottom: 20px;
    margin-top: 20px;
}
</style>
<body>
<center>
    <h2 style="color: white; margin-bottom: 20px;">Signup Form</h2>
    <p style="color: white;">Please fill in this form to create an account.</p>
</center>

<div>
    <form name="registration" method="post" action="signup.php" onsubmit="return myFunction();" style="border:1px solid #ccc; margin: 80px; z-index: 100000;">
      <div class="container">
        <div class="division">
            <label for="name"><b>Name</b></label>
            <input type="text" name="name" placeholder="Enter Name" id="name" >
            <span id="name_err" class="error"></span>
        </div>

        <div class="division">
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" >
            <span id="email_err" class="error"></span>
        </div>

        <div class="division">
            <label for="university"><b>University</b></label>
            <input type="text" name="university" placeholder="Enter the University Name" id="university" >
            <span id="university_err" class="error"></span>
        </div>
        
        <div class="division">
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" >
            <span id="password_err" class="error"></span>
        </div>
        
        <div class="division">
            <label for="phone"><b>Phone Number</b></label>
            <input type="number" name="phone" id="phone" placeholder="Enter your phone number" >
            <span id="phone_err" class="error"></span>
        </div>

        <div class="clearfix">
          <button type="submit" name="signup" class="signupbtn">Sign Up</button>
    <!--       <button type="button" class="cancelbtn">Cancel</button>
     -->   
            <p style="margin-left: 40%;">Already a Member?<a href="login.php" style="color:dodgerblue">Login here!</a></p>
            <span id="error" style="color: green;margin-left:10px;"></span>
         </div>
      </div>
    </form>
</div>




<script type="text/javascript">
    
    function myFunction(){
        var name = document.registration.name.value;
        var email = document.registration.email.value;
        var password = document.registration.password.value;
        var university = document.registration.university.value;
        var phone = document.registration.phone.value;
        var error = false;
        if(name == ""){
            error = true;
            document.getElementById('name_err').innerHTML = "Name must not be empty";
        }
        else if(name.length < 5){
            error = true;
            document.getElementById('name_err').innerHTML = "Name must be greater than 5 characters";
        }
        if(password == ""){
            error = true;
            document.getElementById('password_err').innerHTML = "Password must not be empty\n";
        }
        else if(password.length < 8){
            error = true;
            document.getElementById('password_err').innerHTML = "Password must be greater than 8 characters\n";
        }
        if (password.search(/[a-z]/) < 0) {
            error = true;
            document.getElementById('password_err').innerHTML += "<br/>Password must contain atleast one small character";
        }
        if (password.search(/[0-9]/) < 0) {
            error = true;
            document.getElementById('password_err').innerHTML += "<br/>Password must contain atleast one digit\n"; 
        }
        if(email == ""){
            error = true;
            document.getElementById('email_err').innerHTML = "Email must not be empty";
        }
        else if(!(validateEmail(email))){
            error=true;
            document.getElementById('email_err').innerHTML = "Email is not valid.Please enter a valid email id"; 
        }
        if(university == ""){
            error = true;
            document.getElementById('university_err').innerHTML = "University name must not be empty";
        }
        if(phone == ""){
            error = true;
            document.getElementById('phone_err').innerHTML = "Please enter a phone number";
        }
        if(error)
            return false;
        else
            document.getElementById('university_err').value = error;
    }

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

</script>
</body>
</html>
