<?php include 'navbarR.php' ?>
<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "registration";

$conn= mysqli_connect($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Database Connection Error");
}
// initializing variables
$A= "";
$id = "";
$remarks = "";
$amount = "";
$array = array();
$error = "";
if(isset($_POST['Submit'])){
    //receive all input values from the form
    $remarks = $_POST['Remarks'];
    $amount = $_POST['Amount'];
    $id = $_SESSION['id'];
    $Count = $_POST['Countt'];
    echo $Count;
    //form validation
    if(empty($remarks)){ array_push($array,"Remarks is required*"); }
    if(empty($amount)){ array_push($array,"Amount is required*"); }
    $error = implode("",$array);
    if(count($array) == 0){
        $sql = "UPDATE `incomefromservices` set Remarks='$remarks',Amount=$amount  where Countt = $Count";
        mysqli_query($conn,$sql);
        $A="Successfully recorded";
        header('location:manageincome.php');
    }
}
$qq = "select * from `incomefromservices` where Countt=".$_GET['Countt'];
// echo $qq;die;
$query = mysqli_query($conn,$qq);
$ress = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Income From Services</title>
        <link rel="stylesheet" type="text/css" href="incomefromservices.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <h1>Income From Services</h1>
                <form method = "post" action = "update4.php">
                <p><?php echo $error; ?>
                <p><?php echo $A; ?>
                <input type="hidden" name="Countt" value="<?php echo $_GET['Countt']; ?>" >
                <p>Remarks</p>
                    <input type="text" name="Remarks" placeholder="Enter name of services" class="Remarks" value="<?php echo $ress['Remarks']; ?>">
                    <p>Amount</p>
                    <input type="number" name="Amount" placeholder="Enter Amount" class="Amount" value="<?php echo $ress['Amount']; ?>">
                    <input type="submit" name="Submit" value="Submit" class="Submit">
                </form>
            </div>
        </div>
    </body>
</html>