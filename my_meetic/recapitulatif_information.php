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
            header('Location: login.php');
        }
        $sql->closeCursor();
        return $query;
    }

    public function return_age()
    {
        $query = $GLOBALS['conn']-> prepare("SELECT DATEDIFF(DATE(NOW()),membre.date_naissance) AS 'age' FROM membre 
                      WHERE email=:email");
        $query->bindParam(":email", $this->mail, PDO::PARAM_STR);
        $query->execute();
        $age = $query->fetchAll();
        $majeur = floor(intval($age[0]['age']) / 365);
        $query->closeCursor();
        return $majeur;
    }
}
