<?php
session_start();
include 'function.php';

$conn = conndb();

$error = "";

if (!$conn) {
    die();
    header('Location: index.php');
}

if (!$_SESSION) {
    header('Location: index.php');  
}

// Trayendo proyectos de x usuario en base al email

$usuario = $_SESSION['User']; //variable que guarda email del usuario

$statement = $conn->prepare("SELECT * FROM proyectos WHERE usuario = :usuario"); //Consulta sql
$statement->execute(array(
    ':usuario' => $usuario,
));

$resultados = $statement->fetchAll();

if (empty($resultados)) {
    $error .= "Su usuario no cuenta con proyectos almacenados";
} 




include 'config.view.php';
