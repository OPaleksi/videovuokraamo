<?php
include_once 'inc/header.php'
?>  	
      <div class="container">
        <div class="row">
          <h3>Myyjatiedot</h3>
        </div>
        <div class="row">
          <p>
            <a href="lisaa_myyja.php" class="btn btn-success">Lisää</a>
          </p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>nimi</th>
                <th>käyttäjätunnus</th>
                <th>salasana</th>
                <th>Rooli</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                // Luodaan yhteys tietokantaan ja haetaan asiakas-taulusta
                // asiakkaiden tiedot omiin sarakkaisiin.
                // Lopuksi katkaistaan yhteys tietokantaan.

                require_once 'inc/database.php';
                $sql = "SELECT * FROM myyja";
                $result = $pdo->query($sql);
              ?>

              <?php while ($row = $result->fetch()) : ?>
                <tr>
                  <td> <?php echo $row['myyjaID']; ?> </td>
                  <td> <?php echo $row['etunimi']; ?> </td>
                  <td> <?php echo $row['kayttajatunnus']; ?> </td>
                  <td> <?php echo $row['salasana']; ?> </td>
                  <td> <?php echo $row['rooli']; ?> </td>
                  <td><a href="poista_myyja.php?myyjaID=<?php echo $row['myyjaID']; ?>" class="btn btn-danger">Poista</a>
                    <a href="paivita_myyja.php?myyjaID=<?php echo $row['myyjaID']; ?>" class="btn btn-success">Päivitä</a>
                    <a href="katso_myyja.php?myyjaID=<?php echo $row['myyjaID']; ?>" class="btn">Katso</a>
                  </td>
                </tr>
              <?php endwhile;
              unset($result);
              unset($pdo);
              ?>
            </tbody>
          </table>
        </div>
      </div>