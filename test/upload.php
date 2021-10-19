<meta http-equiv="Content-Type" content="text/plain; charset=windows-874"/>
<?php

$files = array_filter($_FILES['fileToUpload']['name']);
$total_count = count($_FILES['fileToUpload']['name']);
$new_path = uniqid() . date("Y-m-d-H-i-s");
echo $new_path . "<br>";
for ($i = 0; $i < $total_count; $i++) {
    $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];
    if ($tmpFilePath != "") {
        if (!file_exists("./uploads/" . $new_path)) {
            mkdir("./uploads/" . $new_path, 0777);
        }
        $newFilePath = "./uploads/" . $new_path . "/" . $_FILES['fileToUpload']['name'][$i];
        echo $new_path . "<br>";
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            read($newFilePath);
        }
    }
}

function read($path)
{
    $file = fopen($path, "r");
    $db = dbase_open('./uploads/IDXYYMM.dbf', 2);

    $index = 0;
    while (!feof($file)) {
        $line_of_text = fgets($file);
        // $line_of_text = iconv("windows-874", "TIS-620", $line_of_text);
        // $line_of_text = iconv("windows-874", "TIS-620", $line_of_text);
        // $line_of_text = iconv("UTF-8", "TIS-620", $line_of_text);
        echo $line_of_text."<br>";

        
        if (!ctype_space($line_of_text) && $line_of_text != '') {

            $members = explode('\n', $line_of_text);
            // var_dump($members);
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
function win874($str){
    $win874=strpos($str,"windows-874");
    return $win874;
}

function utf8($str){
    $utf8=strpos($str,"UTF-8");
    return $utf8;
}