DROP DATABASE IF EXISTS WebDev_CEID;

CREATE DATABASE WebDev_CEID;

USE WebDev_CEID;

CREATE TABLE users(
username VARCHAR(256) NOT NULL,
passwd VARCHAR(256) NOT NULL,
mail VARCHAR(256) NOT NULL,
IsAdmin INT(2) NOT NULL,
userID VARCHAR(256) NOT NULL PRIMARY KEY
)Engine=InnoDB;

INSERT INTO users VALUES('akhs', 'akhs123', 'akhs@gmail.com', 0, '1234');
INSERT INTO users VALUES('arhs', 'arhs123', 'aris@gmail.com', 1, '5678');