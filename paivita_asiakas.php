
  	

      <?php

// Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.
require_once "inc/database.php";

if (!empty($_POST)) {
  //var_dump($_POST);

  //Luetaan lomakkeen lähettämät tiedot
  $henkilotunnus = $_POST['henkilotunnus'];
  $etunimi = $_POST['etunimi'];
  $sukunimi = $_POST['sukunimi'];
  $lahiosoite = $_POST['lahiosoite'];
  $postinumero = $_POST['postinumero'];
  $postitoimipaikka = $_POST['postitoimipaikka'];
  $sahkoposti = $_POST['sahkoposti'];
  $puhelin = $_POST['puhelin'];
  $asiakasID = $_POST['asiakasID'];
  
  // Puuttuvien kenttien ohjetekstit
  $henkilotunnusError = '';
  $etunimiError = '';
  $sukunimiError = '';
  $lahiosoiteError = '';
  $postinumeroError = '';
  $postitoimipaikkaError = '';
  $sahkopostiError = '';
  $puhelinError = '';

  //alustetaan tarkistusmuuttuja 
  // oletetaan, että tiedot on syötetty oikein
  $valid = true;

  if (empty($henkilotunnus)) {
    $henkilotunnusError = "Syötä henkilötunnus";
    $valid = false;
  } 

  if (empty($etunimi)) {
    $etunimiError = "Syötä etunimi";
    $valid = false;
  }

  if (empty($sukunimi)) {
    $sukunimiError = "Syötä sukunimi";
    $valid = false;
  }

  if (empty($lahiosoite)) {
    $lahiosoiteError = "Syötä lähiosoite";
    $valid = false;
  }

  if (empty($postinumero)) {
    $postinumeroError = "Syötä postinumero";
    $valid = false;
  }

  if (empty($postitoimipaikka)) {
    $postitoimipaikkaError = "Syötä postitoimipaikka";
    $valid = false;
  }

  if (empty($sahkoposti)) {
    $sahkopostiError = "Syötä sähköposti";
    $valid = false;
  }

  if (empty($puhelin)) {
    $puhelinError = "Syötä puhelinnumero";
    $valid = false;
  }

  if ($valid) {
    // Jos käyttäjä antanut kaikki tiedot,
    // niin tallennetaan ne tietokantaan
    $sql = "UPDATE asiakas 
              SET henkilotunnus = :henkilotunnus, etunimi = :etunimi, sukunimi = :sukunimi, lahiosoite = :lahiosoite, postinumero = :postinumero, postitoimipaikka = :postitoimipaikka, sahkoposti = :sahkoposti, puhelin = :puhelin
              WHERE asiakasID = :asiakasID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':henkilotunnus', $henkilotunnus, PDO::PARAM_STR);
    $stmt->bindParam(':etunimi', $etunimi, PDO::PARAM_STR);
    $stmt->bindParam(':sukunimi', $sukunimi, PDO::PARAM_STR);
    $stmt->bindParam(':lahiosoite', $lahiosoite, PDO::PARAM_STR);
    $stmt->bindParam(':postinumero', $postinumero, PDO::PARAM_STR);
    $stmt->bindParam(':postitoimipaikka', $postitoimipaikka, PDO::PARAM_STR);
    $stmt->bindParam(':sahkoposti', $sahkoposti, PDO::PARAM_STR);
    $stmt->bindParam(':puhelin', $puhelin, PDO::PARAM_STR);
    $stmt->bindParam(':asiakasID', $asiakasID, PDO::PARAM_INT);
    $stmt->execute();

    //ohjaus asiakastietoihin takaisin
    header("Location: asiakas.php");
    exit;
  }
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

  // Jos välitettiin, niin haetaan taulusta kyseisen asiakkaan tiedot data muuttujaan
  $sql = "SELECT * FROM asiakas WHERE asiakasID = :asiakasID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':asiakasID', $asiakasID, PDO::PARAM_INT);
  $stmt->execute();

  $asiakas = $stmt->fetch(PDO::FETCH_OBJ);
  
  //Luetaan asiakkaan tiedot kannasta
  $henkilotunnus = $asiakas->henkilotunnus;
  $etunimi = $asiakas->etunimi;
  $sukunimi = $asiakas->sukunimi;
  $lahiosoite = $asiakas->lahiosoite;
  $postinumero = $asiakas->postinumero;
  $postitoimipaikka = $asiakas->postitoimipaikka;
  $sahkoposti = $asiakas->sahkoposti;
  $puhelin = $asiakas->puhelin;
}
?>
<?php
    include_once 'inc/header.php';
?>
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Asiakastietojen päivittäminen</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-3">
          <input type="hidden" name="asiakasID" value="<?php echo $asiakasID; ?>">
          <div class="mb-3 row">
            <label for="etunimi" class="col-sm-3 col-form-label">Etunimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($etunimi)) ? $etunimi : ''; ?>" name="etunimi" class="form-control 
                <?php echo (!empty($etunimiError)) ? 'is-invalid' : ''; ?>" id="inputEtunimi">
              <?php if (!empty($etunimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $etunimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="sukunimi" class="col-sm-3 col-form-label">Sukunimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($sukunimi)) ? $sukunimi : ''; ?>" name="sukunimi" class="form-control <?php echo (!empty($sukunimiError)) ? 'is-invalid' : ''; ?>" id="inputSukunimi">
              <?php if (!empty($sukunimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $sukunimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="sahkoposti" class="col-sm-3 col-form-label">Sähköposti</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($sahkoposti)) ? $sahkoposti : ''; ?>" name="sahkoposti" class="form-control <?php echo (!empty($sahkopostiError)) ? 'is-invalid' : ''; ?>" id="inputSahkoposti">
              <?php if (!empty($sahkopostiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $sahkopostiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="henkilotunnus" class="col-sm-3 col-form-label">Henkilötunnus</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($henkilotunnus)) ? $henkilotunnus : ''; ?>" name="henkilotunnus" class="form-control <?php echo (!empty($henkilotunnusError)) ? 'is-invalid' : ''; ?>" id="inputHenkilotunnus">
              <?php if (!empty($henkilotunnusError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $henkilotunnusError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lahiosoite" class="col-sm-3 col-form-label">Lähiosoite</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($lahiosoite)) ? $lahiosoite : ''; ?>" name="lahiosoite" class="form-control <?php echo (!empty($lahiosoiteError)) ? 'is-invalid' : ''; ?>" id="inputLahiosoite">
              <?php if (!empty($lahiosoiteError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $lahiosoiteError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="postinumero" class="col-sm-3 col-form-label">Postinumero</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($postinumero)) ? $postinumero : ''; ?>" name="postinumero" class="form-control <?php echo (!empty($postinumeroError)) ? 'is-invalid' : ''; ?>" id="inputPostinumero">
              <?php if (!empty($postinumeroError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $postinumeroError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="postitoimipaikka" class="col-sm-3 col-form-label">Postitoimipaikka</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($postitoimipaikka)) ? $postitoimipaikka : ''; ?>" name="postitoimipaikka" class="form-control <?php echo (!empty($postitoimipaikkaError)) ? 'is-invalid' : ''; ?>" id="inputPostitoimipaikka">
              <?php if (!empty($postitoimipaikkaError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $postitoimipaikkaError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="puhelin" class="col-sm-3 col-form-label">Puhelin</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($puhelin)) ? $puhelin : ''; ?>" name="puhelin" class="form-control <?php echo (!empty($puhelinError)) ? 'is-invalid' : ''; ?>" id="inputPuhelin">
              <?php if (!empty($puhelinError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $puhelinError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Tallenna</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
      include_once 'inc/footer.php';
    ?>