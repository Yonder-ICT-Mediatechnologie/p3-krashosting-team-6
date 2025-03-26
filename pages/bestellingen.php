<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require 'db.php';

$stmt = $pdo->query("SELECT b.id, b.naam, b.email, b.telefoon, p.naam AS pakket_naam, p.prijs, b.besteld_op 
                     FROM bestellingen b 
                     JOIN pakketten p ON b.pakket_id = p.id 
                     ORDER BY b.besteld_op DESC");

$bestellingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bestellingen</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="newsHeader">
        <div class="newsLogo">
            <img src="../images/logo.svg" alt="" class="logo">
            <h1>Admin - Bestellingen</h1>
        </div>
        <a href="logout.php">Logout</a>
    </div>


    <div id="bodyContainer">
        <div class="pakketTxt" style="display: flex; gap: 922px; align-items: center;">
            <h1 class="title">Alle Bestellingen</h1>
            <a href="dashboard.php" class="addNewsBtn">⬅ Terug</a>
        </div>
    </div>

    <div class="newsTableContainer">
        <table class="newsTable">
            <thead class="newsHead">
                <tr class="newsRow">
                    <th class="newsHeadCell">Naam</th>
                    <th class="newsHeadCell">E-mail</th>
                    <th class="newsHeadCell">Telefoon</th>
                    <th class="newsHeadCell">Pakket</th>
                    <th class="newsHeadCell">Prijs</th>
                    <th class="newsHeadCell">Datum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bestellingen as $bestelling): ?>
                    <tr lcass="newsRow">
                        <td class="newsRowCell"><?= htmlspecialchars($bestelling['naam']) ?></td>
                        <td class="newsRowCell"><?= htmlspecialchars($bestelling['email']) ?></td>
                        <td class="newsRowCell"><?= htmlspecialchars($bestelling['telefoon']) ?></td>
                        <td class="newsRowCell"><?= htmlspecialchars($bestelling['pakket_naam']) ?></td>
                        <td class="newsRowCell">€<?= number_format($bestelling['prijs'], 2) ?></td>
                        <td class="newsRowCell"><?= htmlspecialchars($bestelling['besteld_op']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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