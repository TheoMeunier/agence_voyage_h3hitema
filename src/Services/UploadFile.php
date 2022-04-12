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
    unlink("../../assets/uploaded_img/$filename"); // __DIR__ . 
}

function processFileForm()
{
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $path = '../../assets/uploaded_img/' . $image;
    uploadFile($tmp_name, $path);
}