CREATE DATABASE web_db;

CREATE TABLE conversions (
  id int(10) NOT NULL AUTO_INCREMENT,
  userId int(10) NOT NULL,
  input text NOT NULL,
  output text NOT NULL,
  parseType tinyint(1) NOT NULL,
  timestamp date NOT NULL DEFAULT current_timestamp(),
   PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE users (
  username varchar(32) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(32) NOT NULL,
  id int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;