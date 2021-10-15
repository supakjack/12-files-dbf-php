<?php
$files = array_filter($_FILES['fileToUpload']['name']);
$total_count = count($_FILES['fileToUpload']['name']);
$new_path = uniqid() . date("Y-m-d-H-i-s");
echo $new_path . "<br>";
for ($i = 0; $i < $total_count; $i++) {
    $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];
    if ($tmpFilePath != "") {
        if (!file_exists("./../uploads/" . $new_path)) {
            mkdir("./../uploads/" . $new_path, 0777);
        }
        $newFilePath = "./../uploads/" . $new_path . "/" . $_FILES['fileToUpload']['name'][$i];
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            if ($_FILES['fileToUpload']['name'][$i] == 'CHAyymm.txt') {
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

                $file = fopen("./../uploads/" . $new_path . "/CHAyymm.txt", "r");
                $db = dbase_open('./test-CHAyymm.dbf', 2);
                $index = 0;

                while (!feof($file)) {
                    $line_of_text = fgets($file);
                    if (!ctype_space($line_of_text) && $line_of_text != '') {
                        $members = $line_of_text;
                        if ($index > 0) {
                            $columns = explode('|', $members);
                            dbase_add_record($db, array(
                                iconv("UTF-8", "tis-620", $columns[0]),
                                iconv("UTF-8", "tis-620", $columns[1]),
                                iconv("UTF-8", "tis-620", $columns[2]),
                                iconv("UTF-8", "tis-620", $columns[3]),
                                iconv("UTF-8", "tis-620", $columns[4]),
                            ));
                        }
                        $index++;
                    }
                }
                fclose($file);
                dbase_close($db);
            } else if ($_FILES['fileToUpload']['name'][$i] == 'CHTyymm.txt') {
                $def = array(
                    array("HN",     "C", 128),
                    array("AN",     "C", 128),
                    array("DATE",      "D"),
                    array("TOTAL",    "N", 10, 0),
                    array("PAID", "N", 10, 0),
                    array("PTTYPE", "C", 128)
                );

                if (!dbase_create('./test-CHTyymm.dbf', $def)) {
                    echo "Error, can't create the database\n";
                }

                $file = fopen("./../uploads/" . $new_path . "/CHTyymm.txt", "r");
                $db = dbase_open('./test-CHTyymm.dbf', 2);
                $index = 0;

                while (!feof($file)) {
                    $line_of_text = fgets($file);
                    if (!ctype_space($line_of_text) && $line_of_text != '') {
                        $members = $line_of_text;
                        if ($index > 0) {
                            $columns = explode('|', $members);
                            dbase_add_record($db, array(
                                iconv("UTF-8", "tis-620", $columns[0]),
                                iconv("UTF-8", "tis-620", $columns[1]),
                                iconv("UTF-8", "tis-620", $columns[2]),
                                iconv("UTF-8", "tis-620", $columns[3]),
                                iconv("UTF-8", "tis-620", $columns[4]),
                                iconv("UTF-8", "tis-620", $columns[5]),

                            ));
                        }
                        $index++;
                    }
                }
            } else if ($_FILES['fileToUpload']['name'][$i] == 'IDXyymm.txt') {
                $def = array(
                    array("HN",     "C", 128),
                    array("DIAG",     "C", 128),
                    array("DXTYPE",      "C", 128),
                    array("DRDX",    "C", 128)
                );

                if (!dbase_create('./test-IDXyymm.dbf', $def)) {
                    echo "Error, can't create the database\n";
                }

                $file = fopen("./../uploads/" . $new_path . "/IDXyymm.txt", "r");
                $db = dbase_open('./test-IDXyymm.dbf', 2);
                $index = 0;

                while (!feof($file)) {
                    $line_of_text = fgets($file);
                    if (!ctype_space($line_of_text) && $line_of_text != '') {
                        $members = $line_of_text;
                        if ($index > 0) {
                            $columns = explode('|', $members);
                            echo $columns[3] . "<br>";
                            dbase_add_record($db, array(
                                iconv("UTF-8", "tis-620", $columns[0]),
                                iconv("UTF-8", "tis-620", $columns[1]),
                                iconv("UTF-8", "tis-620", $columns[2]),
                                iconv("UTF-8", "tis-620", $columns[3] . substr(0, 1) . $columns[3] . substr(1, strlen($columns[3])))
                            ));
                            echo $columns[3] . substr(0, 1) . $columns[3] . substr(1, strlen($columns[3]))."<br>";
                        }
                        $index++;
                    }
                }
            }
        }
    }
}
