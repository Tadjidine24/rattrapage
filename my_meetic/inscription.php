<?php session_start(); ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LOVA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mon_css.css">
    <meta name="theme-color" content="#fafafa">
  </head>
<body>
  
  <div class="backimage"> 
    <h1>Live Meetings</h1>
    <div class="form">
      <form class="formulaire"  method="post" action="inscription.php" onsubmit="return validateForm()">
           
        <div class="block"> 
          <label class="label2" for="nom">Nom :</label>
          <input class="bleu form-text" type="text" id="nom" name="nom">
          <p id="alert-nom" class="alert"></p>
        </div>
        
        <div class="block">
          <label class="label2" for="prenom">Prenom :</label>
          <input class="form-text" type="text" id="prenom" name="prenom">
          <p id="alert-prenom" class="alert"></p>
        </div>

        <div class="block">
          <label class="label2" for="date">Date de naissance :</label>
          <input class="form-text" type="date" id="date" name="date">
        </div>

        <div class="block">
          <label class="label2">Sexe :</label>
          <label class="label2" for="homme">Homme</label>
          <input type="radio" name="sexe" value="Homme" checked id="homme">
          <label class="label2" for="femme">Femme</label>
          <input type="radio" name="sexe" value="Femme" id="femme">
          <label class="label2" for="autre">Autre</label>
          <input type="radio" name="sexe" value="autre" id="autre">
        </div>

        <div class="block"> 
          <label class="label2" for="nom">Ville :</label>
          <input class="bleu form-text" type="text" id="ville" name="ville">
          <p id="alert-ville" class="alert"></p>
        </div>

        
        <div class="block">
          <label class="label2" for="email">E-mail :</label>
          <input class="form-text" type="email" id="email" name="mail">
          <p id="alert-email" class="alert"></p>
        </div>
        
        <div class="block">
          <label class="label2" for="password">Mot de passe :</label>
          <input class="form-text" type="password" id="password" name="mot_de_passe">
        </div>

        
        <input type="hidden" id="token" name="token" value="my first website">
        
        <div class="block">
          <div class="registrationbtn">
            <label for="submit">Validation</label>
            <div class="block btn-block">
              <button class="btn" id="submit" name="submit" type="submit">Valider</button>
            </div>
          </div>
        </div>
      </form>
  </div>
</div>
<script src="javascrip.js"></script>
<?php include './devenir_membre.php';
            if (
                isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['sexe'])
                && isset($_POST['ville']) && isset($_POST['mail']) && isset($_POST['mot_de_passe'])
            ) {
                $client = new inscription(
                    $_POST['prenom'],
                    $_POST['nom'],
                    $_POST['date'],
                    $_POST['sexe'],
                    $_POST['ville'],
                    $_POST['mail'],
                    $_POST['mot_de_passe']
                );
                $client->insertInto();
            }
            ?>
</body>
</html>