<?php

class GoodZipArchive extends ZipArchive
{
    //@author Nicolas Heimann
    public function __construct($a = false, $b = false)
    {
        $this->create_func($a, $b);
    }

    public function create_func($input_folder = false, $output_zip_file = false)
    {
        if ($input_folder !== false && $output_zip_file !== false) {
            $res = $this->open($output_zip_file, ZipArchive::CREATE);
            if ($res === TRUE) {
                $this->addDir($input_folder, basename($input_folder));
                $this->close();
            } else {
                echo 'Could not create a zip archive. Contact Admin.';
            }
        }
    }

    // Add a Dir with Files and Subdirs to the archive
    public function addDir($location, $name)
    {
        $this->addEmptyDir($name);
        $this->addDirDo($location, $name);
    }

    // Add Files & Dirs to archive 
    private function addDirDo($location, $name)
    {
        $name .= '/';
        $location .= '/';
        // Read all Files in Dir
        $dir = opendir($location);
        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..') continue;
            // Rekursiv, If dir: GoodZipArchive::addDir(), else ::File();
            $do = (filetype($location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    }
}

$files = array_filter($_FILES['fileToUpload']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['fileToUpload']['name']);
// Loop through every file
$new_path = uniqid().date("Y-m-d-H-i-s");
echo $new_path . "<br>";
for ($i = 0; $i < $total_count; $i++) {
    //The temp file path is obtained
    $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];
    //A file path needs to be present
    if ($tmpFilePath != "") {
        //Setup our new file path
        if (!file_exists("./../uploads/" . $new_path)) {
            mkdir("./../uploads/" . $new_path, 0777);
        }
        $newFilePath = "./../uploads/" . $new_path . "/" . $_FILES['fileToUpload']['name'][$i];
        //File is uploaded to temp dir
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            //Other code goes here
        }
    }
}

new GoodZipArchive("./../uploads/" . $new_path,    "./../uploads/" . $new_path . '.zip');

echo "
<script>
    var wnd = window.open('./../uploads/" . $new_path . ".zip' , '_blank');
    setTimeout(function() {
      wnd.close();
    }, 1000)
</script>
";

array_map('unlink', glob("./../uploads/" . $new_path . "/*.*"));
rmdir("./../uploads/" . $new_path);
