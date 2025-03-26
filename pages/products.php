<?php
session_start();
require 'db.php';

$stmt = $pdo->query("SELECT * FROM pakketten");
$pakketten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Products</title>
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="navBackground">
        <div class="logo">
            <img src="../images/logo.svg" alt="Logo Kras Hosting" class="logoImg">
        </div>
        <nav class="navBar">
            <a href="index.php">Home</a>
            <a href="about.html">About</a>
            <a href="products.php" class="active">Products</a>
            <a href="contact.php">Contact</a>
            <button class="searchBtn"><img src="../images/search.svg" alt="Search" class="search"></button>
        </nav>
    </div>
    <div class="header">
        <div class="headerContent">
            <div class="service">
                HOSTING SERVICES
            </div>
            <div class="name">
                <h1 class="whiteName">KRAS</h1>
                <h1 class="orangeName">HOSTING</h1>
            </div>
        </div>
    </div>

    <div id="bodyContainer">
        <div class="pakketContent">
            <div class="pakketTxt">
                <h1 class="title">Products</h1>
            </div>
        </div>
    </div>

    <div class="pakketten">
        <?php 
        $colors = ['#9C65D5', '#60B4D4', '#5BCA54', '#ED5E4B'];
        $flowers = ['flowerPurple', 'flowerBlue', 'flowerGreen', 'flowerRed'];
        $colorCount = count($colors);
        
        foreach ($pakketten as $index => $pakket): 
            $color = $colors[$index % $colorCount]; 
            $flower = $flowers[$index % $colorCount];
        ?>
            <div class="pakketEen" style="background-color: <?= $color ?>;">
                <div class="productTitle">
                    <img src="../images/<?= $flower ?>.svg" alt="flower" class="productFlower">
                    Pakket <?= $pakket['id'] ?> - <?= htmlspecialchars($pakket['naam']) ?>
                </div>
                <div class="productZin">Lorem ipsum dolor sit amet</div>
                <div class="pakketVoordelen">
                    <div class="voordeel">
                        <img src="../images/check.svg" alt="Check" class="check">Lorem ipsum dolor sit amet
                    </div>
                    <div class="voordeel">
                        <img src="../images/check.svg" alt="Check" class="check">Lorem ipsum dolor sit amet
                    </div>
                    <div class="voordeel">
                        <img src="../images/check.svg" alt="Check" class="check">Lorem ipsum dolor sit amet
                    </div>
                </div>
                <a href="detailpagina.php?id=<?= $pakket['id'] ?>" class="orderBtn">
                    <button class="productOrder">Bekijken</button>
                </a>
            </div>
        <?php endforeach; ?>
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