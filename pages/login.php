<?php
session_start();

$valid_username = "admin";
$valid_password = "wachtwoord123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
    <link rel="icon" href="../images/logo.svg" type="image/svg+xml">
</head>
<body>
    <div class="navLoginBackground">
        <div class="logo">
            <img src="../images/logo.svg" alt="Logo Kras Hosting" class="logoImg">
        </div>
        <nav class="navBar">
            <a href="index.php">Home</a>
            <a href="about.html">About</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contact</a>
            <button class="searchBtn"><img src="../images/search.svg" alt="Search" class="search"></button>
        </nav>
    </div>

    <div id="bodyContainer">
        <div class="pakketContent">
            <div class="pakketTxt">
                <h1 class="title">Login</h1>
            </div>
        </div>
    </div>

    <div class="loginFormContainer">
        <form action="" method="POST" class="loginForm">
            <?php if (!empty($error)): ?>
                <p style="color: red; text-align: center;"><?php echo $error; ?></p>
            <?php endif; ?>
            <input type="text" name="username" id="username" placeholder="Gebruikersnaam" required>
            <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
            <input type="submit" name="versturen" id="submit" value="Inloggen">
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