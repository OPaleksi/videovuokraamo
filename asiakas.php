    <?php
      include_once 'inc/header.php';
    ?>
  	
      <div class="container">
        <div class="row">
          <h3>Asiakastiedot</h3>
        </div>
        <div class="row">
          <p>
            <a href="lisaa_asiakas.php" class="btn btn-success">Lisää</a>
          </p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Etunimi</th>
                <th>Sukunimi</th>
                <th>Sähköposti</th>
                <th>Toiminto</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                // Luodaan yhteys tietokantaan ja haetaan asiakas-taulusta
                // asiakkaiden tiedot omiin sarakkaisiin.
                // Lopuksi katkaistaan yhteys tietokantaan.

                require_once 'inc/database.php';
                $sql = "SELECT * FROM asiakas";
                $result = $pdo->query($sql);
              ?>

              <?php while ($row = $result->fetch()) : ?>
                <tr>
                  <td> <?php echo $row['asiakasID']; ?> </td>
                  <td> <?php echo $row['etunimi']; ?> </td>
                  <td> <?php echo $row['sukunimi']; ?> </td>
                  <td> <?php echo $row['sahkoposti']; ?> </td>
                  <td><a href="poista_asiakas.php?asiakasID=<?php echo $row['asiakasID']; ?>" class="btn btn-danger">Poista</a>
                    <a href="paivita_asiakas.php?asiakasID=<?php echo $row['asiakasID']; ?>" class="btn btn-success">Päivitä</a>
                    <a href="katso_asiakas.php?asiakasID=<?php echo $row['asiakasID']; ?>" class="btn">Katso</a>
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