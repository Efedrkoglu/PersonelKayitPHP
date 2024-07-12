<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ec9bc77c5e.js" crossorigin="anonymous"></script>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">PTS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Personel
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="personelList.php">Personel Listesi</a></li>
                <li><a class="dropdown-item" href="addPersonel.php">Personel Ekle</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="departmentPage.php">Departman</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gelir-Gider
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="gelirList.php">Gelir Tablosu</a></li>
                <li><a class="dropdown-item" href="giderList.php">Gider Tablosu</a></li>
                <li><a class="dropdown-item" href="addGelirGider.php">Gelir-Gider Ekle</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Analiz
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="gelirAnaliz.php">Gelir Analizi</a></li>
                <li><a class="dropdown-item" href="giderAnaliz.php">Gider Analizi</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </body>
</html>