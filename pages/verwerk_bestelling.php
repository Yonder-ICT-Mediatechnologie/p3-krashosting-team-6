<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pakket_id = $_POST['pakket_id'];
    $naam = trim($_POST['naam']);
    $email = trim($_POST['email']);
    $telefoon = trim($_POST['telefoon']);

    if (!empty($naam) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($telefoon)) {
        $stmt = $pdo->prepare("INSERT INTO bestellingen (pakket_id, naam, email, telefoon) VALUES (:pakket_id, :naam, :email, :telefoon)");
        $stmt->execute([
            'pakket_id' => $pakket_id,
            'naam' => $naam,
            'email' => $email,
            'telefoon' => $telefoon
        ]);

        header("Location: bedankt.php");
        exit;
    } else {
        echo "Vul alle velden correct in.";
    }
} else {
    echo "Ongeldige aanvraag.";
}
?>