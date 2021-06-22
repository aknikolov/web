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

$data = array();

$id = end($_SESSION['id']);

require_once("dbconnection.php");
$db = new Db;
$userLog = $db->findAllConversionsByUserId($id);


?>
<!DOCTYPE html>
<html lang="BG">

<head>
    <title>YAML/JSON Parser</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="./yaml.js-develop/dist/yaml.js"></script>
    <script defer type="text/javascript" src="./JS/main.js"></script>
    <script defer type="text/javascript" src="./JS/script.js"></script>
</head>
<body>

<div class="overlay" id="overL" style="display: none">
    <div class="display-log">
        <div class="log">
            <a id="close-button" onclick="close_log()"><i class="fa fa-times"></i></a>
            <h2>Log:</h2>
            <div class="load_test_buttons">
                <button onclick="test_Yaml()">Test YAML</button>
                <button onclick="test_JSON()" >Test JSON</button>
            </div>
            <div class="print_log_container">
                    <?php

                    /* Create log record on new line */
                    foreach ($userLog as $log) {

                        //Check what type of parse/prettifier is
                        if($log['parseToJson'] == 0 && $log['parseToYaml'] == 1){
                            $type = "JSON to YAML";
                        }else if($log['parseToJson'] == 1 && $log['parseToYaml'] == 0){
                            $type = "YAML to JSON";
                        }else{
                            $type = "Prettifier";
                        }

                        $text = $log['timestamp']." ".$type;
                        $id = $log['id'];
                        echo "<button class='log_buttons' value='$id'>$text</button><br>";

                        $data = $userLog;
                    }
                    ?>
                    <script>
                        let data = <?php
                            echo json_encode($data);
                            ?>;
                    </script>
            </div>
            <div class="log-other-options-container">
                <button id="download-log"><i class="fa fa-download"></i> download log</button>
                <button id="clear-log" onclick="alert('Do you want to continue?')">clear log</button>
            </div>
        </div>

        <div class="convert-from">
            <div id="ph-left" class="parser-header">
                <img height="40px" src="./img/yaml_icon.png" alt="yaml_logo">
                <h2>YAML</h2>
            </div>
            <textarea id="log_textarea_yaml">
            </textarea>
            <div class="options">
                <button class="copy_btn">Copy</button>
                <button class="load_btn">Load</button>
            </div>
        </div>

        <div class="convert-to">
            <div id="ph-right" class="parser-header">
                <img height="40px" src="./img/json_icon.png" alt="yaml_logo">
                <h2>JSON</h2>
            </div>
            <textarea id="log_textarea_json"></textarea>
            <i id="log-parse-arrow" class="fa fa-chevron-right"></i>
            <div class="options">
                <button class="copy_btn">Copy</button>
                <button class="load_btn">Load</button>
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
        <a href="index.php?logout='1'" class="header">Logout</a>
    </div>
</header>

<main>

    <section class="parser">
        <div class="info-block">
            <h1>YAML/JSON Parser</h1>
            <p>Let`s parse some code!</p>
            <button id="log-button" onclick="display_log()">View LOG <i class="fa fa-history"></i></button>
        </div>
        <div class="mid-block">
            <button onclick="parseInput();" class="parse-button">Parse <i class="fa fa-arrow-right"></i></button>
            <label for="auto_save">Auto Save</label>
            <input id="auto_save" type="checkbox">
        </div>

        <div class="parser-left-block" >
            <div class="parser-header">
                <h3>Input:</h3>
                <label for="rb-yaml">
                    <img height="40px" src="./img/yaml_icon.png" alt="yaml_logo">
                    <p>YAML</p>
                </label>
                <input onclick="hideOutput()" type="radio" id="rb-yaml" name="parse-to" value="yaml" checked>
                <label for="rb-json">
                    <img height="40px" src="./img/json_icon.png" alt="yaml_logo">
                    <p>JSON</p>
                </label>
                <input onclick="hideOutput()" type="radio" id="rb-json" name="parse-to" value="json">
            </div>
            <div class="parser_options">
                <button class="copy_btn"><i style="pointer-events:none" class="fa fa-copy"></i></button>
                <button class="paste_btn"><i style="pointer-events:none" class="fa fa-paste"></i></button>
                <button class="clear_btn"><i style="pointer-events:none" class="fa fa-times"></i></button>
                <button class="download_btn"><i style="pointer-events:none" class="fa fa-download"></i></button>
            </div>
            <textarea id="container_textarea_yaml">
            </textarea>
         </div>

        <div class="parser-right-block">
            <div class="parser-header">
                <h3>Output:</h3>
                <img id="json-img" class="parser-hide-json"  height="40px" src="./img/json_icon.png" alt="yaml_logo">
                <p id="json-h" class="parser-hide-json" >JSON</p>
                <img id= "yaml-img" class="parser-hide-yaml" height="40px" src="./img/yaml_icon.png" alt="yaml_logo">
                <p id = "yaml-h" class="parser-hide-yaml">YAML</p>
            </div>
            <div class="parser_options">
                <button class="copy_btn"><i style="pointer-events:none" class="fa fa-copy"></i></button>
                <button class="paste_btn"><i style="pointer-events:none" class="fa fa-paste"></i></button>
                <button class="clear_btn"><i style="pointer-events:none" class="fa fa-times"></i></button>
                <button class="download_btn"><i style="pointer-events:none" class="fa fa-download"></i></button>

                <!-- download functionality needs php -> form -> submit -->
                <div class="download_popup">
                    <button type="submit">get file</button>
                    <div>
                        <label for="link">Share Link</label>
                        <input id="link" type="text">
                    </div>
                </div>
            </div>
            <textarea id="container_textarea_json"></textarea>
        </div>
    </section>
    <section class="about-us">За нас</section>
    <footer>Проект по WEB</footer>
</main>

</body>
</html>