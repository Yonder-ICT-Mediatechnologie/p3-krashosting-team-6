<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $voordelen = implode("|", $_POST['voordelen']);

    $stmt = $pdo->prepare("INSERT INTO pakketten (naam, prijs, voordelen) VALUES (?, ?, ?)");
    $stmt->execute([$naam, $prijs, $voordelen]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pakket Toevoegen</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="newsHeader">
        <div class="newsLogo">
            <img src="../images/logo.svg" alt="" class="logo">
            <h1>Admin</h1>
        </div>
        <a href="logout.php">Logout</a>
    </div>

    <div class="editContainer">
        <h1 class="title">Pakket Toevoegen</h1>
        <form method="POST">
            <input type="text" name="naam" id="titel" placeholder="Naam" required> <br>
            <input type="number" step="0.01" name="prijs" id="titel" placeholder="Prijs (€)" required style="margin-bottom: 10px;"> <br>
            <label class="editLabel">Voordelen:</label> <br>
            <input type="text" name="voordelen[]" placeholder="Voordelen" id="titel" required> <br><br>
            <button type="submit" class="editBtn">Toevoegen</button>
            <a href="dashboard.php"><button type="button" class="editBtn">Annuleren</button></a>
        </form>
    </div>

    <footer class="footer">
        <div class="footerContainer">
            <div class="footerLogo">
                <img src="../images/logo.svg" alt="Logo" class="logoImg">
            </div>
            <p class="footerInfo">© 2025 KRAS HOSTING. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>