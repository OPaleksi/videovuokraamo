
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Vuokraamo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if(tarkistaKirjautuminen()): ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="asiakas.php">Asiakas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="tuote.php">Tuote</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="myyja.php">Myyjä</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="vuokraus.php">Vuokraus</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="vuokralla.php">Vuokralla</a>
              </li>
            <?php endif; ?>
          </ul>
          <form class="d-flex me-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Hae" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Hae</button>
          </form>
          <?php if(tarkistaKirjautuminen()): ?>
            <a href="ulos.php" class="nav-link">Ulos <i class="bi bi-box-arrow-right"></i></a>
          <?php else: ?>
            <a href="kirjaudu.php" class="nav-link">Kirjaudu <i class="bi bi-box-arrow-in-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
