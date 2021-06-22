
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
    let display_log = document.querySelector(".display-log");



    print_log_container.onclick = function (event) {

        const element = event.target;
        if(element.nodeName !== 'BUTTON'){
            return;
        }

        let log_id = element.value;

        for(let x of data){
            if(x.id === log_id) {
                log_left_container.querySelector('textarea').value = x.input;
                log_right_container.querySelector('textarea').value = x.output;
            }
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
