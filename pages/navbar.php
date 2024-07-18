<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ec9bc77c5e.js" crossorigin="anonymous"></script>

</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand me-auto" href="home.php">PKTS</a>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">PKTS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
        <li class="nav-item">
            <a class="nav-link active mx-lg-2" href="home.php">Anasayfa</a>
          </li>
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
            <a class="nav-link mx-lg-2" href="departmentPage.php">Departman</a>
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
    <a href="../logout.php" class="logout-button btn btn-danger"><i class="fas fa-sign-out-alt"></i></a>
    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
<div class="container mt-5">
  <h4 style="visibility: hidden;">a</h4>
</div>


  

