<<<<<<< HEAD
<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body class="background-color: red;">
<div class="header-login-register">
    <h2>Register</h2>
</div>
<form id="form-register" method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </label>
    </div>
    <div class="input-group">
        <label>Email</label>
        <label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </label>
    </div>
    <div class="input-group">
        <label>Password</label>
        <label>
            <input type="password" name="password_1">
        </label>
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <label>
            <input type="password" name="password_2">
        </label>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already have an account? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
=======
<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body class="background-color: red;">
<div class="header-login-register">
    <h2>Register</h2>
</div>
<form id="form-register" method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </label>
    </div>
    <div class="input-group">
        <label>Email</label>
        <label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </label>
    </div>
    <div class="input-group">
        <label>Password</label>
        <label>
            <input type="password" name="password_1">
        </label>
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <label>
            <input type="password" name="password_2">
        </label>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already have an account? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
>>>>>>> bf985c2483e17f63d34feb2d6528927c99caad1e
</html>