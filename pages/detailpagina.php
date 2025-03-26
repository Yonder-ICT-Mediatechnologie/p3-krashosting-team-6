<?php
    require 'db.php';

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM pakketten WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $pakket = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pakket) {
        $voordelen = explode(",", $pakket['voordelen']);
    } else {
        echo "Pakket niet gevonden.";
        exit;
    }

    // Haal alle pakketten op voor de vergelijkings tabel
    $stmt = $pdo->query("SELECT * FROM pakketten");
    $pakketten = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Functie om de voordelen om te zetten naar een array
    function getVoordelenArray($voordelen) {
        return explode(",", $voordelen);
    }

    // Vergelijk de voordelen van alle pakketten
    $voordelenLijsten = [];
    foreach ($pakketten as $pakket) {
        $voordelenLijsten[] = getVoordelenArray($pakket['voordelen']);
    }

    // Bepaal het maximale aantal voordelen
    $maxVoordelen = max(array_map('count', $voordelenLijsten)); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Detailpagina Pakket <?= htmlspecialchars($pakket['naam']) ?></title>
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
                <h1 class="title">Pakket <?= $pakket['id'] ?> - <?= htmlspecialchars($pakket['naam']) ?></h1>
                <p class="pakketTekst">Dit zijn de voordelen van dit pakket:</p>
                <div class="voordelen">
                    <?php if (isset($voordelen)): ?>
                        <?php foreach ($voordelen as $voordeel): ?>
                            <p class="voordeelPakket"><img src="../images/checkOrange.svg" alt="" class="check"><?= htmlspecialchars($voordeel) ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Geen voordelen beschikbaar.</p>
                    <?php endif; ?>
                </div>

                <a href="" class="orderPakket">
                    <button class="orderPakketBtn">Bestel nu</button>
                </a>

                <h1 class="title">Waarom kiezen voor het <?= htmlspecialchars($pakket['naam']) ?>-pakket?</h1>
                <ul class="firstList">
                    <li>Lorem ipsum dolor sit amet - Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet - Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet - Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet - Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet - Lorem ipsum dolor sit amet</li>
                </ul>


                <h1 class="title">Vergelijk onze pakketten</h1>

            </div>
        </div>
        </div>

        <table class="dataTable">
            <thead class="tableHeader">
                <tr class="tableRow">
                    <th class="tableHeaderCell"></th>
                    <?php foreach ($pakketten as $pakket): ?>
                        <th class="tableHeaderCell"><?= htmlspecialchars($pakket['naam']) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody class="tableBody">
                <?php for ($i = 0; $i < $maxVoordelen; $i++): ?>
                    <tr class="tableRow">
                        <td class="tableCell" id="colOne"><?= 'Voordeel ' . ($i + 1) ?></td>
                        <?php foreach ($voordelenLijsten as $voordelen): ?>
                            <td class="tableCell">
                                <?php echo isset($voordelen[$i]) ? htmlspecialchars($voordelen[$i]) : ''; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
                <tr class="tableRow">
                    <td class="tableCell" id="colOne">Bekijken</td>
                    <?php foreach ($pakketten as $pakket): ?>
                        <td class="tableCell">
                            <a href="detailpagina.php?id=<?= $pakket['id'] ?>" class="view">Bekijken</a>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>

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