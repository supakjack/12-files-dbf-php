<?php
$file = fopen("file:///C:/Users/supakjack/Downloads/6167afcc29a9a2021-10-14-06-19-24/6167afcc29a9a2021-10-14-06-19-24/CHAyymm.txt", "r");
$array_CHAyymm = array();
$array_CHAyymm_format = array();
$index = 0;
while (!feof($file)) {
    $line_of_text = fgets($file);
    if (!ctype_space($line_of_text) && $line_of_text != '') {
        $members = explode('\n', $line_of_text);
        if ($index != 0) {
            $columns = explode('|', $members[0]);
            array_push($array_CHAyymm_format, [
                "HN" => $columns[0],
                "AN" => $columns[1],
                "DATE" => $columns[2],
                "CHRGITEM" => $columns[3],
                "AMOUNT" => $columns[4],
            ]);
        }
        array_push($array_CHAyymm, $members);
        $index++;
    }
}
fclose($file);
var_dump($array_CHAyymm[0]);
var_dump($array_CHAyymm[130864]);
var_dump($array_CHAyymm_format);
