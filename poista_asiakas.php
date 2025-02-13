<?php
    
    // Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.
    require_once "inc/database.php";

    if (!empty($_POST)) {
      
      //Haetaan valitun asiakkaan tiedot
      $asiakasID = $_POST['asiakasID'];

      //Poistetaan valitun asiakkaan tiedot
      $sql = "DELETE FROM asiakas WHERE asiakasID = :asiakasID";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':asiakasID', $_POST['asiakasID'], PDO::PARAM_INT);
      $stmt->execute();

      //Ohjataan käyttäjä asiakassivulle
      header("Location: asiakas.php");
      exit;
    } else {

      // Alustetaan asiakkaan tunnistava muuttuja
      $asiakasID = null;

      // Tarkistetaan, että onko asiakasID parametri välitetty GET-metodilla
      // Jos on niin tallennetaan arvo muuttujaan
      if ( !empty($_GET['asiakasID'])) {
          $asiakasID = $_REQUEST['asiakasID'];
      }

      // Jos asiakasID-parametriä ei välitetty, palautetaan käyttäjä takaisin asiakas.php sivulle
      if ( $asiakasID == null ) {
          header("Location: asiakas.php");
      }
      
      $sql = "SELECT asiakasID, CONCAT(etunimi, ' ', sukunimi) AS nimi 
                FROM asiakas
                WHERE asiakasID = :asiakasID";

      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':asiakasID', $asiakasID, PDO::PARAM_INT);
      $stmt->execute();

      $asiakas = $stmt->fetch(PDO::FETCH_OBJ);
      
      if ($asiakas === false) {
        header("Location: asiakas.php");
      }
    }
    ?>

    <?php
      include_once 'inc/header.php';
    ?>
        <h3>Asiakastietojen poistaminen</h3>
        <p>Haluatko varmasti poistaa asiakkaan, <?php echo $asiakas->nimi; ?>, tiedot?</p>
        <form action="poista_asiakas.php" method="post">
          <input type="hidden" name="asiakasID" value="<?php echo $asiakas->asiakasID; ?>">
          <button type="submit" class="btn btn-danger">Poista</button>
          <a href="asiakas.php" class="btn">Takaisin</a>
        </form>

    <?php
      include_once 'inc/footer.php';
    ?>