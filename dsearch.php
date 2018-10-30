
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
	<title>Search</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<center>
		<h1>Clinic Management</h1>
		<p>better health Care</p>
	
		<a href="addpatient.php">Add patient</a>
        <a href="doctors.php">Add Doctor</a>
        <a href="psearch.php"> Search Patient</a>
       
        <a href="checkup.php">patient CheckUp</a>
>

    </center>

<h1>Search DOCTOR </h1>


<fieldset>
	<legend>Search Doctors</legend>

	<form action="" method="POST">
		<input type="text" name="doctor_id"
		placeholder="Enter doctor_id">
		<br>
		<br>         

        <input type="submit" value="Search doctor">
	</form>
	</fieldset>
</body>
</html>


<?php 
    if(empty($_POST)){
    	exit();//quit if button is not clicked
    }

$object=new DoctorSearch($_POST['doctor_id']);
$object->search();
class DoctorSearch{
	function __construct($doctor_id){
       $this->doctor_id=$doctor_id;
	}//end

   function search(){
   	       //connect to your database
		$conn =mysqli_connect("localhost","root", "","clinic_db");
		$response=mysqli_query($conn, "SELECT * FROM table_doctors Where doctor_id='$this->doctor_id'");

		//count your response
		if (mysqli_num_rows($response)==0) {

			echo "No doctor Found ! Try again";
			exit();
		}
		

        else{
        	//get all colms for the 1st row found
        	
        	echo "<table border=1 width= 100% class='table table-dark'>";
        	while($colm = mysqli_fetch_array($response))
        	{
            echo "<tr>";
        	echo "<td>$colm[0]  </td>";
        	echo "<td> $colm[1] </td>";
        	echo "<td> $colm[2] </td>";
        	echo "<td> $colm[3] </td>";
        	echo "<td> $colm[4] </td>";
        	echo "<td> $colm[5] </td>";
        	echo "<td> $colm[6] </td>";
        	
        	echo "<tr>";

        }//End while
            echo "</table>";

        }//end else





   }//End Function



}//end  class constructor





 ?>