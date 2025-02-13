
  	
      <?php
        // Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.
        require_once "inc/database.php";

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

      ?>
  
    <?php
      include_once 'inc/header.php';
    ?>

          <div class="row">
            <div class="col-8 mx-auto">
              <div class="card card-body bg-light mt-3">
                <h3>Asiakastietojen päivittäminen</h3>
                <form class="mt-3">
                  <div class="mb-3 row">
                    <label for="etunimi" class="col-sm-3 col-form-label">Etunimi</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $etunimi; ?>" name="etunimi" class="form-control" id="inputEtunimi">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="sukunimi" class="col-sm-3 col-form-label">Sukunimi</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $sukunimi; ?>" name="sukunimi" class="form-control" id="inputSukunimi">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="sahkoposti" class="col-sm-3 col-form-label">Sähköposti</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $sahkoposti; ?>" name="sahkoposti" class="form-control" id="inputSahkoposti">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="henkilotunnus" class="col-sm-3 col-form-label">Henkilötunnus</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $henkilotunnus; ?>" name="henkilotunnus" class="form-control" id="inputHenkilotunnus">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="lahiosoite" class="col-sm-3 col-form-label">Lähiosoite</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $lahiosoite; ?>" name="lahiosoite" class="form-control" id="inputLahiosoite">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="postinumero" class="col-sm-3 col-form-label">Postinumero</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $postinumero; ?>" name="postinumero" class="form-control" id="inputPostinumero">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="postitoimipaikka" class="col-sm-3 col-form-label">Postitoimipaikka</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $postitoimipaikka; ?>" name="postitoimipaikka" class="form-control" id="inputPostitoimipaikka">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="puhelin" class="col-sm-3 col-form-label">Puhelin</label>
                    <div class="col-sm-9">
                      <input type="text" readonly value="<?php echo $puhelin; ?>" name="puhelin" class="form-control" id="inputPuhelin">
                    </div>
                  </div>
                  <div class="col-12">
                    <a href="asiakas.php" class="btn">Takaisin</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        
    <?php
      include_once 'inc/footer.php';
    ?>