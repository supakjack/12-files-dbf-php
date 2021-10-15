<?php

$db = dbase_open('./test-CHAyymm.dbf', 2);
$index = 0;

while (!feof($file)) {
    $line_of_text = fgets($file);
    if (!ctype_space($line_of_text) && $line_of_text != '') {
        $members = $line_of_text;
        if ($index > 0) {
            $columns = explode('|', $members);
            dbase_add_record($db, array(
                $columns[0],
                $columns[1],
                $columns[2],
                $columns[3],
                $columns[4],
            ));
        }
        $index++;
    }
}
fclose($file);
dbase_close($db);