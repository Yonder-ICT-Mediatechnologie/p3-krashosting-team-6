<?php
require 'db.php';

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
                <a href="detailpaginaEasy.html" class="pakketLink">
                    <div class="pakketEasy">
                        <img src="../images/flowerPurple.svg" alt="flower" class="flower">
                        <h3 class="pakketTitle">Pakket 1</h3>
                        <p class="pakketName">Easy</p>
                    </div>
                </a>
                <a href="detailpaginaFunctionals.html" class="pakketLink">
                    <div class="pakketFunctionals">
                        <img src="../images/flowerBlue.svg" alt="flower" class="flower">
                        <h3 class="pakketTitle">Pakket 2</h3>
                        <p class="pakketName">Functionals</p>
                    </div>
                </a>
                <a href="detailpaginaPro.html" class="pakketLink">
                    <div class="pakketPro">
                        <img src="../images/flowerGreen.svg" alt="flower" class="flower">
                        <h3 class="pakketTitle">Pakket 3</h3>
                        <p class="pakketName">Pro</p>
                    </div>
                </a>
                <a href="detailpaginaHeavy.html" class="pakketLink">
                    <div class="pakketHeavy">
                        <img src="../images/flowerRed.svg" alt="flower" class="flower">
                        <h3 class="pakketTitle">Pakket 4</h3>
                        <p class="pakketName">Heavy User</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="newsHome">
            <div class="today">
                <h1 class="title">Vandaag</h1>
                <?php if (!empty($todayNews)): ?>
                    <?php foreach ($todayNews as $bericht): ?>
                        <p class="newsTxt"><strong><?= htmlspecialchars($bericht['titel']) ?></strong>: <?= htmlspecialchars($bericht['content']) ?></p>
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