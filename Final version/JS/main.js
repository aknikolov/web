
document.onreadystatechange = () => {
    let state = document.readyState;
    if (state === 'complete') {
        console.log("Page load: "+state);

       initApplication();
    }
}

function initApplication(){

    // Select Container Element
    let left_container = document.querySelector('.parser-left-block');
    let right_container = document.querySelector('.parser-right-block');
    let log_left_container = document.querySelector('.convert-from');
    let log_right_container = document.querySelector('.convert-to');
    let print_log_container = document.querySelector('.print_log_container');



    /* LOG START */

    print_log_container.onclick = function (event) {

        const element = event.target;
        if(element.nodeName !== 'BUTTON'){
            return;
        }

        //get log obj
        let log_id = element.value;
        let row;

        for(let x of data){
            if(x.id === log_id) {
                row = x;
            }
        }

        change(row);
    }

    function change(obj){

        log_left_container.querySelector('textarea').value = obj.input;
        log_right_container.querySelector('textarea').innerHTML = obj.output;

        switch (parseInt(obj.parseType)){
            case 0:
                log_left_container.querySelector('img').src="./img/json_icon.png";
                log_left_container.querySelector('h2').innerHTML = "JSON";

                log_right_container.querySelector('img').src="./img/yaml_icon.png";
                log_right_container.querySelector('h2').innerHTML = "YAML";

                break;
            case 1:
                log_left_container.querySelector('img').src="./img/yaml_icon.png";
                log_left_container.querySelector('h2').innerHTML = "YAML";

                log_right_container.querySelector('img').src="./img/json_icon.png";
                log_right_container.querySelector('h2').innerHTML = "JSON";

                break;
            case 2:
                log_left_container.querySelector('img').src="./img/json_icon.png";
                log_left_container.querySelector('h2').innerHTML = "JSON";

                break;
            case 3:

                log_left_container.querySelector('img').src="./img/yaml_icon.png";
                log_left_container.querySelector('h2').innerHTML = "YAML";

                break;
            default:
                console.log("problem");
        }
    }

    // Listen for all buttons in Log - left container
    log_left_container.onclick = function (event) {

        const element = event.target;

        if(element.nodeName !== 'BUTTON'){
            return;
        }

        switch (element.className) {
            case 'copy_btn':
                copyContent(log_left_container);
                break;
            case 'load_btn':
                load(log_left_container);
                break;
            default: break;
        }
    }

    // Listen for all buttons in Log - right container
    log_right_container.onclick = function (event) {

        const element = event.target;

        if(element.nodeName !== 'BUTTON'){
            return;
        }

        switch (element.className) {
            case 'copy_btn':
                copyContent(log_right_container);
                break;
            case 'load_btn':
                load(log_right_container);
                break;
            default: break;
        }
    }

    /* LOG END */


    // Listen for all buttons in Parse - left container
    left_container.onclick = function (event) {

        const element = event.target;

        if(element.nodeName !== 'BUTTON'){
            return;
        }

        switch (element.className) {
            case 'paste_btn':
                pasteContent(left_container);
                break;
            case 'copy_btn':
                copyContent(left_container);
                break;
            case 'clear_btn':
                clearContent(left_container);
                break;
            case 'download_btn':
                download_content(left_container);
                break;
            default: break;
        }
    }

    // Listen for all buttons in Parse - left container
    right_container.onclick = function (event) {

        const element = event.target;

        if(element.nodeName !== 'BUTTON'){
            return;
        }

        switch (element.className) {
            case 'paste_btn':
                pasteContent(right_container);
                break;
            case 'copy_btn':
                copyContent(right_container);
                break;
            case 'clear_btn':
                clearContent(right_container);
                break;
            case 'download_btn':
                download_content(right_container);
                break;
            default: break;
        }
    }

    /* Clear, Paste, Copy functions */
    function clearContent(container){

        let textarea = container.querySelector('textarea');
        textarea.value = "";
    }

    function pasteContent(container){
        let textarea = container.querySelector('textarea');
        navigator.clipboard.readText().then(
            clipText => textarea.value = textarea.value + clipText);
    }

    function copyContent(container){

        let textarea = container.querySelector('textarea');
        navigator.clipboard.writeText(textarea.value).then();
    }

    function load(container){
        let textarea = container.querySelector('textarea');
        let outputContainer = document.getElementById('container_textarea_yaml');

        outputContainer.value = textarea.value;
        close_log();
    }
}

function display_log() {
    let log_window = document.getElementById("overL");
    if (log_window.style.display === "none") {
        log_window.style.display = "block";
    } else {
        log_window.style.display = "none";
    }

    document.body.style.position = "fixed";

}

function close_log() {
    let log_window = document.getElementById("overL");

    if (log_window.style.display === "block") {
        log_window.style.display = "none";
    } else {
        log_window.style.display = "block";
    }

    document.body.style.position = "inherit";
}

function download_content(container){
  console.log("download");
}

/* Parser */

function hideOutput(){

    if(document.getElementById('rb-json').checked){
        document.getElementById('json-img').style.display = "none";
        document.getElementById('json-h').style.display = "none";
        document.getElementById('yaml-img').style.display = "block";
        document.getElementById('yaml-h').style.display = "block";
    }else{
        document.getElementById('yaml-img').style.display = "none";
        document.getElementById('yaml-h').style.display = "none";
        document.getElementById('json-img').style.display = "block";
        document.getElementById('json-h').style.display = "block";
    }
}


function parseInput(){
    let chb_autoSave = document.querySelector("[type=checkbox]");

    if(document.getElementById('container_textarea_yaml').value === ""){return;}

    if(document.getElementById('rb-yaml').checked){
        YAMLtoJSON();
    }else{
        JSONtoYAML();
    }
}

function YAMLtoJSON() {
    let input = document.getElementById('container_textarea_yaml').value;
    let output = document.getElementById('container_textarea_json');

    try{
        YAML.parse(input);
    }catch{
        alert("Invalid YAML");
    }

    let obj = YAML.parse(input);
    output.value = JSON.stringify(obj, null, '\t');
}

function JSONtoYAML() {

    let input = document.getElementById('container_textarea_yaml').value;
    let output = document.getElementById('container_textarea_json');

    try{
        JSON.parse(input);
    }catch{
        alert("Invalid JSON");
    }

    let obj = JSON.parse(input);
    output.value = YAML.stringify(obj);
}

function get_input(){
    return document.getElementById('container_textarea_yaml').value;
}

function get_output(){
    return document.getElementById('container_textarea_json').value;
}

function get_parseType(){
    return document.getElementById("rb-json").checked ? 0 : 1;
}

/* Търсим начин да запишем стойностите на парсването в базата данни
    1) Не можем да направим submit едновременно.
    2) При последователен submit без ajax стойностите се губят за втория submit.
 */

function submitForm(){
    let form = document.querySelector('#form1');

    form.submit();
}

function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function checkType() {
    let rb_json = document.querySelector('#rb-json');
    let rb_yaml= document.querySelector('#rb-yaml');

    let input = document.querySelector('#container_textarea_yaml');

    if(IsJsonString(input.value)){
        rb_json.checked = true;
    }else{
        rb_yaml.checked = true;
    }

}