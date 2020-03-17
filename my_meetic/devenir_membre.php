<?php

require 'connect.php';

class inscription
{
    private $prenom;
    private $nom;
    private $date;
    private $sexe;
    private $ville;
    private $mail;
    private $password;

    public function __construct($prenom, $nom, $date, $sexe, $ville, $mail, $password)
    {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->date = $date;
        $this->sexe = $sexe;
        $this->ville = $ville;
        $this->mail = $mail;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getnom()
    {
        return $this->nom;
    }

    public function setnom($nom)
    {
        $this->nom = $nom;
    }


    public function getprenom()
    {
        return $this->prenom;
    }

    public function setprenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getdate()
    {
        return $this->date;
    }

    public function setdate($date)
    {
        $this->date = $date;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function insertInto()
    {
        $this->prenom = preg_replace("# +#", "", $this->prenom);
        $this->nom = preg_replace("# +#", "", $this->nom);
        $this->date = preg_replace("# +#", "", $this->date);
        $this->ville = preg_replace("# +#", "", $this->ville);
        $this->mail = preg_replace("# +#", "", $this->mail);

        $this->prenom = strip_tags(trim($this->prenom));
        $this->nom = strip_tags(trim($this->nom));
        $this->date = strip_tags(trim($this->date));
        $this->ville = strip_tags(trim($this->ville));
        if (
            isset($this->prenom) && isset($this->nom) && isset($this->date) && isset($this->sexe)
            && isset($this->ville) && isset($this->mail) && isset($this->password)
        ) {
            if (
                $this->prenom != null && $this->nom != null && $this->date != null && $this->sexe != null
                && $this->ville != null && $this->mail != null && $this->password != null
            ) {
                $verif_email = $GLOBALS['conn']->prepare("SELECT email FROM membre WHERE email=:mail");
                $verif_email->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                $verif_email->execute();
                $verification = $verif_email->fetchAll();
                if ($verification == null) {
                    $sql = $GLOBALS['conn']->prepare("INSERT INTO membre (nom, prenom, date_naissance, sexe, ville,
                    email, password) values(?, ?, ?, ?, ?, ?, ?)");
                    $sql->execute(array(
                        $this->prenom, $this->nom, $this->date, $this->sexe, $this->ville,
                        $this->mail, $this->password
                    ));
                    $sql->closeCursor();
                    $query = $GLOBALS['conn']->prepare("SELECT DATEDIFF(DATE(NOW()),membre.date_naissance) AS 'age' FROM membre 
                      WHERE email=:mail");
                    $query->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                    $query->execute();
                    $age = $query->fetchAll();
                    $majeur = floor(intval($age[0]['age']) / 365);

                    if ($majeur >= 18) {
                        $requet_sql_on = $GLOBALS['conn']->prepare("UPDATE membre set statue='on' where email=:email");
                        $requet_sql_on->bindParam(":email", $this->mail, PDO::PARAM_STR);
                        $requet_sql_on->execute();
                        $requet_sql_on->closeCursor();
                        echo "Inscription réussis avec succés.";
                    } elseif ($majeur < 18) {
                        $requet_sql_off = $GLOBALS['conn']->prepare("UPDATE membre set statue='of' where email=:email");
                        $requet_sql_off->bindParam(":email", $this->mail, PDO::PARAM_STR);
                        $requet_sql_off->execute();
                        $requet_sql_off->closeCursor();
                        echo "Votre inscriptions est finalisé, pour des raisons de sécurité, votre compte ne sera actif
                         qu'après votre majorité\n";
                    }
                } elseif ($verification != null) {
                    echo "Adresse mail déjà existant<br/>";
                }
            } else {
                echo "Information manquante<br/>";
            }
        }
    }
}

class connexion
{
    private $mail;
    private $password;

    public function __construct($mail, $password)
    {
        $this->mail = $mail;
        $this->password = $password;
    }


    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function identifiant()
    {
        if (isset($this->mail) && isset($this->password)) {
            if ($this->mail != null && $this->password != null) {
                $mot_de_passe = $GLOBALS['conn']->prepare("SELECT password FROM membre WHERE email=:mail");
                $mot_de_passe->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                $mot_de_passe->execute();
                $passe = $mot_de_passe->fetch();
                if (password_verify($this->password, $passe['password'])) {
                    $requet_sql = $GLOBALS['conn']->prepare("SELECT * FROM membre WHERE statue=\"on\" and email=:mail");
                    $requet_sql->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                    $requet_sql->execute();
                    $requet = $requet_sql->fetchAll();
                    if ($requet != null) {
                        $del = $GLOBALS['conn']->prepare("SELECT compte_supprimer FROM membre WHERE email=:email");
                        $del->bindParam(":email", $this->mail, PDO::PARAM_STR);
                        $del->execute();
                        $dele = $del->fetch();
                        if ($dele['compte_supprimer'] == "delete") {
                            echo "Votre compte à été supprimer";
                        } else {
                            $_SESSION['mail'] = $this->mail;
                            header('Location: ./html/bienvenue.php');
                        }
                    } elseif ($requet == null) {
                        echo "Votre compte est bloqué jusqu'à votre majorité<br/>";
                    }
                    $requet_sql->closeCursor();
                } else {
                    $sql = $GLOBALS['conn']->prepare("SELECT email FROM membre WHERE email =:mail");
                    $sql->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                    $sql->execute();
                    $query = $sql->fetch();
                    if ($query == null) {
                        echo "Ce compte n'existe pas<br/>";
                    }
                    if ($query != null) {
                        echo "Mot de passe incorrect<br/>";
                    }
                    $sql->closeCursor();
                }
            }
        }
    }
}
