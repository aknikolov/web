

function test_Yaml(){
    let x = document.getElementById('container_textarea_yaml');
    let y = document.getElementById('container_textarea_json');

    y.value="";
    x.value =
        `---
 doe: "a deer, a female deer"
 ray: "a drop of golden sun"
 pi: 3.14159
 xmas: true
 french-hens: 3
 calling-birds:
   - huey
   - dewey
   - louie
   - fred
 xmas-fifth-day:
   calling-birds: four
   french-hens: 3
   golden-rings: 5
   partridges:
     count: 1
     location: "a pear tree"
   turtle-doves: two`;

    document.getElementById('rb-yaml').click();
    close_log();
}

function test_JSON(){
    let x = document.getElementById('container_textarea_yaml');
    let y = document.getElementById('container_textarea_json');

    y.value="";
    x.value =
        `{
\t"doe": "a deer, a female deer",
\t"ray": "a drop of golden sun",
\t"pi": 3.14159,
\t"xmas": true,
\t"french-hens": 3,
\t"calling-birds": [
\t\t"huey",
\t\t"dewey",
\t\t"louie",
\t\t"fred"
\t],
\t"xmas-fifth-day": {
\t\t"calling-birds": "four",
\t\t"french-hens": 3,
\t\t"golden-rings": 5,
\t\t"partridges": {
\t\t\t"count": 1,
\t\t\t"location": "a pear tree"
\t\t},
\t\t"turtle-doves": "two"
}
}`;


    document.getElementById('rb-json').click();
    close_log();
}