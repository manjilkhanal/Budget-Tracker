<?php include 'navbarR.php' ?>
<?php
//session_start();
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "registration";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Database Connection Error");
}
// initializing variables
$A="";
$id = "";
$username = "";
$remarks = "";
$amount = "";
$array = array();
$error = "";
if (isset($_POST['Submit'])) {
    //receive all input values from the form
    //$remarks = mysql_real_escape_string($conn, $_POST['Remarks']);
    //$amount = mysql_real_escape_string($conn, $_POST['Amount']);
$remarks = $_POST['Remarks'];
$amount = $_POST['Amount'];
$id = $_SESSION['id'];
//$username = $_SESSION['username'];
//form validation
if (empty($remarks)){ array_push($array,"Remarks is required*"); }
if (empty($amount)){ array_push($array,"Amount is required*"); }
$error= implode("",$array);
if(count($array) == 0){
    $sql = "INSERT INTO expenseservices (id,Remarks,Amount) values ('$id','$remarks','$amount')";
    mysqli_query($conn,$sql);
    $A="Successfully Recorded";
}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expense For Services</title>
        <link rel="stylesheet" type="text/css" href="expenseforservices.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <h1>Expense For Services</h1>
                <form method = "post" action = "expenseforservices.php">
                   <p> <?php echo $error; ?></p>
                   <p> <?php echo $A; ?></p>
                <p>Remarks</p>
                    <input type="text" name="Remarks" placeholder="Enter name of services" class="Remarks">
                    <p>Amount</p>
                    <input type="number" name="Amount" placeholder="Enter Amount" class="Amount">
                    <input type="submit" name="Submit" value="Submit" class="Submit">
                </form>
            </div>
        </div>
    </body>
</html>
