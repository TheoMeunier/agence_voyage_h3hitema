<?php

function isSubmit()
{
    return isset($_POST['submit']);
}

function findAll(string $table, string $orderBy = 'id')
{
    include '../../db.php';
    $query = "SELECT * FROM $table ORDER BY $orderBy ASC";

    if (isset($_POST['search-submit'])){

        $search = $_POST['search'];
    
        if (!empty($search)){
            $query = "SELECT * FROM $table WHERE name LIKE '%$search%' ORDER BY name ASC";
        }
    }

    $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function find(string $table, int $id)
{
    include '../../db.php';
    $query = $pdo->prepare("SELECT * FROM $table WHERE id = :id ");
    $query->execute(['id' => $id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function findWhere(string $table, string $where, string $value)
{
    include '../../db.php';
    $query = $pdo->query("SELECT id,$where FROM $table WHERE $where = '$value'");
    return $query;
}

function create(string $table, array $data)
{
    include '../../db.php';
    $sqlFields = [];

    foreach ($data as $key => $value) {
        $sqlFields[] = "$key = :$key";
    }

    $query = $pdo->prepare("INSERT INTO $table SET " . implode(', ', $sqlFields));
    if ($query->execute(array_merge($data))){
        alert('success', "L'élément à bien été créé");
    } else{
        alert('error', "L'élément n'a pas pu être créé");
    }
}

function update(string $table, array $data, int $id)
{
    include '../../db.php';
    $sqlFields = [];
    foreach ($data as $key => $value){
        $sqlFields[] = "$key = :$key";
    }
    $query = $pdo->prepare("UPDATE $table SET " . implode(', ', $sqlFields) .
        " WHERE id = :id");
    if ($query->execute(array_merge($data, ['id' => $id]))){
        alert('success', "L'élément à bien été modifié");
    } else{
        alert('error', "L'élément n'a pas pu être modifié");
    }
}

function delete(string $table, int $id)
{
    include '../../db.php';
    $query = $pdo->prepare("DELETE FROM ". $table . " WHERE id = ?");
    if ($query->execute([$id])){
        alert('success', "L'élément à bien été supprimé");
    } else{
        alert('error', "L'élément n'a pas pu être supprimé");
    }
    header('location:index.php');
}

function getValues():array
{
    return $_POST;
}

function Exist(string $table, string $where, string $value)
{
    $exist = false;
    $data = findWhere($table, $where, $value)->rowCount();
    if ($data > 0){
        $exist = true;
    }
    return $exist;
}