<?php
session_start();
if (!isset( $_SESSION['id'])) {
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
$id="";
?>
<!DOCTYPE html>
<head>
    <title>Budget Tracker</title>
    <link rel="stylesheet" type="text/css" href="navbarR.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
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
      //echo $_SESSION['id'];
      echo $_SESSION['username'];
    }
  }
?></strong></center>
</div>
</img>
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
