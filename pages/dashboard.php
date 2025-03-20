<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require 'db.php';

// Nieuws ophalen
$stmt = $pdo->query("SELECT * FROM nieuws ORDER BY datum DESC");
$nieuws = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dashboard</title>
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="navBackground">
        <div class="logo">
            <img src="../images/logo.svg" alt="Logo Kras Hosting" class="logoImg">
        </div>
        <nav class="navBar">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="products.html">Products</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php">Logout</a>
            <button class="searchBtn"><img src="../images/search.svg" alt="Search" class="search"></button>
        </nav>
    </div>

    <div class="header">
        <div class="headerContent">
            <div class="service">HOSTING SERVICES</div>
            <div class="name">
                <h1 class="whiteName">KRAS</h1>
                <h1 class="orangeName">HOSTING</h1>
            </div>
        </div>
    </div>

    <div id="bodyContainer">
            <div class="pakketTxt" style="display: flex; gap: 889px;">
                <h1 class="title">Dashboard</h1>
                <a href="addNews.php" class="addNewsBtn">+ Bericht toevoegen</a>
            </div>
    </div>

    <div class="newsTableContainer">
            <table class="newsTable">
                <thead class="newsHead">
                    <tr class="newsRow">
                        <th class="newsHeadCell">Titel</th>
                        <th class="newsHeadCell">Bericht</th>
                        <th class="newsHeadCell">Datum</th>
                        <th class="newsHeadCell">Bewerken</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($nieuws) > 0): ?>
                        <?php foreach ($nieuws as $bericht): ?>
                            <tr class="newsRow">
                                <td class="newsRowCell"><?= htmlspecialchars($bericht['titel']) ?></td>
                                <td class="newsRowCell"><?= htmlspecialchars($bericht['content']) ?></td>
                                <td class="newsRowCell"><?= htmlspecialchars($bericht['datum']) ?></td>
                                <td class="newsRowCell" id="deleteNews">
                                    <a href="editNews.php?id=<?= $bericht['id'] ?>"><img src="../images/bewerkNews.svg" alt="" class="deleteImg"></a> <br><br><br><br>
                                    <a href="deleteNews.php?id=<?= $bericht['id'] ?>" onclick="return confirm('Weet u zeker dat u dit bericht wilt verwijderen?');"><img src="../images/deleteNews.svg" alt="" class="deleteImg"></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center;">Geen nieuwsberichten gevonden.</td></tr>
                    <?php endif; ?>
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