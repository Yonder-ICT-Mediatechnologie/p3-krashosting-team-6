<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require 'db.php';

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
    <div class="newsHeader">
        <div class="newsLogo">
            <img src="../images/logo.svg" alt="" class="logo">
            <h1>Admin - Dashboard</h1>
        </div>
        <a href="logout.php">Logout</a>
    </div>

    <div id="bodyContainer">
            <div class="pakketTxt" style="display: flex; gap: 975px; align-items: center;">
                <h1 class="title" style="margin-bottom: 0;">Nieuws</h1>
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
                        <tr><td colspan="4" style="text-align:center; padding-top: 10px;">Geen nieuwsberichten gevonden.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php
            $stmt = $pdo->query("SELECT * FROM pakketten");
            $pakketten = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div id="bodyContainer">
                <div class="pakketTxt" style="display: flex; gap: 935px; align-items: center;">
                    <h1 class="title">Pakketten</h1>
                    <a href="addPakket.php" class="addNewsBtn">+ Pakket toevoegen</a>
                </div>
            </div>

            <div class="newsTableContainer">
                <table class="newsTable">
                    <thead class="newsHead">
                        <tr class="newsRow">
                            <th class="newsHeadCell">Naam</th>
                            <th class="newsHeadCell">Prijs</th>
                            <th class="newsHeadCell">Bewerken</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pakketten as $pakket): ?>
                            <tr class="newsRow">
                                <td class="newsRowCell"><?= htmlspecialchars($pakket['naam']) ?></td>
                                <td class="newsRowCell">€<?= number_format($pakket['prijs'], 2) ?> / maand</td>
                                <td class="newsRowCell" id="deleteNews">
                                    <a href="editPakket.php?id=<?= $pakket['id'] ?>"><img src="../images/bewerkNews.svg" alt="Bewerk" class="deleteImg"></a> <br><br>
                                    <a href="deletePakket.php?id=<?= $pakket['id'] ?>" onclick="return confirm('Weet u zeker dat u dit pakket wilt verwijderen?');"><img src="../images/deleteNews.svg" alt="Verwijder" class="deleteImg"></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

    <div id="bodyContainer">
        <div class="pakketTxt" style="display: flex; gap: 925px; align-items: center;">
            <h1 class="title">Bestellingen</h1>
            <a href="bestellingen.php" class="addNewsBtn">Alle bestellingen</a>
        </div>
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