<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Login</h2>
</div>

<form id="form--login" method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <label>
            <input type="text" name="username" >
        </label>
    </div>
    <div class="input-group">
        <label>Password</label>
        <label>
            <input type="password" name="password">
        </label>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
</form>
</body>
</html>