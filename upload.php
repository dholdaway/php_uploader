<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
$fileName = 'uploads/' . pathinfo($target_file,PATHINFO_FILENAME) . '/';
// Check if file already exists
if (file_exists($target_file)) {
    echo "File already exists.";
    $uploadOk = 0;
}
if($fileType != "zip") {
    echo "Only .zip allowed!";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo " -> File was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo " File ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo " There was an error uploading the file.";
    }
}
$zip = new ZipArchive;
$res = $zip->open($target_file);
if ($res === TRUE && $uploadOk == 1) {
$zip->extractTo($fileName);
$zip->close();
echo ' - Complete';
} else {
echo ' - failed';
}
?>