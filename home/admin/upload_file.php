<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$temp_name_of_uploaded_file = $_FILES['toBeProcessed']['tmp_name'];
if (is_uploaded_file($temp_name_of_uploaded_file)) {
    $dir =  "/home/hou32hou/Repos/web-assignment/home/admin/";
    move_uploaded_file($temp_name_of_uploaded_file, $dir.'{$temp_name_of_uploaded_file}');
    echo "File uploaded successfully";
} else {
    echo "File failed to be uploaded";
}

?>
<form enctype="multipart/form-data" 
    action="<?php echo $_SERVER['PHP_SELF']; ?>"
    method="POST">
    <!-- Set max size to 10 KB -->
    <input type="hidden" name="MAX_FILE_SIZE" value="10240"> 
    File name: <br/>
    <input type="file" name="toBeProcessed"/>
    <br/>
    <input type="submit" value="Upload">
</form>