<form action="./controllers/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" multiple>
    <input type="submit" value="Upload Image" name="submit">
</form>