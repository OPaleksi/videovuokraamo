    <?php
        include_once 'inc/header.php';
    ?>
        <div class="row">
          <h3>tuotetiedot</h3>
        </div>
        <div class="row">
          <p>
            <a href="lisaa_tuote.php" class="btn btn-success">Lisää</a>
          </p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nimi</th>
                <th>Kpl</th>
                <th>Painoraja</th>
                <th>Kuva</th>
                <th>Toiminnot</th>
              </tr>
            </thead>
            <tbody>
              <?php
                //Luodaan yhteys tietokantaan ja haetaan tuotetietoja
                require_once 'inc/database.php';
                $sql = "SELECT * FROM tuote";
                $result = $pdo->query($sql);
                while($row = $result->fetch()):
              ?>
                <tr>
                  <td><?php echo $row['tuoteID']; ?></td>
                  <td><?php echo $row['nimi']; ?></td>
                  <td><?php echo $row['kpl']; ?></td>
                  <td><?php echo $row['painoraja']; ?></td>
                  <td><?php echo $row['kuva']; ?></td>
                  <td>
                    <a href="poista_tuote.php?tuoteID=<?php echo $row['tuoteID'];?>" class="btn btn-danger">Poista</a>
                    <a href="paivita_tuote.php?tuoteID=<?php echo $row['tuoteID'];?>" class="btn btn-success">Päivitä</a>
                    <a href="katso_tuote.php?tuoteID=<?php echo $row['tuoteID'];?>" class="btn">Katso</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        include_once 'inc/footer.php';