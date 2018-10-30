
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




<?php
//receive the patient_id
if (empty($_GET)) {
	header ("location: psearch.php"); //redirect user
}
//Receive the patient_id
$patient_id=$_GET['patient_id'];
  $conn=mysqli_connect("localhost","root","","clinic_db");
  $response=mysqli_query($conn,"DELETE FROM table_patients where patient_id='$patient_id'");
  if ($response==true){
  	echo "$patient_id had been removed";
  echo "<a href='psearch.php'>Back </a>";

}
else {
  echo "$patient_id has been removed";
  echo "<a href='psearch.php'>Back </a>";
}





?>