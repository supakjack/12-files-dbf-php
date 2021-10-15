<?php
$def = array(
    array("HN",     "C", 128),
    array("AN",     "C", 128),
    array("DATE",      "D"),
    array("CHRGITEM",    "C", 128),
    array("AMOUNT", "N", 10, 0)
);

if (!dbase_create('./test-CHAyymm.dbf', $def)) {
    echo "Error, can't create the database\n";
}