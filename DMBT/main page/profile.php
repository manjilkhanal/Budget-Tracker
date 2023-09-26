<?php include 'navbarR.php' ?>
<?php
//session_start();
//$username=$_SESSION["username"];
$conn=mysqli_connect("localhost:3308","root","","registration") or die ("Connection Error:" . mysqli_error($conn));
$q = "select * from users  where username='".$_SESSION['username']."'";
$query = mysqli_query($conn,$q);
$res = mysqli_fetch_array($query);
$username=$_SESSION['username'];
if (count($_POST) > 0){
    $result = mysqli_query($conn, "SELECT *from users WHERE username='" .$username ."'");
    $row = mysqli_fetch_array($result);
    mysqli_query($conn, "UPDATE users set username = '" . $_POST["Username"]."',email ='" . $_POST["Email"] . "',mobile = '" . $_POST["MobileNumber"]. "' WHERE username='" . $username. "'");
    $message = "Profile Information Changed";
    $_SESSION['username']=$_POST['Username'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile Form Design</title>
        <link rel="stylesheet" type="text/css" href="profile.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <img src="avatar.png" class="avatar">
                <h1>Update User Profile Here</h1>
                <form method="post" action="profile.php">
                    <h2><?php if (isset($message[0])) {
                        echo $message;
                    } ?>
                    <p>Username</p>
                    <input type="text" pattern="[a-zA-Z'-'\s]*" name="Username" placeholder="" class="Name" value="<?php echo $res['username'] ?>" required>
                    <p>Email</p>
                    <input type="email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="" class="Email" value="<?php echo $res['email'] ?>" required>
                    <p>Mobile Number</p>
                    <input type="text" name="MobileNumber" placeholder="" class="Mobile" pattern="[7-9]{1}[0-9]{9}" value="<?php echo $res['mobile']?>" required>
                    <p>Registration Date</p>
                    <input type="text" name="date" placeholder="" class="Date" value="<?php echo $res['RegistrationDate'] ?>" disabled>
                    <input type="submit" name="Update" value="Update" class="Update">
                </form>
            </div>
            <div class="Note">
                <h3>Note:If you want to change only username or mobile or email then dont leave the empty field 
                    in other two or one field enter the previous username or mobile or email as when updated the 
                     other field does not become null.
                </h3>
        </div>
       
        </div>
       
    </body>
</html>