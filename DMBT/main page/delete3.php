<?php
$servername="localhost:3308";
$username="root";
$password="";
$dbname="registration";
$con=mysqli_connect($servername,$username,$password,$dbname);
if($con->connect_error){
    die("Database Connection Failed!");
}

$Countt = $_GET['Countt'];

$q = " DELETE FROM `incomefromgoods` WHERE Countt = $Countt ";
$data = mysqli_query($con, $q);
if($data){
    echo "<script>alert('Record deleted from the database')</script>";
}else{
    echo "<script>alert('Failed to delete data from database')</script>";
}
echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=http://localhost/DMBT/main%20page/manageincome.php'>";

//header('location:manageincome.php');

?>