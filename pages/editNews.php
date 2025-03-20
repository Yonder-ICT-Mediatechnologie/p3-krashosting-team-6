<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM nieuws WHERE id = ?");
$stmt->execute([$id]);
$bericht = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$bericht) {
    echo "Bericht niet gevonden.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = $_POST['titel'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE nieuws SET titel = ?, content = ? WHERE id = ?");
    $stmt->execute([$titel, $content, $id]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bericht bewerken</title>
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
    <h1 class="title">Bericht bewerken</h1>
        <form action="" method="post" class="editForm">
            <label for="titel" class="editLabel">Titel:</label><br>
            <input type="text" name="titel" id="titel" value="<?= htmlspecialchars($bericht['titel']) ?>" required><br><br>

            <label for="content" class="editLabel">Bericht:</label><br>
            <textarea name="content" id="content" rows="6" required><?= htmlspecialchars($bericht['content']) ?></textarea><br><br>

            <input type="submit" value="Bijwerken" class="editBtn">
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
