<?php
session_start();
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM pakketten WHERE id = ?");
$stmt->execute([$id]);
$pakket = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pakket) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $voordelen = implode("|", $_POST['voordelen']);

    $stmt = $pdo->prepare("UPDATE pakketten SET naam=?, prijs=?, voordelen=? WHERE id=?");
    $stmt->execute([$naam, $prijs, $voordelen, $id]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pakket Bewerken</title>
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
        <h1 class="title">Pakket Bewerken</h1>
        <form method="POST">
            <input type="text" id="titel" name="naam" value="<?= htmlspecialchars($pakket['naam']) ?>" required> <br>
            <input type="number" step="0.01" id="titel" name="prijs" value="<?= $pakket['prijs'] ?>" required style="margin-bottom: 10px;"> <br>

            <label class="editLabel">Voordelen:</label> <br>
            <?php foreach (explode("|", $pakket['voordelen']) as $voordeel): ?>
                <input type="text" id="titel" name="voordelen[]" value="<?= htmlspecialchars($voordeel) ?>"> <br>
            <?php endforeach; ?>

            <br>

            <button type="submit" class="editBtn">Opslaan</button>
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