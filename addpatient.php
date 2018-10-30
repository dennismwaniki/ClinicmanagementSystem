<?php
session_start();
if(isset($_SESSION['username'])) {
	if($_SESSION['role']=="doctor") {
	$username=$_SESSION['username'];
	echo "Welcome :$username";
	echo "<a href='logout.php'>logout </a>";
    }
   
   else{
   	echo "only doctors allowed";
   	exit();
   }



}
 else if (!isset($_SESSION['username'])) {
 	header("location:login.php");
 	exit(); //kill 
 }
else {
	header("location:login.php");
	exit(); //kill
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Add Patient </title>

</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<body>
	<h1> Add Patient</h1>
	<a href="addpatient.php">Add patient</a>
		<a href="doctors.php">Add Doctor</a>
		<a href="psearch.php"> Search Patient</a>
		<a href="psearch.php">Search Doctor</a>
		<a href="checkup.php">patient CheckUp</a>
	<fieldset>
<form action="" method="POST">
 <input type="text" name="surname" placeholder="Enter Your surname">
 <br><br>
	 <input type="text" name="fname" placeholder="Enter Your Firstname">
	 <br><br>
	 <input type="text" name="lname" placeholder="Enter Your Lastname">
	  <br><br>
	 <input type="tel" name="phone" placeholder="Enter Your Phone">
	  <br><br>
	 <input type="text" name="residence" placeholder="Enter Your Residence">
	  <br><br>
	 <input type="text" name="patient_id" placeholder="Enter Your Patient identity no">
	   <br><br>
	   <label> Select Gender </label>
	 <input type="radio" name="gender">Male
	 <input type="radio" name="gender">Female
	     <br><br>

	 <input type="email" name="email" placeholder="Enter Your email">
	  <br><br>
	 <input type="submit" value="Save Patient">
</form>
</fieldset>
</body>
</html>

<?php
 //THIS IS THE LOGIC:Provide the constructor with form values

    if (empty($_POST)) {
	exit();//Quit executing php code until,form button is ....//clicked
}

$object=new Patient($_POST['surname'],
                    $_POST['fname'],
                    $_POST['lname'],
                    $_POST['phone'],
                    $_POST['residence'],
                    $_POST['patient_id'],
                    $_POST['gender'],
                    $_POST['email']);
$object->save(); #trigger save function





class Patient{
	function __construct($surname,$fname,$lname,$phone,$residence,$patient_id,$gender,$email){
   $this->surname=$surname;
   $this->fname=$fname;
   $this->lname=$lname;
   $this->phone=$phone;
   $this->residence=$residence;
   $this->patient_id=$patient_id;
   $this->gender=$gender;
   $this->email=$email;
	}//end of constructor
	 function save() {
		$conn=mysqli_connect("localhost","root","","clinic_db");
		$response= mysqli_query($conn,"INSERT INTO `table_patients`(`surname`, `fname`, `lname`, `phone`, `residence`, `patient_id`, `gender`, `email`) VALUES ('$this->surname','$this->fname','$this->lname','$this->phone','$this->residence','$this->patient_id','$this->gender','$this->email')");
  if($response==true) {
		echo "sucessfully saved Record";
  }
	else {
		echo " Record failed check your details";
	}

}
}//end of class

?>