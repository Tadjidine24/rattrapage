<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="mon_css.css">
    <title>My_meetic</title>
</head>

<body>

    <section>
    <?php
        include "navigateur.php";

        if (isset($_SESSION['mail'])) {

            include "./recapitulatif_information.php";

            $recap = new information($_SESSION['mail']);
            $frite = $recap->return_information();
            $age = $recap->return_age();
            foreach ($frite as $requet) {

        ?>
                <h3>Bonjour, <?= $requet['nom'] . " " . $requet['prenom']; ?></h3>
                <table>
                    <tr>
                        <td>Nom: </td>
                        <td><?= $requet['nom']; ?></td>
                    </tr>
                    <tr>
                        <td>Prenom: </td>
                        <td><?= $requet['prenom']; ?></td>
                    </tr>
                    <tr>
                        <td>Age: </td>
                        <td><?= $age; ?></td>
                    </tr>
                    <tr>
                        <td>Sexe: </td>
                        <td><?= $requet['sexe']; ?></td>
                    </tr>
                    <tr>
                        <td>Ville: </td>
                        <td><?= $requet['ville']; ?></td>
                    </tr>
                    <tr>
                        <td>Mail: </td>
                        <td><?= $requet['email']; ?></td>
                    </tr>
                </table>
            <?php  }
            ?>
            <form method="post" action="bienvenue.php">
                <h2>Modifier:</h2>
                <table>
                    <tr>
                        <td>Ancien mot de passe:</td>
                        <td><input type="password" name="ancien_password" /></td>
                    </tr>
                    <tr>
                        <td>Nouveau mot de passe:</td>
                        <td><input type="password" name="new_password" /></td>
                    </tr>
                    <tr>
                        <td>Confirmer nouveau mot de passe:</td>
                        <td><input type="password" name="confirme_password" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" /></td>
                    </tr>
                </table>
                <?php
                if (
                    isset($_POST['ancien_password']) && isset($_POST['new_password'])
                    && isset($_POST['confirme_password'])
                ) {
                    $password = new change_password(
                        $_SESSION['mail'],
                        ($_POST['ancien_password']),
                        $_POST['new_password'],
                        $_POST['confirme_password']
                    );
                    $password->password();
                } ?>

            </form>
        <?php } else {
            echo "Vous n'êtes pas connecté, accès impossible<br />
               <a href='../index.php'>Se connecter</a>";
        }
        ?>
    </section>
</body>

</html>