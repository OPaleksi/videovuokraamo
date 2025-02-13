<?php
require_once 'inc/database.php';

$tuoteID = $_GET['tuoteID'] ?? null;

if (!$tuoteID) {
    die("Tuote ID puuttuu.");
}

$stmt = $pdo->prepare("SELECT * FROM tuote WHERE tuoteID = :tuoteID");
$stmt->bindParam(':tuoteID', $tuoteID);
$stmt->execute();
$tuote = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tuote) {
    die("Tuotetta ei löytynyt.");
}

include_once 'inc/header.php';
?>

<div class="container mt-5">
    <h3>Tuotteen tiedot</h3>
    <p><strong>Nimi:</strong> <?php echo htmlspecialchars($tuote['nimi']); ?></p>
    <p><strong>Kuvaus:</strong> <?php echo htmlspecialchars($tuote['kuvaus']); ?></p>
    <p><strong>Kpl:</strong> <?php echo $tuote['kpl']; ?></p>
    <p><strong>Painoraja:</strong> <?php echo $tuote['painoraja']; ?> kg</p>
    <p><strong>Kuva:</strong> <img src="img/<?php echo htmlspecialchars($tuote['kuva']); ?>" alt="<?php echo htmlspecialchars($tuote['nimi']); ?>" width="200"></p>
    <a href="tuote.php" class="btn btn-secondary">Takaisin</a>
</div>

<?php include_once 'inc/footer.php'; ?>
