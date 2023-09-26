<?php
$servername="localhost:3308";
$username="root";
$password="";
//Create connection 
$conn= mysqli_connect($servername,$username,$password);
// Check connection
if(!$conn){
    die("Connection failed:" .mysqli_connect_error());
}
echo "Connected successfully";
// Create database
$sql="CREATE DATABASE registration";
$result =mysqli_query($conn,$sql);
if($result){
    echo "Database created successfully";
}else{
    echo "Error creating database:". mysqli_error($conn);
}
mysqli_close($conn);
?>
<?php
    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname ="registration";

    // Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error){
        die("Connection failed:". $conn->connect_error);
    }
    echo "connected successfully";
    ?>
<?php
$servername ="localhost:3308";
$username ="root";
$password ="";
$dbname ="registration";
// sql to create table
$sql="CREATE TABLE users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username varchar(255) NOT NULL,
    email varchar(50) NOT NULL,
    mobile BIGINT NOT NULL,
    Passcode varchar(50) NOT NULL,
    Confirmpasscode VARCHAR(50) NOT NULL,
    RegistrationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
    if ($conn->query($sql) ===TRUE){
        echo "Table Users created successfully";
    }else{
        echo "Error creating table:" .$conn->error;
    }
    $conn->close();
    ?>
    