<!doctype html>
<?php include('config.php'); ?>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
<div class="container">
<section class="login-form">
	<h2>Login</h2>
		<div class="login-form-form">
      <?php
       session_start();
       if (isset($_SESSION['tuvastamine']))  {
         header('Location: admin.php');
         exit();
         }
         //kontrollime kas vÄ†Ā¤ljad on tÄ†Ā¤idetud
       if (!empty($_POST['login']) && !empty($_POST['pass'])) {
       //eemaldame kasutaja sisestusest kahtlase pahna
       $login = htmlspecialchars(trim($_POST['login']));
       $pass = htmlspecialchars(trim($_POST['pass']));
       //SIIA UUS KONTROLL
       //kontrollime kas andmebaasis on selline kasutaja ja parool
       $paring = "SELECT * FROM kasutajad WHERE kasutaja='$login' AND parool='$pass'";
       $valjund = mysqli_query($yhendus, $paring);
       //kui on, siis loome sessiooni ja suuname
       if (mysqli_num_rows($valjund)==1) {
       $_SESSION['tuvastamine'] = 'misiganes';
          if(!empty($_POST["remember"])) {
            setcookie("member_login", 1, time()+7200);
            }
       header('Location: admin.php');
       } else {
       echo "Vale parool voi kasutaja nimi";
       }
       }
      ?>
      <form action="" method="post">
      Kasutaja: <input class="form-outline mb-4" type="text" name="login"><br>
       Password: <input class="form-outline mb-4" type="password" name="pass"><br>
       <div class="field-group">
         <div>
           <input type="checkbox" name="remember" id="remember">
           <?php
              if(isset($_COOKIE["member_login"])) {
                ?>  <?php
               }
                 ?>
              <lable for="remember-me">Pea mind meeles</lable>
         </div>

       </div>
       <input class="btn btn-success " type="submit" value="Logi sisse">
      </form>
		</div>
</section>
<a class="btn btn-warning  my-2 k" href="index.php">Mine tagasi avalehele</a>
</body>
</html>
