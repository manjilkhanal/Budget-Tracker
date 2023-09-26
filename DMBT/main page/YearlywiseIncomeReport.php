<?php include 'navbarR.php' ?>
<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "registration";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Database Connection Failed!");
}
//initializing variables
$id = "";
$FromDate = "";
$ToDate = "";
$error = "";
$array = array();
$message = "";
$mess = "";
if(isset($_POST['Submit'])){
    $id = $_SESSION['id'];
    $FromDate = $_POST['FromDate'];
    $ToDate = $_POST['ToDate'];
    //form validation
    if(empty($FromDate)){array_push($array,"From Date is Required*"); }
    if(empty($ToDate)){array_push($array,"To Date is Required"); }
    $error = implode("",$array);
    if(count($array) == 0){
        echo "<div class = 'tableone' id = 'tableone'>";
        $sql = "SELECT * FROM incomefromgoods where id= '$id' AND EntryDate >= '$FromDate' AND EntryDate <= '$ToDate'";
        if($result = $conn->query($sql)){
            if($result->num_rows >0){
                echo "<button id='cmd' onClick = 'makePdf()'>generate PDF</button>";
                echo "<p>Table of Income from Goods</p>";
                echo "<table border = '1'>";
                echo "<tr>";
                echo "<th>no_of_item</th>";
                echo "<th>cost_per_item</th>";
                echo "<th>TotalAmount</th>";
                echo "<th>Remarks</th>";
                echo "</tr>";
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" .$row['no_of_item']. "</td>";
                    echo "<td>" .$row['cost_per_item']. "</td>";
                    echo "<td>" .$row['TotalAmount']. "</td>";
                    echo "<td>" .$row['Remarks']. "</td>";
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
                echo "</tr>";
                while($row = $results->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" .$row['Remarks']. "</td>";
                    echo "<td>" .$row['Amount']. "</td>";
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
        <title>Yearlywise Income Report</title>
        <link rel="stylesheet" type="text/css" href="YearlywiseIncomeReport.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <h1>Yearlywise Income Report</h1>
                <form method = "post" action = "YearlywiseIncomeReport.php">
                    <p><?php echo $error; ?></p>
                    <p><?php echo $message; ?></p>
                    <p><?php echo $mess; ?></p>
                    <p>From Date:</p>
                    <input type="date" name="FromDate" placeholder="Select Date" id="FromDate" class="FromDate">
                    <p>To Date:</p>
                    <input type="date" name="ToDate" placeholder="Select Date" class="ToDate" id="ToDate" readonly>
                    <input type="submit" name="Submit" value="Submit" class="Submit">
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

    <script>
        var date_input = document.getElementById('FromDate');
    date_input.onchange = function(){
        let toValue = new Date(this.value);
        console.log(toValue.getFullYear(), this.value );
        toValue.setYear(toValue.getFullYear() + 1);
        //console.log(toValue)
        document.getElementById('ToDate').value = toValue.toISOString().substring(0,10)
    }


    var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

function makePdf () {
    console.log(document.getElementById('tableone').innerHtml);
    doc.fromHTML(document.getElementById('tableone')).innerHtml, 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    };
    doc.save('sample-file.pdf');
};
        </script>

</html>