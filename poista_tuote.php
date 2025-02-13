<?php
require_once 'inc/database.php';

$tuoteID = $_GET['tuoteID'] ?? null;

if (!$tuoteID) {
    die("Tuote ID puuttuu.");
}

$stmt = $pdo->prepare("DELETE FROM tuote WHERE tuoteID = :tuoteID");
$stmt->bindParam(':tuoteID', $tuoteID);
$stmt->execute();

header("Location: tuote.php");
exit;
?>
