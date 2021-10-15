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
        }
    }
}