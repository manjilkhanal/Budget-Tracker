<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Form Design</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <div class="container">
            <div class="loginbox">
                <img src="avatar.png" class="avatar">
                <h1>Login Here</h1>
                <form action="login.php" method="post">
                    <?php include('errors.php'); ?><br>
                    <p>Username</p>
                    <input type="text" name="username" placeholder="Enter your username" class="email" >
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter Password" class="password" >
                    <input type="submit" name="login_user" value="Login">
                    <a href="../Forgot password page/lost password.php" class="lost">Lost your password?</a><br>
                    <a href="registration.php" class="dont">Don't have an account?</a>
                </form>
            </div>
        </div>
        </body>
</html>
