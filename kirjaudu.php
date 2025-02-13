    <?php 
      require_once "inc/header.php";
      require_once "inc/database.php";

      if( $_SERVER['REQUEST_METHOD'] == "POST" ){

          // luetaan tiedot lomakkeelta
          $kayttajatunnus = $_POST['kayttajatunnus'];
          $salasana = $_POST['salasana'];

          // alustetaan virheilmoitukset
          $kayttajatunnusError = '';
          $salasanaError = '';

          // oletetaan, että tiedot oikein
          $valid = true;

          if(empty($kayttajatunnus)){
              $valid = false;
              $kayttajatunnusError = "Syötä käyttäjätunnus";
          }

          if(empty($salasana)){
              $valid = false;
              $salasanaError = "Syötä salasana";
          }

          if( $valid ){

              $sql = "SELECT myyjaID, salasana
                      FROM myyja
                      WHERE kayttajatunnus = :kayttajatunnus";

              $stmt = $pdo->prepare($sql);
              $stmt->bindParam( ':kayttajatunnus', $kayttajatunnus, PDO::PARAM_INT );
              $stmt->execute();

              $myyja = $stmt->fetch( PDO::FETCH_OBJ );

              //var_dump($myyja);
              // tarkistetaan, että salasana on oikein
              if( password_verify( $salasana, $myyja->salasana )){

                  // nyt me voidaan määrittää istuntokohtaisia muuttujia
                  $_SESSION['kirjautunut'] = true;
                  $_SESSION['myyjaID'] = $myyja->myyjaID;
                  $_SESSION['kayttajatunnus'] = $kayttajatunnus;

                  header( "Location: asiakas.php" ); 
                  exit;
              } else {
                  $salasanaError = "Tarkista salasana";
                  $kayttajatunnusError = "Tarkista käyttäjätunnus";
              }

          }
      }
    ?>

    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card card-body bg-light mt-3">
                <h3>Kirjaudu</h3>

                <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="kayttajatunnus">Käyttäjätunnus</label>
                        <div class="col-sm-9">
                            <input type="text" name="kayttajatunnus" 
                            value="<?php echo ( !empty( $kayttajatunnus ) )? $kayttajatunnus: ''; ?>" id="inputKayttajatunnus" class="form-control 
                            <?php echo (!empty($kayttajatunnusError))?'is-invalid':''; ?>" >
                            <div class="invalid-feedback">
                                <small><?php echo $kayttajatunnusError; ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="salasana">Salasana</label>
                        <div class="col-sm-9">
                            <input type="password" name="salasana" id="inputSalasana"
                            value="<?php echo ( !empty( $salasana ) )? $salasana: ''; ?>"  class="form-control <?php echo (!empty($salasanaError))?'is-invalid':''; ?>">
                            <div class="invalid-feedback">
                                <small><?php echo $salasanaError; ?></small>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Kirjaudu</button>
            
                </form>
            </div>
        </div>
    </div>

    <?php
      require_once "inc/footer.php";