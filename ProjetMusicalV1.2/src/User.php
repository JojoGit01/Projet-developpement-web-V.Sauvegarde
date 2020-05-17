<?php
// Cette class permet de définir un utilsateur si il est connecté ou non connecté
// Creator : Jonathan
namespace App;
use PDO;
class User{
    
    public $idCompteC;
    public $nomC;
    public $dateDeNaissance;
    public $emailC;
    public $identifiantC;
    public $motDePasseC;
    public $prenomC;

    public function __construct () {}

    public static function checkIfUserCo(Auth $auth): bool {
        if($auth->user() !== null){
            return true;
        }
        return false;
    }

    public static function checkIdentifiant (string $identifiantC) {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM compteMusical WHERE identifiantC = '$identifiantC'");
        $query->execute([$identifiantC]);
        return $query->fetchObject(__CLASS__);
    }

    public static function checkID($idCompteC){
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM compteMusical WHERE idCompteC = ?");
        $query->execute([$idCompteC]);
        return $query->fetchObject(__CLASS__);
    }
}