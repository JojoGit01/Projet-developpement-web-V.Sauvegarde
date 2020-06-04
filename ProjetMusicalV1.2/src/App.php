<?php
//===================================================
// Name        : App.php
// Author      : Jonathan
// Version     : Final
// Description : Class qui permet d'instancier simplement la PDO et de vérifier l'utilisateur.
//===================================================
namespace App;
use PDO;
class App {

    public static $pdo;

    public static function getPDO(): PDO 
    {
        if(!self::$pdo){
            $dsn = 'mysql:dbname=ProjetMusical;host=127.0.0.1';
            $user = 'Jojo';
            $password = 'bonjour';
            try {
                self::$pdo = new PDO($dsn, $user, $password,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
        }
        return self::$pdo;
    }

    public static $auth;

    public static function getAuth(): Auth
    {
        if(!self::$auth){
            self::$auth = new Auth(self::getPDO(), '../Public/accueilClient.php');
        }
        return self::$auth;
    }
}