<meta http-equiv="Content-Type" content="text/plain; charset=windows-874" />
<?php

$files = array_filter($_FILES['fileToUpload']['name']);
$total_count = count($_FILES['fileToUpload']['name']);
$new_path = uniqid() . date("Y-m-d-H-i-s");
// echo $new_path . "<br>";
for ($i = 0; $i < $total_count; $i++) {
    $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];
    if ($tmpFilePath != "") {
        if (!file_exists("./uploads/" . $new_path)) {
            mkdir("./uploads/" . $new_path, 0777);
        }
        $newFilePath = "./uploads/" . $new_path . "/" . $_FILES['fileToUpload']['name'][$i];
        $tempPath = "./uploads/" . $new_path . "/IDXYYMM.dbf";
        // echo $new_path . "<br>";
        copy('./uploads/IDXYYMM.dbf', $tempPath);
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            read($newFilePath, $tempPath);
        }
    }
}

function read($newFilePath, $tempPath)
{
    $file = fopen($newFilePath, "r");
    $db = dbase_open($tempPath, 2);

    $index = 0;
    while (!feof($file)) {
        $line_of_text = fgets($file);
        // echo $line_of_text . "<br>";


        if (!ctype_space($line_of_text) && $line_of_text != '') {

            $members = explode('\n', $line_of_text);
            if ($index != 0) {
                $columns = explode('|', $members[0]);
                dbase_add_record($db, array(
                    $columns[0],
                    $columns[1],
                    $columns[2],
                    $columns[3]
                ));
            }
            $index++;
        }
    }
    fclose($file);
}
