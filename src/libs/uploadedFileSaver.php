<?php
// The code below is copied from https://www.w3schools.com/php/php_file_upload.asp
class UploadedFileSaver
{

    function __construct($file)
    {
        $target_file = IMG_UPLOAD_DIR . $file["name"];

        $this->uploadSuccess = 
            $this->imageIsReal($file) &&
            $this->imageIsNotDuplicated($target_file) &&
            $this->imageIsNotOversized($file) &&
            $this->imageFormatIsValid($target_file);

        if (!$this->uploadSuccess) {
            echo "Sorry, your file was not uploaded.";
            return;
        }

        if (move_uploaded_file($file["tmp_name"], IMG_UPLOAD_DIR . basename($file["tmp_name"]))) {
            echo "The file " . basename($file["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $this->targetFile = '../php_uploads/' . basename($file["tmp_name"]);
    }

    function imageIsReal($file)
    {
        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            return true;
        } else {
            echo "File is not an image.";
            return false;
        }
    }

    function imageIsNotDuplicated($target_file)
    {
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            return false;
        }
        return true;
    }

    function imageIsNotOversized($file)
    {
        $SIZE_LIMIT = 500000;
        if ($file["size"] > $SIZE_LIMIT) {
            echo "Sorry, your file is too large.";
            return false;
        }
        return true;
    }

    function imageFormatIsValid($target_file)
    {
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "File type of $imageFileType is not allowed. Only JPG, JPEG, PNG & GIF files are allowed.";
            return false;
        }
        return true;
    }

}