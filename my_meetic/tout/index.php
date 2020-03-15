<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>my_meetic</title>
</head>

<body>
    <section>
        <form method="post" action="index.php">
            <h1>My Meetic</h1>
            <article>
                <table>
                    <tr>
                        <td>Email :</td>
                        <td><input type="email" name="email" /></td>
                    </tr>
                    <tr>
                        <td>Mot de passe :</td>
                        <td><input type="password" name="password" />
                            <td />
                    </tr>
                    <tr>
                        <td></td>
                        <td class="valider"><input type="submit" class="valider" value="Se Connecter" /></td>
                    </tr>
                </table>
            </article>
            <?php include "php/devenir_membre.php";
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $connexion = new connexion($_POST['email'], $_POST['password']);
                $connexion->identifiant();
            }; ?>
        </form>
    </section>
</body>

</html>