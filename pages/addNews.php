<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = $_POST['titel'];
    $content = $_POST['content'];
    $datum = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO nieuws (titel, content, datum, status) VALUES (?, ?, ?, 'concept')");
    $stmt->execute([$titel, $content, $datum]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuw bericht toevoegen</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="editContainer">
        <h1 class="title">Nieuw bericht toevoegen</h1>
        <form action="" method="post">
            <label for="titel">Titel:</label><br>
            <input type="text" name="titel" id="titel" required><br><br>

            <label for="content">Bericht:</label><br>
            <textarea name="content" id="content" rows="6" required></textarea><br><br>

            <input type="submit" value="Opslaan" class="editBtn">
            <a href="dashboard.php"><button type="button" class="editBtn">Annuleren</button></a>
        </form>
    </div>
</body>
</html>