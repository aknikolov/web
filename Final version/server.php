<?php
session_start();
require_once("dbconnection.php");
// initializing variables
$username = "";
$email    = "";
$errors = array();

$db = new Db;
// register
if (isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 =$_POST['password_1'];
    $password_2 = $_POST['password_2'];

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $res = $db->checkUserExists($username, $email);
    if ($res->rowCount() > 0) {

        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $db->register($username, $email, $password);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: login.php');
    }
}

//login
if (isset($_POST['login_user'])) {
    $username =  $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $results = $db->checkLoginData($username, $password);
        if ($results->rowCount() == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $results->fetch(PDO::FETCH_ASSOC);
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>