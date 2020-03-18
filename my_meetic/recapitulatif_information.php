<?php
require "connect.php";

class information
{
    private $mail;

    public function __construct($mail)
    {
        $this->mail = strip_tags($mail);
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function return_information()
    {
        $sql = $GLOBALS['conn']->prepare("SELECT * FROM membre WHERE email=:email");
        $sql->bindParam(":email", $this->mail, PDO::PARAM_STR);
        $sql->execute();
        $query = $sql->fetchAll();

        if ($query == null) {
            header('Location: ./../index.php');
        }
        $sql->closeCursor();
        return $query;
    }

    public function return_age()
    {
        $query = $GLOBALS['conn']-> prepare("SELECT DATEDIFF(DATE(NOW()),membre.date_naissance) AS 'age' FROM membre 
                      WHERE email=:mail");
        $query->bindParam(":mail", $this->mail, PDO::PARAM_STR);
        $query->execute();
        $age = $query->fetchAll();
        $majeur = floor(intval($age[0]['age']) / 365);
        $query->closeCursor();
        return $majeur;
    }
}

// class change_password
// {
//     private $mail;
//     private $ancien;
//     private $nouveau;
//     private $confirme;

//     public function __construct($mail, $ancien, $nouveau, $confirme)
//     {
//         $this->mail = strip_tags($mail);
//         $this->ancien = strip_tags($ancien);
//         $this->nouveau = strip_tags($nouveau);
//         $this->confirme = strip_tags($confirme);
//     }

//     public function getMail()
//     {
//         return $this->mail;
//     }

//     public function setMail($mail)
//     {
//         $this->mail = $mail;
//     }

//     public function getAncien()
//     {
//         return $this->ancien;
//     }

//     public function setAncien($ancien)
//     {
//         $this->ancien = $ancien;
//     }

//     public function getNouveau()
//     {
//         return $this->nouveau;
//     }

//     public function setNouveau($nouveau)
//     {
//         $this->nouveau = $nouveau;
//     }

//     public function getConfirme()
//     {
//         return $this->confirme;
//     }

//     public function setConfirme($confirme)
//     {
//         $this->confirme = $confirme;
//     }

//     public function password()
//     {
//         if (isset($this->mail) && isset($this->ancien) && isset($this->nouveau) && isset($this->confirme)) {
//             if ($this->nouveau === $this->confirme) {
//                 $this->confirme = password_hash($this->confirme, PASSWORD_DEFAULT);
//                 $mot_de_passe = $GLOBALS['conn']->prepare("SELECT password FROM membre WHERE email=:mail");
//                 $mot_de_passe->bindParam(":mail", $this->mail, PDO::PARAM_STR);
//                 $mot_de_passe->execute();
//                 $passe = $mot_de_passe->fetch();
//                 if (password_verify($this->ancien, $passe['password'])) {
//                     $sql = $GLOBALS['conn']->prepare("UPDATE membre SET password=:new WHERE email=:mail");
//                     $sql->bindParam(":mail", $this->mail, PDO::PARAM_STR);
//                     $sql->bindParam(":new", $this->confirme, PDO::PARAM_STR);
//                     $sql->execute();
//                     $sql->closeCursor();
//                     echo "Changement du mot de passe réussis avec succés<br/>";
//                 } else {
//                     echo "Ancien mot de passe incorrect<br/>";
//                 }
//             } else {
//                 echo "Le mot de passe de confirmation est différent du nouveau mot de passe. 
//                     Veuillez re-confirmer votre nouveau mot de passe<br/>";
//             }
//         }
//     }
// }
