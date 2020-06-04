<?php 
//===================================================
// Name        : Auth.php
// Author      : Jonathan
// Version     : Final
//===================================================
namespace App;
use PDO;
class Auth{

    private $pdo;
    private $loginPath;
    public function __construct(PDO $pdo, string $loginPath){
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
    }

    public function user(): ?User{
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $id = $_SESSION['auth'] ?? null;
        if ($id === null){
            return null;
        }
        $user = User::checkID($id);
        return $user ?: null;
    }

    public function login($username, $password): ?User{
        $user = User::checkIdentifiant($username);
        if($user === false) {
            return null;
        }
        //On vérifie password_verify que l'utilisateur corresponde
        if (password_verify($password, $user->motDePasseC)){
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION['auth'] = $user->idCompteC;
            return $user;
        }
        return null;
    }
}