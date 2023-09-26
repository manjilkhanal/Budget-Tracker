<?php
//connect to the database
$db = mysqli_connect('localhost:3308', 'root', '', 'registration');
//initializing variables
$msg1 = "";
$msg2 = "";
$msg3 = "";
if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($db, $_POST['email']);

    $emailquery = "select * from users where email='$email'";
    $query = mysqli_query($db,$emailquery);

    $emailcount = mysqli_num_rows($query);
    if($emailcount){
        $userdata = mysqli_fetch_array($query);
        $username = $userdata['username'];
        $id = $userdata['id'];
        $subject = "Password Reset link - Budget Tracker";
        $body = "Hi, $username. Click here to reset your password
                http://localhost/DMBT/Forgot%20password%20page/resetpassword.php?id=$id";
        $sender_email = "From: manjilkhanal710@gmail.com";
        if(mail($email,$subject,$body,$sender_email)){
            $msg1= "check you mail to reset your password";
            echo "<META HTTP-EQUIV='Refresh' CONTENT='4; URL=http://localhost/DMBT/registration/login.php'>";
            //header('location:');
        }else {
            $msg2= "Email sending failed!";
        }
    }else{
            $msg3= "No email found";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password Page</title>
        <link rel="stylesheet" type="text/css" href="lost password.css">
    </head>
    <body>
        <div class="container">
            <div class="forgotbox">
                <img src="avatar.png" class="avatar">
                <h1>Reset Password Here</h1>
                <form method='post' name='reset'>
                    <p><?php echo $msg1; ?></p>
                    <p><?php echo $msg2; ?></p>
                    <p><?php echo $msg3; ?></p><br>
                    <p>E-mail Address</p>
                    <input type="email" name="email" placeholder="Enter your email address" class="email">
                    <input type="submit" name="submit" value="Send Password Reset Link" class="resetlink">
                    <a href="../registration/login.php" class="return">Return to login page?</a>
                </form>
            </div>
        </div>
    </body>
</html>