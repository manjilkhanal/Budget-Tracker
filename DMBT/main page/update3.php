<?php include 'navbarR.php' ?>
<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "registration";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Database Connection Error");
}
//initializing variables
$id = "";
$no = "";
$Cost = "";
$Amount = "";
$Remarks = "";
$array = array();
$error = "";
$message = "";
if(isset($_POST['Submit'])){
    $no = $_POST['ItemsNumber'];
    $Cost = $_POST['ItemsCost'];
    $Amount = $_POST['TotalAmount'];
    $Remarks = $_POST['Remarks'];
    $id = $_SESSION['id'];
    $Countt = $_POST['Countt'];
    echo $Countt;
    //form validation
    if(empty($no)){array_push($array,"No. of items is required"); }
    if(empty($Cost)){array_push($array,"Cost per item is required"); }
    //if(empty($Amount)){array_push($array,"Total amount is required"); }
    if(empty($Remarks)){array_push($array,"Remarks is required"); }
    $error = implode("",$array);
    if(count($array) == 0){
        $sql="UPDATE `incomefromgoods` set no_of_item=$no,cost_per_item=$Cost,TotalAmount=$Amount,Remarks='$Remarks' where Countt = $Countt";
        mysqli_query($conn,$sql);
        $message = "Successfully Recorded";
        header('location:manageincome.php');
    }
}
$qq = "select * from `incomefromgoods` where Countt=".$_GET['Countt'];
// echo $qq;die;
$query = mysqli_query($conn,$qq);
$ress = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Income Form Goods</title>
        <link rel="stylesheet" type="text/css" href="expenseforgoods.css">
    </head>
    <body>
    <script src="jquery-3.5.0.min.js"></script>
	<script>
		$(document).ready(function(){
    	// Get value on keyup funtion
    	$("#ItemsNumber, #ItemsCost").keyup(function(){

    	var Amount=0;    	
    	var no = Number($("#ItemsNumber").val());
    	var Cost = Number($("#ItemsCost").val());
    	var Amount=no * Cost;  

    	$('#TotalAmount').val(Amount);

    });
});
</script>
        <div class="container">
            <div class="loginbox">
                <h1>Income From Goods</h1>
                <form method="post" action="update3.php">
                    <p><?php echo $error; ?></p>
                    <p><?php echo $message; ?></p>
                    <input type="hidden" name="Countt" value="<?php echo $_GET['Countt']; ?>" >
                    <p>No. of item</p>
                    <input type="number" name="ItemsNumber" id="ItemsNumber" placeholder="Enter no. of items" class="ItemsNumber" value="<?php echo $ress['no_of_item']; ?>">
                    <p>Cost per Item</p>
                    <input type="number" name="ItemsCost" id="ItemsCost" placeholder="Enter Cost Per Item" class="ItemsCost" value="<?php echo $ress['cost_per_item']; ?>" >
                    <p>Total Amount</p>
                    <input type="number" name="TotalAmount" id= "TotalAmount" placeholder="Total Amount" class="TotalAmount" value="<?php echo $ress['TotalAmount']; ?>" readonly>
                    <p>Remarks</p>
                    <input type="text" name="Remarks" placeholder="Enter name of goods" class="Remarks" value="<?php echo $ress['Remarks']; ?>">
                    <input type="submit" name="Submit" value="Submit" class="Submit">
                </form>
            </div>
        </div>
    </body>
</html>