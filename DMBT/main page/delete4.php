<?php
$servername="localhost:3308";
$username="root";
$password="";
$dbname="registration";
$con=mysqli_connect($servername,$username,$password,$dbname);
if($con->connect_error){
    die("Database Connection Failed!");
}

$Count = $_GET['Countt'];

$q = " DELETE FROM `incomefromservices` WHERE Countt = $Count ";
$data = mysqli_query($con, $q);
if($data){
    echo "<script>alert('Record deleted from the database')</script>";
}
else{
    echo "<script>alert('Failed to delete data from the database')</script>";
}
echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=http://localhost/DMBT/main%20page/manageincome.php'>";
//header('location:manageincome.php');

?>