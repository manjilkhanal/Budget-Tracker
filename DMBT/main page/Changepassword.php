<?php include 'navbarR.php' ?>
<?php
//session_start();
$username = $_SESSION["username"];
$conn = mysqli_connect("localhost:3308", "root", "", "registration") or die("Connection Error: " . mysqli_error($conn));
$q = "select * from users ";
$query = mysqli_query($conn,$q);
$res = mysqli_fetch_array($query);
$id=$res['id'];
if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT *from users WHERE username='" . $username . "'");
    $row = mysqli_fetch_array($result);
    if (md5($_POST["currentPassword"]) == $row["Passcode"] && md5($_POST["newPassword"]) == md5($_POST["confirmPassword"])) {
        mysqli_query($conn, "UPDATE users set Passcode ='" . md5($_POST["newPassword"]) . "',Confirmpasscode ='" . md5($_POST["newPassword"]) . "' WHERE username='" . $username . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
    if(md5($_POST["newPassword"]) != md5($_POST["confirmPassword"])){
    $message ="The password doesnot match";
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Password Form Design</title>
        <link rel="stylesheet" type="text/css" href="Changepassword.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <img src="avatar.png" class="avatar">
                <h1>Change Password</h1>
                <form name="frmChange" method="post" action="Changepassword.php">
                    <h2><?php if (isset($message[0])) {
                        echo $message;}

                    ?>
                    </h2><br>
                
                    <p>Current Password</p>
                    <input type="password" name="currentPassword" placeholder="Enter current password" class="currentPassword" required>
                    <p>New Password</p>
                    <input type="password" name="newPassword" placeholder="Enter new password" class="newPassword" required>
                    <p>Confirm Password</p>
                    <input type="password" name="confirmPassword" placeholder="Enter new password again" class="Confirmpassword" required><br>
                    <input type="submit" name="submit" value="Change" class="Change">
                </form>
            </div>
        </div>
    </body>
</html>