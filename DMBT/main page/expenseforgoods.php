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
    //$Amount = $_POST['ItemsNumber']*$_POST['ItemsCost'];
    $Remarks = $_POST['Remarks'];
    $id = $_SESSION['id'];
    //$Amount= $no * $Cost;
    //form validation
    if(empty($no)){array_push($array,"No. of items is required"); }
    if(empty($Cost)){array_push($array,"Cost per item is required"); }
    //if(empty($Amount)){array_push($array,"Total amount is required"); }
    if(empty($Remarks)){array_push($array,"Remarks is required"); }
    $error = implode("",$array);
    if(count($array) == 0){
        $sql="INSERT INTO expenseforgoods (id,no_of_item,cost_per_item,TotalAmount,Remarks) values ('$id','$no','$Cost','$Amount','$Remarks')";
        mysqli_query($conn,$sql);
        $message = "Successfully Recorded";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expense For Goods</title>
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
                <h1>Expense For Goods</h1>
                <form method = "post" action = "expenseforgoods.php">
                    <p><?php echo $error; ?></p>
                    <p><?php echo $message; ?></p>
                    <p>No. of item</p>
                    <input type="number" id ="ItemsNumber" name="ItemsNumber" placeholder="Enter no. of items" class="ItemsNumber">
                    <p>Cost per Item</p>
                    <input type="number" id="ItemsCost" name="ItemsCost" placeholder="Enter Cost Per Item" class="ItemsCost">
                    <p>Total Amount</p>
                    <input type="number" id="TotalAmount" name="TotalAmount" placeholder="Total Amount" class="TotalAmount" value="" readonly>
                    <p>Remarks</p>
                    <input type="text" name="Remarks" placeholder="Enter name of goods" class="Remarks">
                    <input type="submit" name="Submit" value="Submit" class="Submit">
                </form>
            </div>
        </div>
    </body>
</html>