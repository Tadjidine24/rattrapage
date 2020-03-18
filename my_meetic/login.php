<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>LOVA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mon_css2.css">
    <meta name="theme-color" content="#fafafa">
  </head>
<body>
      <div class="backimage"> 
    <h1>Live Meetings</h1>
    <div class="form">
      <form class="formulaire"  method="post" action="./bienvenue.php">

        <div class="block">
          <label class="label2" for="email">Email :</label>
          <input class="form-text" type="email" id="email" name="email">
          <p id="alert-email" class="alert"></p>
        </div>
        
        <div class="block">
          <label class="label2" for="password">Mot de passe :</label>
          <input class="form-text" type="password" id="password" name="password">
        </div>
        
        <div class="block">
          <div class="registrationbtn">
            <label for="submit">Validation</label>
            <div class="block btn-block">
              <button class="btn" id="submit" name="submit" type="submit">Valider</button>
            </div>
          </div>
        </div>
        <?php include "devenir_membre.php";
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $connexion = new connexion($_POST['email'], $_POST['password']);
                $connexion->identifiant();
            }; ?>
      </form>
  </div>
</div>
<script src="javascrip.js"></script>
<script src="script.js"></script>
</body>