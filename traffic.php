
<!DOCTYPE html>
<html>
<head>
	<title>TRAFFIC UPDATE </title>

</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<body>
	<center>
	<h1> TRAFFIC UPDATE</h1>

	<fieldset>

<form action="" method="POST">
    <input type="text" name="roadname" placeholder="road">
  <br><br>
    <textarea name="info" placeholder="info"></textarea>
     <br><br>

    <input type="SUBMIT" name="SUBMIT"  placeholder="POST">
   </form>
   </fieldset>
   </center>
</body>
</html>
<?php

$conn=mysqli_connect("localhost","root","","clinic_db");
$response1=mysqli_query($conn,"select * from table_traffic1 order by time DESC");
     while($row=mysqli_fetch_array($response1)){
     	echo "<i> $row[0]</i>";
     	echo "<p> $row[1]</p>";
     	echo "<b> $row[2]</b>";
     	echo "<hr>";

     }//end while


 //THIS IS THE LOGIC:Provide the constructor with form values

    if (empty($_POST)) {
	exit();//Quit executing php code until,form button is ....//clicked
}

$object=new Road($_POST['roadname'],
                    $_POST['info']);
$object->save(); #trigger save function





class Road{
	function __construct($road,$info){
   $this->road=$road;
   $this->info=$info;
   
	}//end of constructor
	 function save() {
		//connect to your database
		$conn=mysqli_connect("localhost","root","","clinic_db");
		//save to table
		$response= mysqli_query($conn,"INSERT INTO `table_traffic1`(`road`, `info`) VALUES ('$this->road','$this->info')");
  //testing the response
if($response==true) {
		echo "successfully saved Record <br/>";
		header("location:addtraffic.php");
  }
	else {
		echo "Record failed.Check Your Details";
	}

}
}//end of class

?>
