<?php include 'navbarR.php' ?>
<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "registration";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Database Connection Error!!");
}
//initializing variables
$FromDate = "";
$ToDate = "";
$id = "";
$array = array();
$error = "";
$message = "";
$mess = "";
$Countt = "";
$Count = "";
if(isset($_POST['Submit'])){
    $FromDate = $_POST['FromDate'];
    $ToDate = $_POST['ToDate'];
    $id = $_SESSION['id']; 

    //form validation
    if(empty($FromDate)){array_push($array,"From Date is Required*"); }
    if(empty($ToDate)){array_push($array,"To Date is Required*"); }
    $error = implode("",$array);
    if(count($array) == 0){
        echo "<div class = 'tableone'>";
        $sql = "SELECT * FROM incomefromgoods where id= '$id' AND EntryDate >= '$FromDate' AND EntryDate <= '$ToDate'";
        if($result = $conn->query($sql)){
            if($result->num_rows >0){
                echo "<p>Table of Income from Goods</p>";
                echo "<table border = '1'>";
                echo "<tr>";
                echo "<th>no_of_item</th>";
                echo "<th>cost_per_item</th>";
                echo "<th>TotalAmount</th>";
                echo "<th>Remarks</th>";
                echo "<th>Update</th>";
                echo "<th>Delete</th>";
                echo "</tr>";
                while($row = $result->fetch_assoc()){
                    $Countt= $row['Countt'];
                    echo "<tr>";
                    echo "<td>" .$row['no_of_item']. "</td>";
                    echo "<td>" .$row['cost_per_item']. "</td>";
                    echo "<td>" .$row['TotalAmount']. "</td>";
                    echo "<td>" .$row['Remarks']. "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-primary'><a href='update3.php?Countt=$Countt' class='white'>Update</a></button>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-danger'><a href='delete3.php?Countt=$Countt' onclick='return checkdel()' class='white'>Delete</button>";
                    echo "<script>function checkdel(){return confirm('Are you sure you want to delete?');}</script>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $result->free();
                $sum = "SELECT SUM(TotalAmount) FROM incomefromgoods where id='$id' AND EntryDate >= '$FromDate' AND EntryDate <= '$ToDate'";
                $que = mysqli_query($conn,$sum);
                $res = mysqli_fetch_array($que);
                $summ = implode (array_unique($res));
                echo "<p>Total Amount for IncomeFromGoods:$summ</p>";
            }else{
                $mess = "No records were found found for IncomeFromGoods.";
            }
        }
        $s = "SELECT *FROM incomefromservices where id='$id' AND EntryDate >= '$FromDate' AND EntryDate <= '$ToDate'";
        if($results = $conn->query($s)){
            if($results->num_rows > 0){
                echo "<table border='1'>";
                echo "<p>Table for Income From Services</p>";
                echo "<tr>";
                    echo "<th>Remarks</th>";
                    echo "<th>Amount</th>";
                    echo "<th>Update</th>";
                    echo "<th>Delete</th>";
                echo "</tr>";
                while($row = $results->fetch_assoc()){
                    $Count= $row['Countt'];
                    echo "<tr>";
                    echo "<td>" .$row['Remarks']. "</td>";
                    echo "<td>" .$row['Amount']. "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-primary'><a href='update4.php?Countt=$Count' class='white'>Update</a></button>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-danger'><a href='delete4.php?Countt=$Count' class='white' onclick='return checkdelete()'>Delete</a></button>";
                    echo "<script>function checkdelete(){return confirm('Are you sure you want to delete?');}</script>";
                    echo "</td>";
                    echo"</tr>";
                }
                echo "</table>";
                $results->free();
                $add="SELECT SUM(Amount)FROM incomefromservices where id='$id' AND EntryDate >= '$FromDate' AND EntryDate <= '$ToDate'";
                $qu = mysqli_query($conn,$add);
                $re = mysqli_fetch_array($qu);
                $addd = implode(array_unique($re));
                echo "<p>Total Amount For IncomeFromServices:$addd</p>";
                $Final=$summ+$addd;
                echo "<p>Total Income Amount:$Final</p>";
            }else{
                $message = "No records were found for incomefromservices.";
            }
        }
        echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage Income</title>
        <link rel="stylesheet" type="text/css" href="manageincome.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <h1>Manage Income</h1>
                <form method = "post" action = "manageincome.php">
                    <p><?php echo $error; ?></p>
                    <p><?php echo $message; ?></p>
                    <p><?php echo $mess; ?></p>
                    <p>From Date:</p>
                    <input type="date" name="FromDate" placeholder="Select Date" class="FromDate">
                    <p>To Date:</p>
                    <input type="date" name="ToDate" placeholder="Select Date" class="ToDate">
                    <input type="submit" name="Submit" value="Submit" class="Submit">
                </form>
            </div>
        </div>
    </body>
</html>