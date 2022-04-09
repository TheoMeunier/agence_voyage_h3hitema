<?php

function findAll(string $table)
{
    include '../../db.php';
    $data = $pdo->query("SELECT * FROM " .$table. " ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function find(string $table, int $id)
{
    $query = $pdo->prepare("SELECT id,name FROM '$table' WHERE id = :id");
    $query->excute(['id' => $id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function create(string $table, array $data)
{
    $sqlFields = [];

    foreach ($data as $key => $value) {
        $sqlFields[] = "$key = :$key";
    }

    $query = $pdo->prepare("INSERT INTO '$table' SET " . implode(', ', $sqlFields));
    $query->execute($data);
}

function update(string $table, array $data, int $id)
{
    $sqlFields = [];
    foreach ($data as $key => $value){
        $sqlFields[] = "$key = :$key";
    }
    $query = $pdo->prepare("UPDATE '$table' SET " . implode(', ', $sqlFields) .
        " WHERE id = :id");
    $query->execute(array_merge($data, ['id' => $id]));
}

function delete(string $table, int $id)
{
    include '../../db.php';
    $query = $pdo->prepare("DELETE FROM ". $table . " WHERE id = ?");
    $query->execute([$id]);
}