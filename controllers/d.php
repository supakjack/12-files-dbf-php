<?php

// database "definition"
$def = array(
array("date", "D"),
array("name", "C", 50),
array("age", "N", 3, 0),
array("email", "C", 128),
array("ismember", "L")
);

// create
if (!dbase_create('.zayvka.dbf', $def)) {
echo "Error, unable to create database\n";
}

?>