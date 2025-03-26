<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM pakketten WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: dashboard.php?status=success");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van het pakket.";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>