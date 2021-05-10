<?php
session_start();
include 'function.php';

$conn = conndb();

if (!$conn) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') { //si el metodo capta un valor por GET
    $id = $_GET['id']; 

    $statement = $conn->prepare("DELETE FROM proyectos WHERE id = :id"); //consulta sql que borra el proyecto mediante el id
    $statement->execute(array(
        ':id' => $id,
    ));

    header('Location: config.php');
}
