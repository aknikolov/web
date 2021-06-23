CREATE DATABASE web_db;

CREATE TABLE conversions (
  id int(10) NOT NULL AUTO_INCREMENT,
  userId int(10) NOT NULL,
  input text NOT NULL,
  output text NOT NULL,
  parseType tinyint(1) NOT NULL,
  timestamp date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE users (
  username varchar(32) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(32) NOT NULL,
  id int(10) NOT NULL AUTO_INCREMENT 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `conversions` (`id`, `userId`, `input`, `output`, `parseType`, `timestamp`) VALUES (NULL, '0', '---
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
   turtle-doves: two', '{\r\n \"doe\": \"a deer, a female deer\",\r\n \"ray\": \"a drop of golden sun\",\r\n \"pi\": 3.14159,\r\n \"xmas\": true,\r\n \"french-hens\": 3,\r\n \"calling-birds\": [\r\n \"huey\",\r\n \"dewey\",\r\n \"louie\",\r\n \"fred\"\r\n ],\r\n \"xmas-fifth-day\": {\r\n \"calling-birds\": \"four\",\r\n \"french-hens\": 3,\r\n \"golden-rings\": 5,\r\n \"partridges\": {\r\n \"count\": 1,\r\n \"location\": \"a pear tree\"\r\n },\r\n \"turtle-doves\": \"two\"\r\n }\r\n}', '0', '2021-06-22')