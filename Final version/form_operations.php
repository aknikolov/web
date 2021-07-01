<?php
$data = "";
$input = "";
$output= "";
$type = null;
$parse = "";
$autoSave = false;

if(isset($_POST['config'])) {
    $config = yaml_parse($_POST['config']);

    $autoSave = $config["save"];
}

if(isset($_POST['input'])){
    $input = $_POST['input'];
}

if(isset($_POST['output'])){
    $output = $_POST['output'];
}



if(isset($_POST['clear'])){
    $id = end($_SESSION['id']);
    require_once("dbconnection.php");
    $db = new Db;
    $db->deleteAllConversionsByUserId($id);
}

if($autoSave){
    $id = end($_SESSION['id']);
    require_once("dbconnection.php");
    $db = new Db;

    if($parse == "yaml"){
        $type = 1;
    }else{
        $type = 0;
    }

    $db->addNewConversion($id, $input, $output, $type);
}
?>
