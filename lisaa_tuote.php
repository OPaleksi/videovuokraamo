    <?php
      include_once 'inc/header.php';
      require_once 'inc/database.php';

      if (!empty($_POST)) {

        $nimi = $_POST['nimi'];
        $kuvaus = $_POST['kuvaus'];
        $kpl = intval($_POST['kpl']);
        $painoraja = intval($_POST['painoraja']);
        $kuva = $_FILES['kuva']['name'];

        // tarkistetaan tietojen oikeeellisuus
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

        if (!is_int($kpl) || ( $kpl < 1 || $kpl > 20)) {
          $valid = false;
          $kplError = "Syötä kappalemäärä väliltä 1-20";
        }
        
        if ($valid) {

          $tmp_name = $_FILES['kuva']['tmp_name'];
          move_uploaded_file($tmp_name, 'img/' . $kuva);

          $sql = "INSERT INTO tuote (nimi, kuvaus, kpl, painoraja, kuva) VALUES (:nimi, :kuvaus, :kpl, :painoraja, :kuva);";

          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':nimi', $nimi);
          $stmt->bindParam(':kuvaus', $kuvaus);
          $stmt->bindParam(':kpl', $kpl);
          $stmt->bindParam(':painoraja', $painoraja);
          $stmt->bindParam(':kuva', $kuva);
          $stmt->execute();

          header("Location: tuote.php");
          exit;
        }
      } else {

        //yleiset ohjetekstit
        $nimiError = 'Syötä nimi';
        $kuvausError = 'Syötä kuvaus';
        $kplError = 'Syötä kpl-määrä väliltä 1-20';
        $painorajaError = 'Syötä painoraja väliltä 5-300';
        $kuvaError = "Lisää kuva";

      }

      ?>
      <div class="row">
        <div class="col-8 mx-auto">
          <div class="card card-body bg-light mt-3">
            <h3>Tuotetietojen lisääminen</h3>

            <form method="post" enctype="multipart/form-data"
            class="needs-validation" novalidate>

              <div class="mb-3">
                <label for ="nimi" class="form-label">Nimi</label>
                <input type = "text" 
                value = "<?php echo (!empty($nimi)) ? $nimi : ''; ?>" 
                class = "form-control 
                <?php echo (!empty($_POST) && !empty($nimiError)) ? 'is-invalid' : ''; ?>" 
                id = "nimi" 
                name = "nimi" 
                aria-describedby=""
                required
                >
                <div class="invalid-feedback">
                  <small><?php echo $nimiError ?? ''; ?></small>
                </div>
              </div>

              <div class="mb-3">
                <label for="kuvaus" class="form-label">Kuvaus</label>
                <textarea 
                class="form-control 
                <?php echo (!empty($_POST) && !empty($kuvausError)) ? 'is-invalid' : ''; ?>" 
                name="kuvaus" id="kuvaus" rows="5" required
                ><?php echo (!empty($kuvaus)) ? $kuvaus : ''; ?></textarea>
                <div class="invalid-feedback">
                  <small><?php echo $kuvausError ?? ''; ?></small>
                </div>
              </div>

              <div class="mb-3">
                <label for="kpl" class="form-label">Kpl</label>
                <input type="number" value="<?php echo (empty($kpl)) ? $kpl : ''; ?>" class="form-control 
                <?php echo (!empty($_POST) && !empty($kplError)) ? 'is-invalid' : ''; ?>" 
                id="kpl" name="kpl" aria-describedby="" required>
                <div class="invalid-feedback">
                  <small><?php echo $kplError ?? ''; ?></small>
                </div>
              </div>

              <div class="mb-3">
                <label for="painoraja" class="form-label">Painoraja</label>
                <input type="number" value="<?php echo (!empty($painoraja)) ? $painoraja : ''; ?>" class="form-control 
                <?php echo (!empty($_POST) && !empty($painorajaError)) ? 'is-invalid' : ''; ?>" 
                id="painoraja" name="painoraja" aria-describedby="" required>
                <div class="invalid-feedback">
                  <small><?php echo $painorajaError ?? ''; ?></small>
                </div>
              </div>

              <div class="mb-3">
                <label for="kuva" class="form-label">Kuva</label>
                <input type="file" value="<?php echo (!empty($kuva)) ? $kuva : ''; ?>" class="form-control 
                <?php echo (!empty($_POST) && !empty($kuvaError)) ? 'is-invalid' : ''; ?>" 
                id="kuva" name="kuva" aria-describedby="" required>
                <div class="invalid-feedback">
                  <small><?php echo $kuvaError ?? ''; ?></small>
                </div>
              </div>

              <button type="submit" class="btn btn-primary ">Tallenna</button>
              <a href="tuote.php" class="btn float-end">Takaisin</a>

            </form>
          </div>
        </div>
      </div>
      <?php
      include_once 'inc/footer.php';