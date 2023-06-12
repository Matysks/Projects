<?php include('config.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Avaleht</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

  <header>
    <h1>Uuemõisa Miil 2023</h1>
  </header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Avaleht</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="galerii.php">Galerii</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php">Kontakt</a>
                    </li>
                    <!-- Login nupp -->
                    <li class="nav-item">
                        <a class="btn btn-success mx-2" href="login.php">Logi sisse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <?php 
include('config.php'); 

// Ühendus andmebaasiga
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    printf("Ühenduse viga: %s\n", mysqli_connect_error());
    exit();
}

// Võta vastu kasutaja sisestatud andmed
$nimi = mysqli_real_escape_string($db, $_POST['nimi']);
$pere = mysqli_real_escape_string($db, $_POST['pere']);
$klass = mysqli_real_escape_string($db, $_POST['klass']);
$email = mysqli_real_escape_string($db, $_POST['email']);

// Kontrolli, kas kasutaja juba eksisteerib
$result = mysqli_query($db, "SELECT * FROM uuemoisa WHERE email='$email'");
if (mysqli_num_rows($result) > 0) {
    echo "Kasutaja selle e-posti aadressiga on juba registreeritud.";
} else {
    // Lisa uus kasutaja andmebaasi
    $sql = "INSERT INTO uuemoisa (nimi, perekonnanimi, voistlusklass, email) VALUES ('$nimi', '$pere', '$klass', '$email')";

    if (mysqli_query($db, $sql)) {
        echo "Olete edukalt registreerunud!";
    } else {
        printf("Viga: %s\n", mysqli_error($db));
    }
}

mysqli_close($db);
?>
  <main>
    <div class="container mt-5">
        <h2>Registreeri Uuemõisa miili</h2>
        <form action="registreerimine.php" method="POST">
            <div class="mb-3">
                <label for="eesnimi" class="form-label">Eesnimi</label>
                <input type="text" class="form-control" id="eesnimi" name="eesnimi" required>
            </div>
            <div class="mb-3">
                <label for="perenimi" class="form-label">Perekonnanimi</label>
                <input type="text" class="form-control" id="perenimi" name="perenimi" required>
            </div>
            <div class="mb-3">
                <label for="voistlusklass" class="form-label">Võistlusklass</label>
                <input type="number" class="form-control" id="voistlusklass" name="voistlusklass" min="1" max="100" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-posti aadress</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Registreeri</button>
        </form>
    </div>
</main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <footer>
    <p>&copy; 2023 Uuemõisa Miil</p>
  </footer>

</body>
</html>