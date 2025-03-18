<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
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
        <div class="pakketContent">
            <div class="pakketTxt">
                <h1 class="title">Dashboard</h1>
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