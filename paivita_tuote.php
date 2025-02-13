<?php
require_once 'inc/database.php';

$tuoteID = $_GET['tuoteID'] ?? null;

if (!$tuoteID) {
    die("Tuote ID puuttuu.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nimi = $_POST['nimi'];
    $kuvaus = $_POST['kuvaus'];
    $kpl = intval($_POST['kpl']);
    $painoraja = intval($_POST['painoraja']);
    $kuva = $_FILES['kuva']['name'];

    $valid = true;

    if (empty($nimi)) {
        $valid = false;
        $nimiError = "Syötä nimi";
    }
    if (empty($kuvaus)) {
        $valid = false;
        $kuvausError = "Syötä kuvaus";
    }
    if (empty($kuva)) {
        $valid = false;
        $kuvaError = "Lisää kuva";
    }
    if (!is_int($kpl) || ($kpl < 1 || $kpl > 20)) {
        $valid = false;
        $kplError = "Syötä kappalemäärä väliltä 1-20";
    }

    if ($valid) {
        $tmp_name = $_FILES['kuva']['tmp_name'];
        move_uploaded_file($tmp_name, 'img/' . $kuva);

        $sql = "UPDATE tuote SET nimi = :nimi, kuvaus = :kuvaus, kpl = :kpl, painoraja = :painoraja, kuva = :kuva WHERE tuoteID = :tuoteID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nimi', $nimi);
        $stmt->bindParam(':kuvaus', $kuvaus);
        $stmt->bindParam(':kpl', $kpl);
        $stmt->bindParam(':painoraja', $painoraja);
        $stmt->bindParam(':kuva', $kuva);
        $stmt->bindParam(':tuoteID', $tuoteID);
        $stmt->execute();

        header("Location: tuote.php");
        exit;
    }
} else {
    $stmt = $pdo->prepare("SELECT * FROM tuote WHERE tuoteID = :tuoteID");
    $stmt->bindParam(':tuoteID', $tuoteID);
    $stmt->execute();
    $tuote = $stmt->fetch(PDO::FETCH_ASSOC);

    $nimi = $tuote['nimi'];
    $kuvaus = $tuote['kuvaus'];
    $kpl = $tuote['kpl'];
    $painoraja = $tuote['painoraja'];
    $kuva = $tuote['kuva'];
}
?>
<?php
    include_once 'inc/header.php';
?>