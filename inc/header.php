    <?php 
      session_start();
      require_once 'funktiot.php';

      $sivu = basename($_SERVER['PHP_SELF']);
      
      if( $sivu != 'index.php' && $sivu != 'kirjaudu.php' ){
        if(!tarkistaKirjautuminen()){
          header("Location: index.php");
          exit;
        }
      } 
    ?>

    <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vuokraamo</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/carousel.css">
      </head>
      <body>
        <?php include_once 'nav.php'; ?>
        <div class="container">