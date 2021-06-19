<?php

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="">

<head>
    <title>YAML/JSON Parser</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="JS/basic_functions.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="overlay" id="overL" style="display: none">
    <div class="display-log">
        <div class="log">
            <button id="close-button" onclick="close_log()">X</button>
            <h2>Log:</h2>
            <?php
            echo "12:45:32 12.06.2021 YAML to JSON"
            ?>
            <button id="clear-log" onclick="alert('Do you want to continue?')">clear log</button>
        </div>

        <div class="convert-from">
            <div class="parser-header">
                <img height="40px" src="http://localhost/img/yaml_icon.png" alt="yaml_logo">
                <h2>YAML</h2>
            </div>
            <textarea id="log_textarea_yaml" onchange="copy_refresh()"></textarea>
            <div class="options">
                <button onclick="copy('log_textarea_yaml')">Copy</button>
                <button onclick="load('yaml')">Load</button>
            </div>
        </div>

        <div class="convert-to">
            <div class="parser-header">
                <img height="40px" src="http://localhost/img/json_icon.png" alt="yaml_logo">
                <h2>JSON</h2>
            </div>
            <textarea id="log_textarea_json"></textarea>
            <div class="options">
                <button onclick="copy('log_textarea_json')">Copy</button>
                <button onclick="load('json')">Load</button>
            </div>
        </div>
    </div>
</div>

<header>
    <div class="logo">
        <p>YAML/JSON <b style="font-weight: 900;">Parser</b></p>
    </div>
    <nav class="nav-menu">
        <a href="">Начало</a>
        <a href="">Convertor</a>
        <a href="">За нас</a>
    </nav>
    <div class="user">
        <i class="fa fa-user" style="font-size: 20px"></i>
        <?php  if (isset($_SESSION['username'])) : ?>
            <strong style="text-transform: Uppercase"><?php echo "&nbsp;", $_SESSION['username']; ?></strong>
        <?php endif ?>
        </i>
        <a href="index.php?logout='1'" class="header">Logout</a>
    </div>
</header>

<main>

    <aside>

    </aside>

    <section class="parser">
        <div class="info-block">
            <h1>YAML/JSON Parser</h1>
            <p>Let`s parse some code!</p>
            <button id="log-button" onclick="display_log()">View LOG <i class="fa fa-history"></i></button>
        </div>
        <div class="mid-block">
            <button class="parse-button">JSON <i class="fa fa-arrow-right"></i></button>
            <button class="parse-button"><i class="fa fa-arrow-left"></i> YAML</button>

        </div>

        <div class="yaml-block" >
            <div class="parser-header">
                <img height="40px" src="http://localhost/img/yaml_icon.png" alt="yaml_logo">
                <h2>YAML</h2>
            </div>
            <div class="parser_options">
                <button onclick="copy('container_textarea_yaml')"><i class="fa fa-copy"></i></button>
                <button onclick="paste('container_textarea_yaml')"><i class="fa fa-paste"></i></button>
                <button onclick="clear('container_textarea_yaml')"><i class="fa fa-times"></i></button>
                <button><i class="fa fa-download"></i></button>
            </div>
            <textarea id="container_textarea_yaml"></textarea>
         </div>

        <div class="json-block">
            <div class="parser-header">
                <img height="40px" src="http://localhost/img/json_icon.png" alt="yaml_logo">
                <h2>JSON</h2>
            </div>
            <div class="parser_options">
                <button onclick="copy('container_textarea_json')"><i class="fa fa-copy"></i></button>
                <button onclick="paste('container_textarea_json')"><i class="fa fa-paste"></i></button>
                <button onclick="clear('container_textarea_json')"><i class="fa fa-times"></i></button>
                <button><i class="fa fa-download"></i></button>
            </div>
            <textarea id="container_textarea_json"></textarea>
        </div>
    </section>
    <section class="about-us">За нас</section>
    <footer>Проект по WEB</footer>
</main>
</div>

<script type="text/javascript">

    window.onload = function (){
        document.getElementById('go').addEventListener('click', myfunc);

        function myfunc(){
            //your all code be here
        }
    }

    function display_log() {
        let x = document.getElementById("overL");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function close_log() {
        let x = document.getElementById("overL");

        if (x.style.display == "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function copy(element) {
        let copyText = document.getElementById(element);

        if(copyText.value != "")
        {
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");

        copyText.style.backgroundColor = "#CBD970";
        copyText.style.color = "white";

        setTimeout(() => {
            copyText.style.backgroundColor = "white";
            copyText.style.color = "black";
            }, 1000);
        }else{
            alert("No data in this field!");
        }
    }

    function paste(element) {
        let editor = document.getElementById(element);

        editor.focus();
        editor.select();
        document.execCommand('Paste');
    }

    function load(element){

        let container_to= "container_textarea_" + element;
        let container_from = "log_textarea_" + element;
        let to = document.getElementById(container_to);
        let from = document.getElementById(container_from);

        to.value = from.value;

        close_log();
    }

    function clear(element){
        let x = document.getElementById(element);
        alert(x);
        x.value = ' ';
    }


</script>
</body>
</html>