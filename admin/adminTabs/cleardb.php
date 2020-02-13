<?php

require_once("../../php_files/DBhandler.php");

$drop = 'DROP DATABASE IF EXISTS WebDev_CEID;'
.'CREATE DATABASE WebDev_CEID;'

.'USE WebDev_CEID;'

.'CREATE TABLE users('
.'username VARCHAR(256) NOT NULL,'
.'passwd VARCHAR(256) NOT NULL,'
.'mail VARCHAR(256) NOT NULL,'
.'IsAdmin INT(2) NOT NULL,'
.'userID VARCHAR(256) NOT NULL PRIMARY KEY,'
.'EcoScore BIGINT(3),'
.'LastUpload BIGINT(10)'
.')Engine=InnoDB;'

.'INSERT INTO users(username,passwd,mail,IsAdmin,userID) VALUES("akis", "ab2dd031d0d2445063ac6a1481f053af", "mauksalah@yahoo.gr", 1, "9sFRJA7l3HPUjgRQiZAvxWVdVfnRCXpRcCwCSbqOmhc=");'
.'INSERT INTO users(username,passwd,mail,IsAdmin,userID) VALUES("aris", "9594906fd6f4a0cd60a756239a5e69e2", "ariskyr@gmail.com", 1, "c5q/BoQAfuENkmZNjSpGL3TxAQUYzH/L8T8GlkKev/c=");';

if(!$mysql_con->multi_query($drop))
{
    echo "ton hpiame";
}else $mysql_con->multi_query($drop);

?>