<?php
require 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Geen pakket-id meegegeven.";
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM pakketten WHERE id = :id");
$stmt->execute(['id' => $id]);
$pakket = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pakket) {
    echo "Pakket niet gevonden.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bestelling - <?= htmlspecialchars($pakket['naam']) ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="newsHeader">
        <div class="newsLogo">
            <img src="../images/logo.svg" alt="" class="logo">
        </div>
        <nav class="navBar">
            <a href="index.php">Home</a>
            <a href="about.html">About</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contact</a>
            <button class="searchBtn"><img src="../images/search.svg" alt="Search" class="search"></button>
        </nav>
    </div>

    <div class="editContainer">
    <h1 class="title">Bestel het <?= htmlspecialchars($pakket['naam']) ?>-pakket</h1>
    <form action="verwerk_bestelling.php" method="POST">
        <input type="hidden" name="pakket_id" value="<?= htmlspecialchars($pakket['id']) ?>">
        
        <input type="text" name="naam" id="titel" placeholder="Naam" required>
        <br>
        <input type="email" name="email" id="titel" placeholder="E-mail" required>
        <br>
        <input type="tel" name="telefoon" id="titel" placeholder="Telefoon" required>
        <br><br>
        <button type="submit" class="orderBtn">Bestelling plaatsen</button>
    </form>
    </div>
</body>
</html>