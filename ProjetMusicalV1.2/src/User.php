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

    //Vérifier si l'utilisateur n'est pas déja connecter.
    public static function checkIfUserCo(Auth $auth): bool {
        if($auth->user() !== null) {
            return true;
        }
        return false;
    }

    //Vérification de l'identifiant et de l'id .
    public static function check ($idC, $nameID) {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM compteMusical WHERE $nameID = '$idC'");
        $query->execute([$nameID]);
        return $query->fetchObject(__CLASS__);
    }
    public static function checkIdentifiant (string $identifiantC) {
        $nameID = "identifiantC";
        return self::check($identifiantC, $nameID);
    }
    public static function checkID($idCompteC) {
        $nameID = "idCompteC";
        return self::check($idCompteC, $nameID);
    }
}