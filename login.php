<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="login-register">
<div class="header-login-register">
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
        Can`t log in? <a href="register.php"> Sign up</a>
    </p>
</form>
</body>
</html>