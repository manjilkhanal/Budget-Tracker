<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form Design</title>
        <link rel="stylesheet" type="text/css" href="registration.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <img src="avatar.png" class="avatar">
                <h1>Register Here</h1>
                <form action="registration.php" method="post">
                    <?php include('errors.php'); ?><br>
                    <p>Username</p>
                    <input type="text" pattern="[a-zA-Z'-'\s]*" name="username" placeholder="Enter username" class="Name" value="<?php echo $username; ?>">
                    <p>Email</p>
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Enter Email" class="Email" value="<?php echo $email; ?>">
                    <p>PhoneNo</p>
                    <input type="text" name="mobile"  pattern="[7-9]{1}[0-9]{9}" placeholder="Enter Mobile Number" class="Mobile" value="<?php echo $mobile; ?>">
                    <p>Password</p>
                    <input type="password" name="Password_1" placeholder="Enter Password" class="Password">
                    <p>Confirm Password</p>
                    <input type="password" name="Password_2" placeholder="Enter Confirm Password" class="CPassword">
                    <input type="submit" name="reg_user" value="Register" class="Register">
                    <a href="login.php" class="Already">Already Registered?</a>
                </form>
            </div>
        </div>
        </body>
</html>