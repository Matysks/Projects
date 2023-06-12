<?php
include('config.php');

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    printf("Ühenduse viga: %s\n", mysqli_connect_error());
    exit();
}

$nimi = mysqli_real_escape_string($db, $_POST['nimi']);
$pere = mysqli_real_escape_string($db, $_POST['pere']);
$klass = mysqli_real_escape_string($db, $_POST['klass']);
$email = mysqli_real_escape_string($db, $_POST['email']);

$result = mysqli_query($db, "SELECT * FROM uuemoisa WHERE email='$email'");
if (mysqli_num_rows($result) > 0) {
    echo "Kasutaja selle e-posti aadressiga on juba registreeritud.";
} else {
    $sql = "INSERT INTO uuemoisa (nimi, perekonnanimi, voistlusklass, email) VALUES ('$nimi', '$pere', '$klass', '$email')";

    if (mysqli_query($db, $sql)) {
        echo "Olete edukalt registreerunud!";
    } else {
        printf("Viga: %s\n", mysqli_error($db));
    }
}

mysqli_close($db);
?>