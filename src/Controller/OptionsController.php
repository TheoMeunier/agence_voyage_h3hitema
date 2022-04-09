<?php

require_once '../../src/Table/Table.php';

function isValid()
{

}

function isSubmit()
{
    return isset($_POST['submit']);
}

function remove(int $id)
{
    delete('TAG', $id);
    header('location: index.php');
}