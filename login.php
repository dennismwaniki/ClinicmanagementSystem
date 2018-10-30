<!DOCTYPE html>
<html>
<head>
	<title> login Screen </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<center>
	<h1> LOGIN DETAILS </h1>
	<fieldset>
<form action="" method="POST">
 <input type="text" name="username" placeholder="Enter Your username">
 <br><br>
	 <input type="password" name="password" placeholder="Enter Your password">
	 <br><br>
	 <input type="submit" value="login" class="btn btn-dark">

</form>
<a href="">Dont have an Account </a><br>
<a href="">Forgot Password </a><br>
</fieldset>
</center>
</body>
</html>


<?php
//Authenticate Users
if (empty($_POST)) {
	exit();
}


$object=new userLogin($_POST['username'],
                      $_POST['password']);
$object->login();

 class userLogin{
 	function __construct($username,$password){
     $this->username=$username;
      $this->password=$password;

 	}//end of fuction

 	//use above variables constructed to authenticate users

 	function login(){
 		$conn=mysqli_connect("localhost","root","","clinic_db");
 		$response= mysqli_query($conn, "SELECT * FROM table_users Where username='$this->username' AND password= '$this->password' AND status='active'");

 		//test response
 		if (mysqli_num_rows($response) ==0) {
 			echo "login failed!check credentials";
 		}

 elseif (mysqli_num_rows($response)==1) {
 	echo "login success.welcome";
 	//create session
 	session_start();
 	$_SESSION['username']=$this->username;  //store username
 	$_SESSION['time']=date("y/m/d h:m:s");   //store time

 	//session are stored and available to all other php files

 	$colm=mysqli_fetch_array($response);
 	$_SESSION ['role']=$colm[2];

 	header ("location:addpatient.php");
 }

 else {
 	echo "something went wrong.contact Admin";
 }

 	}//end of function login
 }//end of class





?>