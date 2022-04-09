<?php

function uploadFile(string $tmpFile, string $path)
{
    move_uploaded_file(
        $tmpFile,
        $path
    );
}

function removeFile(string $filename)
{
    unlink(__DIR__ . "../../assets/uploaded_img/$filename");
}

function processFileForm()
{
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $path = '../../assets/upload_img' . $image;
    uploadFile($tmp_name, $path);
}