<?php
session_start();

include 'function.php';

$conn = conndb();

if (!$conn) {
    header('Location: index.php');
}

if (!$_SESSION) {
    header('Location: index.php');
}

$id = $_GET['id']; //variable que guarda lo que sea por GET con el id

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //captar lo que llega mediante el formulario por post

    $proyecto = $_POST['project'];
    $date = $_POST['date'];
    $id = $_POST['id'];
    $time = $_POST['time'];
    $task = $_POST['task'];
    $descripcion = $_POST['description'];

    $statement = $conn->prepare("UPDATE proyectos SET proyecto = :proyecto, date = :date, time = :time, task = :task, descripcion = :descripcion WHERE id = :id");
    $statement->execute(array(
        ':proyecto' => $proyecto,
        ':date' => $date,
        ':time' => $time,
        ':task' => $task,
        ':descripcion' => $descripcion,
        ':id' => $id,
    ));

    header('Location: info.php'); //redirecciona a info.php

} else {
    
    $statement = $conn->prepare("SELECT * FROM proyectos WHERE id = :id LIMIT 1"); //para traer un solo proyecto
    $statement->execute(array(
        ':id' => $id,
    ));

    $resultado = $statement->fetchAll();

    if (empty($resultado)) {
        header('Location: config.php');
    }

    $resultado = $resultado[0]; //acceder al array posicion cero 

    //print_r($resultado);
}

include 'edit.view.php';
