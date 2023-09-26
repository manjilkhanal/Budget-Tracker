<?php
//database connection
$db = mysqli_connect('localhost:3308', 'root','','registration');
//initializing variable
$msg1 = "";
$msg2 = "";
$msg3 = "";
$msg4 = "";
$errors = "";
if(isset($_POST['submit'])){
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

    $newpassword = mysqli_real_escape_string($db, $_POST['newPassword']);
    $cpassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);
    if (empty($newpassword)) { array_push($errors, "New password is required"); }
    if (empty($cpassword)) { array_push($errors, " Confirm Password is required"); }

    $pass = md5($newpassword);
    $cpass = md5($cpassword);
    if($newpassword === $cpassword){
        $updatequery = "update users set Passcode='".$pass."',Confirmpasscode='".$cpass."' where id = '".$id."'";
        $iquery= mysqli_query($db,$updatequery);
        if($iquery){
            $msg1 = "Your password has been successfully updated"; 
            echo "<META HTTP-EQUIV='Refresh' CONTENT='4; URL=http://localhost/DMBT/registration/login.php'>";
        }else{
            $msg2= "Failed to update password";
        }
    }else{
        $msg3 ="New and Confirm password did not match so password not updated";
    }

    }else{
        $msg4="No id found";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" type="text/css" href="resetpassword.css">
</head>
<body>
    <div class="container">
        <div class="resetbox">
            <img src="avatar.png" class="avatar">
            <h1>Reset Password</h1>
            <form method = "post" action = "">
                <p><?php echo $msg1; ?> </p>
                <p><?php echo $msg2; ?></p>
                <p><?php echo $msg3; ?></p>
                <p><?php echo $msg4; ?></p>
                <p><?php echo $errors; ?></p><br>
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