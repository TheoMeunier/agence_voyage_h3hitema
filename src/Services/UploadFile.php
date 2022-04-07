<?php

function uploadFile(string $tmpFile, string $file)
{
    move_uploaded_file(
        $tmpFile,
        __DIR__ . "../../assets/uploaded_img/$file"
    );
}

function removeFile(string $filename)
{
    unlink(__DIR__ . "../../assets/uploaded_img/$filename");
}

function processFileForm()
{
    $tmp_name = $_FILES['image']['tmp_name'];
    $name = basename( $_FILES['image']['name']);
    var_dump($tmp_name, $name).die();
    uploadFile($tmp_name, (array)$name);
}