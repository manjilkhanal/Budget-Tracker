<?php
session_start();
if (!isset($_SESSION['id'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: ../registration/login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['id']);
  header("location: ../registration/login.php");
}
?>
<?php
$conn = mysqli_connect("localhost:3308", "root", "", "registration") or die("Connection Error: " . mysqli_error($conn));
$q = "select * from users where username='".$_SESSION['username']."' OR id='".$_SESSION['id']."'";

$query = mysqli_query($conn,$q);

?>
<!DOCTYPE html>
<head>
    <title>Budget Tracker</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
<body>
<div class="sidenav">
  <table class="nav">
    <tr>
<th><img src="avatar.png" class="nav-avatar" style=""></th>
<th><div class="app">
      <div class="status"></div>
    </div></th>
</tr>
</table>
<script src="app.js"></script>
<div class="Name">
<center><strong><?php
  $num = mysqli_num_rows($query);
  if($num > 0){
    while($row = mysqli_fetch_assoc($query)){
      $_SESSION['id']= $row['id'];
      echo $row['username'];
    }
  }
?></strong></center>
</div>
  <div class="navbar">  
  <a href="navbar.php">Dashboard<i class="fas fa-home"></i></a>

    <button class="dropdown-btn">Expenses
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
    <button class="dropdown-btn">Add Expenses
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="expenseforservices.php">ExpensesForServices</a>
      <a href="expenseforgoods.php">ExpensesForGoods</a>
    </div>
        <a href="manageexpenses.php">Manage Expenses</a>
        </div>
    <button class="dropdown-btn">Expenses Report
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="DaywiseExpenseReport.php">Daywise Report</a>
        <a href="MonthlywiseExpenseReport.php">Monthlywise Report</a>
        <a href="YearlywiseExpenseReport.php">Yearlywise Report</a>
        </div>
    <button class="dropdown-btn">Income 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <button class="dropdown-btn">Add Income
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
    <a href="incomefromservices.php">IncomeFromServices</a>
    <a href="incomefromgoods.php">IncomeFromGoods</a>
    </div>
        <a href="manageincome.php">Manage Income</a>
        </div>
    <button class="dropdown-btn">Income Report 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="DaywiseIncomeReport.php">Daywise Report</a>
        <a href="MonthlywiseIncomeReport.php">Monthlywise Report</a>
        <a href="YearlywiseIncomeReport.php">Yearlywise Report</a>
        </div>
      <a href="profile.php">Profile<i class="fas fa-user"></i></a>
      <a href="Changepassword.php">Change Password<i class="fas fa-unlock"></i></a>
      <a href="../registration/logout.php">Logout<i class="fas fa-sign-out-alt"></i></a>
    </div> 
</div>
//grid layout
<div class="grid-container">
        <div class="container1">Daywise Expense:<?php 
        $startDate = date('Y-m-d').' 00:00:00';
        $endDate = date('Y-m-d').' 23:59:59';
        $add1 = "select SUM(TotalAmount) as sum from `expenseforgoods` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $add2 = "select SUM(Amount) as sum from `expenseservices` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $qu = mysqli_query($conn,$add1);
        $qa = mysqli_query($conn,$add2);
        $re = mysqli_fetch_array($qu);
        $ra = mysqli_fetch_array($qa);
        $Daywise = $re['sum']+$ra['sum'];
        echo"<br>";
        echo $Daywise;
        ?></div>
        <div class="container2">Monthly Expense:<?php
        $startDate = date('Y-m-01').' 00:00:00';
        $endDate = date('Y-m-31').' 23:59:59';
        $add3 = "select SUM(TotalAmount) as sum from `expenseforgoods` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $add4 = "select SUM(Amount) as sum from `expenseservices` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $quu = mysqli_query($conn,$add3);
        $qaa = mysqli_query($conn,$add4);
        $ree = mysqli_fetch_array($quu);
        $raa = mysqli_fetch_array($qaa);
        $MonthlywiseExp = $ree['sum']+$raa['sum'];
        echo"<br>";
        echo $MonthlywiseExp;
        ?>
        </div>
        <div class="container3">Yearly's Expense:
        <?php
        $startDate = date('01-01-y ');
        $endDate = date('31-12-y ');
        $add3 = "select SUM(TotalAmount) as sum from `expenseforgoods` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $add4 = "select SUM(Amount) as sum from `expenseservices` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $quu = mysqli_query($conn,$add3);
        $qaa = mysqli_query($conn,$add4);
        $ree = mysqli_fetch_array($quu);
        $raa = mysqli_fetch_array($qaa);
        $YearlyExp = $ree['sum']+$raa['sum'];
        echo"<br>";
        echo $YearlyExp;
        ?>
        </div>
        <div class="container4">Expense Till Now:
        <?php 
        $add1 = "select SUM(TotalAmount) as sum from `expenseforgoods` where  id='".$_SESSION['id']."'";
        $add2 = "select SUM(Amount) as sum from `expenseservices` where  id='".$_SESSION['id']."'";
        $qu = mysqli_query($conn,$add1);
        $qa = mysqli_query($conn,$add2);
        $re = mysqli_fetch_array($qu);
        $ra = mysqli_fetch_array($qa);
        $TillExpense = $re['sum']+$ra['sum'];
        echo"<br>";
        echo $TillExpense;
        ?>
        </div>
        <div class="container5">Daywise Income:
        <?php 
        $startDate = date('Y-m-d').' 00:00:00';
        $endDate = date('Y-m-d').' 23:59:59';
        $add1 = "select SUM(TotalAmount) as sum from `incomefromgoods` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $add2 = "select SUM(Amount) as sum from `incomefromservices` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $qu = mysqli_query($conn,$add1);
        $qa = mysqli_query($conn,$add2);
        $re = mysqli_fetch_array($qu);
        $ra = mysqli_fetch_array($qa);
        $DayIncome = $re['sum']+$ra['sum'];
        echo"<br>";
        echo $DayIncome;
        ?>
        </div>
        <div class="container6">Monthly Income:
        <?php
        $startDate = date('Y-m-01').' 00:00:00';
        $endDate = date('Y-m-31').' 23:59:59';
        $add5 = "select SUM(TotalAmount) as sum from `incomefromgoods` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $add6 = "select SUM(Amount) as sum from `incomefromservices` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
        $quuu = mysqli_query($conn,$add5);
        $qaaa = mysqli_query($conn,$add6);
        $reee = mysqli_fetch_array($quuu);
        $raaa = mysqli_fetch_array($qaaa);
        $MonthlywiseIncome = $reee['sum']+$raaa['sum'];
        echo"<br>";
        echo $MonthlywiseIncome;
        ?>
        </div>
        <div class="container7">Yearly Income:
          <?php
           $startDate = date('01-01-y');
           $endDate = date('31-12-y');
           $add7 = "select SUM(TotalAmount) as sum from `incomefromgoods` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
           $add8 = "select SUM(Amount) as sum from `incomefromservices` where EntryDate>='".$startDate."' and EntryDate<='".$endDate."' and id='".$_SESSION['id']."'";
           $qy = mysqli_query($conn,$add7);
           $qyy = mysqli_query($conn,$add8);
           $se = mysqli_fetch_array($qy);
           $see = mysqli_fetch_array($qyy);
           $YearlyIncome = $se['sum']+$see['sum'];
           echo "<br>";
           echo $YearlyIncome;
           ?>
        </div>
        <div class="container8">Income Till Now:
        <?php 
        $add1 = "select SUM(TotalAmount) as sum from `incomefromgoods` where  id='".$_SESSION['id']."'";
        $add2 = "select SUM(Amount) as sum from `incomefromservices` where  id='".$_SESSION['id']."'";
        $qu = mysqli_query($conn,$add1);
        $qa = mysqli_query($conn,$add2);
        $re = mysqli_fetch_array($qu);
        $ra = mysqli_fetch_array($qa);
        $TillIncome = $re['sum']+$ra['sum'];
        echo"<br>";
        echo $TillIncome;
        ?>
        </div>
<div class="container9">Daywise Net Profit/Loss:
  <?php 
  $Dayprofit= $DayIncome - $Daywise;
  echo "<br>";
  echo $Dayprofit;
  ?>
</div>
<div class="container10">Monthlywise Net Profit/Loss:
  <?php
  $MonthlywiseProfit = $MonthlywiseIncome- $MonthlywiseExp;
  echo "<br>";
  echo $MonthlywiseProfit;
  ?>
</div>
<div class="container11">Yearlywise Net Profit/Loss:
  <?php 
  $YearlyProfit = $YearlyIncome - $YearlyExp;
  echo "<br>";
  echo $YearlyProfit;
  ?>
</div>
<div class="container12">Net Profit/Loss Till Now:
<?php 
  $Tillprofit= $TillIncome - $TillExpense;
  echo "<br>";
  echo $Tillprofit;
  ?>
</div>        
<div class="container13">
Yearly Expenses Prediction for Next Year displayed on Monthly basis:
<?php
// to predict the expenses for next year using linear regression and fetching data of past year expenses
// Connect to the database
$conn = mysqli_connect("localhost:3308", "root", "", "registration");

// Get the expenses from the past year
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-1 year', strtotime($endDate)));
$query = "SELECT EntryDate, SUM(TotalAmount + Amount) as TotalExpense FROM (
          SELECT EntryDate, TotalAmount, 0 as Amount FROM `expenseforgoods` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
          UNION ALL
          SELECT EntryDate, 0 as TotalAmount, Amount FROM `expenseservices` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
         ) AS Expenses
         GROUP BY EntryDate
         ORDER BY EntryDate ASC";
$result = mysqli_query($conn, $query);

// Store the expenses in arrays
$x = array(); // dates
$y = array(); // total expenses
while ($row = mysqli_fetch_array($result)) {
    $x[] = strtotime($row['EntryDate']);
    $y[] = $row['TotalExpense'];
    //echo "Date: {$row['EntryDate']}, Income: {$row['TotalExpense']}<br>";
}

// Calculate the slope and intercept using linear regression
$n = count($x);
$sum_x = array_sum($x);
$sum_y = array_sum($y);
$sum_xy = 0;
$sum_x2 = 0;
for ($i = 0; $i < $n; $i++) {
    $sum_xy += $x[$i] * $y[$i];
    $sum_x2 += $x[$i] * $x[$i];
}
if ($n * $sum_x2 - $sum_x * $sum_x != 0) {
    $slope = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x * $sum_x);
    $intercept = ($sum_y - $slope * $sum_x) / $n;
} else {
    $slope = 0;
    $intercept = 0;

}
//echo "Sum X: $sum_x, Sum Y: $sum_y, Sum XY: $sum_xy, Sum X^2: $sum_x2<br>";


// Predict the expenses for the next year
$next_x = array();
$next_y = array();
for ($i = 1; $i <= 12; $i++) {
    $date = date('Y-m-d', strtotime("+{$i} month"));
    $next_x[] = strtotime($date);
    $next_y[] = $slope * strtotime($date) + $intercept;
}
//echo "Slope: $slope, Intercept: $intercept<br>";


// Display the predicted expenses
//echo "Predicted expenses for next year on the basis of past expenses:";
echo "<table>";
echo "<tr><th>Month</th><th>Expense</th></tr>";
for ($i = 0; $i < 12; $i++) {
    $month = date('F Y', $next_x[$i]);
    $expense = number_format($next_y[$i], 2);
    echo "<tr><td>{$month}</td><td>{$expense}</td></tr>";
}
echo "</table>";
?>


</div>
<div class="container14">

Yearly Income Prediction for Next Year displayed on Monthly basis:
  <?php
// to predict the income for next year using linear regression and fetching data of past year income
// Connect to the database
$conn = mysqli_connect("localhost:3308", "root", "", "registration");

// Get the income from the past year
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-1 year', strtotime($endDate)));
$query = "SELECT EntryDate, SUM(TotalAmount + Amount) as TotalIncome FROM (
  SELECT EntryDate, TotalAmount, 0 as Amount FROM `incomefromgoods` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
  UNION ALL
  SELECT EntryDate, 0 as TotalAmount, Amount FROM `incomefromservices` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
 ) AS Income
 GROUP BY EntryDate
 ORDER BY EntryDate ASC";
$result = mysqli_query($conn, $query);
// Store the income in arrays
$x = array(); // dates
$y = array(); // total income
while ($row = mysqli_fetch_array($result)) {
    $x[] = strtotime($row['EntryDate']);
    $y[] = $row['TotalIncome'];
}

// Calculate the slope and intercept using linear regression
$n = count($x);
$sum_x = array_sum($x);
$sum_y = array_sum($y);
$sum_xy = 0;
$sum_x2 = 0;
for ($i = 0; $i < $n; $i++) {
    $sum_xy += $x[$i] * $y[$i];
    $sum_x2 += $x[$i] * $x[$i];
}
if ($n * $sum_x2 - $sum_x * $sum_x != 0) {
    $slope = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x * $sum_x);
    $intercept = ($sum_y - $slope * $sum_x) / $n;
    // $n is the number of data points
    // sum_xy is the sum of the product of corresponding xx and yy values, calculated in the loop.
    // sum_x is the sum of all x values.
    // sum_y is the sum of all yy values.
    // sum_x2 is the sum of the squared xx values, also calculated in the loop.
} else {
    $slope = 0;
    $intercept = 0;
}

// Predict the income for the next year
$next_x = array();
$next_y = array();
for ($i = 1; $i <= 12; $i++) {
    $date = date('Y-m-d', strtotime("+{$i} month"));
    $next_x[] = strtotime($date);
    $next_y[] = $slope * strtotime($date) + $intercept;
}

// Display the predicted income
//echo "Predicted income for next year on the basis of past income:";
echo "<table>";
echo "<tr><th>Month</th><th>Income</th></tr>";
for ($i = 0; $i < 12; $i++) {
    $month = date('F Y', $next_x[$i]);
    $income = number_format($next_y[$i], 2);
    echo "<tr><td>{$month}</td><td>{$income}</td></tr>";
}
echo "</table>";
?>

</div>
<?php
// to predict the expenses for next year using linear regression and fetching data of past year expenses
// Connect to the database
$conn = mysqli_connect("localhost:3308", "root", "", "registration");

// Get the expenses from the past year
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-1 year', strtotime($endDate)));
$query = "SELECT EntryDate, SUM(TotalAmount + Amount) as TotalExpense FROM (
          SELECT EntryDate, TotalAmount, 0 as Amount FROM `expenseforgoods` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
          UNION ALL
          SELECT EntryDate, 0 as TotalAmount, Amount FROM `expenseservices` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
         ) AS Expenses
         GROUP BY EntryDate
         ORDER BY EntryDate ASC";
$result = mysqli_query($conn, $query);

// Store the expenses in arrays
$x = array(); // dates
$y = array(); // total expenses
while ($row = mysqli_fetch_array($result)) {
    $x[] = strtotime($row['EntryDate']);
    $y[] = $row['TotalExpense'];
}

// Calculate the slope and intercept using linear regression
$n = count($x);
$sum_x = array_sum($x);
$sum_y = array_sum($y);
$sum_xy = 0;
$sum_x2 = 0;
for ($i = 0; $i < $n; $i++) {
    $sum_xy += $x[$i] * $y[$i];
    $sum_x2 += $x[$i] * $x[$i];
}
if ($n * $sum_x2 - $sum_x * $sum_x != 0) {
    $slope = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x * $sum_x);
    $intercept = ($sum_y - $slope * $sum_x) / $n;
} else {
    $slope = 0;
    $intercept = 0;
}

// Predict the expenses for the next year
$next_x = array();
$next_y = array();
for ($i = 1; $i <= 12; $i++) {
    $date = date('Y-m-d', strtotime("+{$i} month"));
    $next_x[] = strtotime($date);
    $next_y[] = $slope * strtotime($date) + $intercept;
}

// Create an array to store the predicted expenses data
$predictedData = array();

// Loop through the next 12 months and predict the expenses for each month
for ($i = 0; $i < 12; $i++) {
    $month = date('F Y', $next_x[$i]);
    $expense = $next_y[$i];
    $predictedData[] = array($month, floatval($expense));
}

// Encode the data in JSON format
$predictedDataJSON = json_encode($predictedData);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Add the Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div class="container15">
        <!-- Add a div to hold the chart -->
        <div id="chart_div" style="width: 100%; height: 400px;"></div>
    </div>

    <!-- JavaScript to draw the bar chart -->
    <script type="text/javascript">
        // Load the Google Charts library
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Parse the JSON data generated by PHP
            var predictedData = <?php echo $predictedDataJSON; ?>;

            // Created the data table
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Expense');
            data.addRows(predictedData);

            // Set chart options
            var options = {
                title: 'Predicted Expenses for Next Year',
                vAxis: { title: 'Expense' },
                hAxis: { title: 'Month' },
                legend: { position: 'none' },
                bars: 'vertical'
            };

            // Instantiate and draw the chart
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>

<?php
// to predict the income for next year using linear regression and fetching data of past year income
// Connect to the database
$conn = mysqli_connect("localhost:3308", "root", "", "registration");

// Get the income from the past year
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-1 year', strtotime($endDate)));
$query = "SELECT EntryDate, SUM(TotalAmount) as TotalGoodsIncome, SUM(Amount) as TotalServicesIncome FROM (
          SELECT EntryDate, TotalAmount, 0 as Amount FROM `incomefromgoods` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
          UNION ALL
          SELECT EntryDate, 0 as TotalAmount, Amount FROM `incomefromservices` WHERE EntryDate BETWEEN '$startDate' AND '$endDate' AND id='".$_SESSION['id']."'
         ) AS Income
         GROUP BY EntryDate
         ORDER BY EntryDate ASC";
$result = mysqli_query($conn, $query);

// Store the income in arrays
$x = array(); // dates
$y = array(); // total income
while ($row = mysqli_fetch_array($result)) {
    $x[] = strtotime($row['EntryDate']);
    $y[] = $row['TotalGoodsIncome'] + $row['TotalServicesIncome'];
}

// Calculate the slope and intercept using linear regression
$n = count($x);
$sum_x = array_sum($x);
$sum_y = array_sum($y);
$sum_xy = 0;
$sum_x2 = 0;
for ($i = 0; $i < $n; $i++) {
    $sum_xy += $x[$i] * $y[$i];
    $sum_x2 += $x[$i] * $x[$i];
}
if ($n * $sum_x2 - $sum_x * $sum_x != 0) {
    $slope = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x * $sum_x);
    $intercept = ($sum_y - $slope * $sum_x) / $n;
} else {
    $slope = 0;
    $intercept = 0;
}

// Predict the income for the next year
$next_x = array();
$next_y = array();
for ($i = 1; $i <= 12; $i++) {
    $date = date('Y-m-d', strtotime("+{$i} month"));
    $next_x[] = strtotime($date);
    $next_y[] = $slope * strtotime($date) + $intercept;
}

// Create an array to store the predicted income data
$predictedIncomeData = array();

// Loop through the next 12 months and predict the income for each month
for ($i = 0; $i < 12; $i++) {
    $month = date('F Y', $next_x[$i]);
    $income = $next_y[$i];
    $predictedIncomeData[] = array($month, floatval($income));
}

// Encode the income data in JSON format
$predictedIncomeDataJSON = json_encode($predictedIncomeData);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Add the Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div class="container16">
        <!-- Add a div to hold the income chart -->
        <div id="income_chart_div" style="width: 100%; height: 400px;"></div>
    </div>

    <!-- JavaScript to draw the income bar chart -->
    <script type="text/javascript">
        // Load the Google Charts library
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawIncomeChart);

        function drawIncomeChart() {
            // Parse the JSON income data generated by PHP
            var predictedIncomeData = <?php echo $predictedIncomeDataJSON; ?>;

            // Create the income data table
            var incomeData = new google.visualization.DataTable();
            incomeData.addColumn('string', 'Month');
            incomeData.addColumn('number', 'Income');
            incomeData.addRows(predictedIncomeData);

            // Set chart options
            var incomeOptions = {
                title: 'Predicted Income for Next Year',
                vAxis: { title: 'Income' },
                hAxis: { title: 'Month' },
                legend: { position: 'none' },
                bars: 'vertical'
            };

            // Instantiate and draw the income chart
            var incomeChart = new google.visualization.ColumnChart(document.getElementById('income_chart_div'));
            incomeChart.draw(incomeData, incomeOptions);
        }
    </script>
</body>
</html>





    </div>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
<!-- logged in user information -->
<?php  if (isset($_SESSION['id'])) : ?>
  <?php endif ?>
</body>

</html>
