<?php
session_start();
if(isset($_SESSION['username'])) {

	//PULL IT OUT

	$username=$_SESSION['username'];
	echo "Welcome :$username";
	echo "<a href='logout.php'>logout </a>";
}
 else if (!isset($_SESSION['username'])) {
 	header("location :login.php");
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
	<title>Add Doctors </title>

</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<body>
	<h1> Add DOCTORS </h1>
	<a href="addpatient.php">Add patient</a>
	<a href="psearch.php"> Search Patient</a>
	<a href="dsearch.php"> Search Doctor</a>
	<a href="checkup.php">patient CheckUp</a>

	<fieldset>
<form action="" method="POST">
 <input type="text" name="Exp" placeholder="Enter Your Exp">
  <br><br>
	 <input type="integer" name="doctor_id" placeholder="Enter Your doctor identity number">
	 <br><br>
	 <input type="text" name="surname" placeholder="Enter Your surname">
	  <br><br>
	 <input type="text" name="others" placeholder="others">
	  <br><br>
	   <input type="text" name="dept" placeholder="dept">
	  <br><br>
	 <input type="text" name="proffession" placeholder="Enter Your proffession">
	  <br><br>
	  <label> Select Gender </label>
	 <input type="radio" name="gender">Male
	 <input type="radio" name="gender">Female
	     <br><br>
	 <input type="submit" value="Save Doctors">
</form>
</fieldset>
</body>
</html>

<?php
 //THIS IS THE LOGIC:Provide the constructor with form values

    if (empty($_POST)) {
	exit();//Quit executing php code until,form button is ....//clicked
}

$object=new Doctor($_POST['Exp'],
                    $_POST['doctor_id'],
                    $_POST['surname'],
                    $_POST['others'],
                    $_POST['dept'],
                    $_POST['proffession'],
                    $_POST['gender']);
                   
$object->save(); #trigger save function





class Doctor{
	function __construct($Exp,$doctor_id,$surname,$others,$dept,$profession,$gender){
  $this->Exp=$Exp;
   $this->doctor_id=$doctor_id;
   $this->surname=$surname;
   $this->others=$others;
   $this->dept=$dept;
   $this->proffession=$proffession;
   $this->gender=$gender;

	}//end of constructor
	 function save() {
		$conn=mysqli_connect("localhost","root","","clinic_db");
		$response= mysqli_query($conn,"INSERT INTO `table_doctors(`Exp`, `doctor_id`, `surname`, `others`, `dept`,`proffession`,`gender`) VALUES ('$this->Exp','$this->doctor_id','$this->surname','$this->others','$this->dept','$this->proffession','$this->gender')");
  if($response==true) {
		echo "sucessfully saved Record";
  }
	else {
		echo " Record failed check your details";
	}

}
}//end of class

?>