<?php
require 'db.php';

// Haal pakketten op uit de database
$stmt = $pdo->query("SELECT * FROM pakketten");
$pakketten = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Haal nieuws op uit de database
$stmt = $pdo->prepare("SELECT * FROM nieuws WHERE datum >= CURDATE() - INTERVAL 1 DAY ORDER BY datum DESC");
$stmt->execute();
$nieuws = $stmt->fetchAll(PDO::FETCH_ASSOC);

$todayNews = [];
$yesterdayNews = [];
foreach ($nieuws as $bericht) {
    if ($bericht['datum'] == date('Y-m-d')) {
        $todayNews[] = $bericht;
    } elseif ($bericht['datum'] == date('Y-m-d', strtotime('-1 day'))) {
        $yesterdayNews[] = $bericht;
    }
}

// Kleuren en bloemen arrays
$colors = ['#9C65D5', '#60B4D4', '#5BCA54', '#ED5E4B'];
$flowers = ['flowerPurple', 'flowerBlue', 'flowerGreen', 'flowerRed'];
$colorCount = count($colors);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Home</title>
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="navBackground">
        <div class="logo">
            <img src="../images/logo.svg" alt="Logo Kras Hosting" class="logoImg">
        </div>
        <nav class="navBar">
            <a href="index.php" class="active">Home</a>
            <a href="about.html">About</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contact</a>
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
        <div class="pakketContent">
            <div class="pakketTxt">
                <h1 class="title">Onze pakketten</h1>
                <p class="pakketTekst">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div id="pakketContainer">
                <?php foreach ($pakketten as $index => $pakket): 
                    $color = $colors[$index % $colorCount];
                    $flower = $flowers[$index % $colorCount];
                ?>
                    <a href="detailpagina.php?id=<?= $pakket['id'] ?>" class="pakketLink">
                        <div class="pakketBox" style="background-color: <?= $color ?>;">
                            <img src="../images/<?= $flower ?>.svg" alt="flower" class="flower">
                            <h3 class="pakketTitle">Pakket <?= $pakket['id'] ?></h3>
                            <p class="pakketName"><?= htmlspecialchars($pakket['naam']) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="newsHome">
            <div class="today">
                <h1 class="title">Vandaag</h1>
                <?php if (!empty($todayNews)): ?>
                    <?php foreach ($todayNews as $bericht): ?>
                        <p class="newsTxt"><strong><?= htmlspecialchars($bericht['titel']) ?></strong>: <br> <?= htmlspecialchars($bericht['content']) ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="newsTxt">Geen nieuws voor vandaag.</p>
                <?php endif; ?>
            </div>
            <div class="yesterday">
                <h1 class="title">Gisteren</h1>
                <?php if (!empty($yesterdayNews)): ?>
                    <?php foreach ($yesterdayNews as $bericht): ?>
                        <p class="newsTxt"><strong><?= htmlspecialchars($bericht['titel']) ?></strong>: <?= htmlspecialchars($bericht['content']) ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="newsTxt">Geen nieuws van gisteren.</p>
                <?php endif; ?>
            </div>
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
