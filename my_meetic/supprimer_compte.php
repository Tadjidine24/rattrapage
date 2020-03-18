<?php

require "connect.php";

class delete_compte
{
    private $mail;
    private $password;

    public function __construct($mail, $password)
    {
        $this->mail = strip_tags($mail);
        $this->password = strip_tags($password);
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

    public function delete()
    {
        $sql = $GLOBALS['conn']->prepare("SELECT password FROM membre WHERE email=:mail");
        $sql->bindParam(":mail", $this->mail, PDO::PARAM_STR);
        $sql->execute();
        $passe = $sql->fetch();
        if (password_verify($this->password, $passe['password'])) {
            $query = $GLOBALS['conn']->prepare("UPDATE membre set compte_supprimer=\"delete\" WHERE email=:mail");
            $query->bindParam(":mail", $this->mail, PDO::PARAM_STR);
            $query->execute();
            header('Location: ./login.php');
        } else {
            echo "Mot de passe incorrect<br/>";
        }
        $sql->closeCursor();
    }
}

if (isset($_POST['mail']) && isset($_POST['password']))
{
    $del = new delete_compte($_POST['mail'], $_POST['password']);
    $del->delete();
}

class deconnexion
{
    private $deco;

    public function __construct($deco)
    {
        $this->deco = strip_tags($deco);
    }

    public function getDeco()
    {
        return $this->deco;
    }

    public function setDeco($deco)
    {
        $this->deco = $deco;
    }

    public function deconnex()
    {
        if (isset($this->deco)) {
            header('Location: login.php');
            session_unset();
            session_destroy();
        }
    }
}

if (isset($_POST['deconnexion'])) {
    $deco = new deconnexion($_POST['deconnexion']);
    $deco->deconnex();
}