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
	<title>Add Patient info </title>

</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<body>
	<h1> Add Patient info </h1>
	<a href="addpatient.php">Add patient</a>
		<a href="doctors.php">Add Doctor</a>
		<a href="psearch.php"> Search Patient</a>
		<a href="dsearch.php"> Search Doctor</a>
	

	<fieldset>
<form action="" method="POST">
 <input type="text" name="patient_id" placeholder="Enter Your Patient identity no">
  <br><br>
	 <input type="text" name="weight" placeholder="Enter Your weight">
	 <br><br>
	 <input type="text" name="height" placeholder="Enter Your height">
	  <br><br>
	 <input type="text" name="temperature" placeholder="temperature">
	  <br><br>
	 <input type="text" name="description" placeholder="Enter Your description">
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

$object=new Patient_info($_POST['patient_id'],
                    $_POST['weight'],
                    $_POST['height'],
                    $_POST['temperature'],
                    $_POST['description']);
                   
$object->save(); #trigger save function





class Patient_info{
	function __construct($patient_id,$weight,$height,$temperature,$description){
  $this->patient_id=$patient_id;
   $this->weight=$weight;
   $this->height=$height;
   $this->temperature=$temperature;
   $this->description=$description;

	}//end of constructor
	 function save() {
		$conn=mysqli_connect("localhost","root","","clinic_db");
		$response= mysqli_query($conn,"INSERT INTO `table_patients_info`(`patient_id`, `weight`, `height`, `temparature`, `description`) VALUES ('$this->patient_id','$this->weight','$this->height','$this->temperature','$this->description')");
  if($response==true) {
		echo "sucessfully saved Record";
  }
	else {
		echo " Record failed check your details";
	}

}
}//end of class

?>