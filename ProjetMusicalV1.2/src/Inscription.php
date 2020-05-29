<?php
//Creator : Jonathan
namespace App;
use PDO;
class Inscription{

    private $pdo;
    public function __construct (PDO $pdo){
        $this->pdo = $pdo;
    }

    public function checkEmail($email): bool {
        $selectEmail = $this->pdo->query("SELECT * FROM compteMusical WHERE emailC = '$email'");
        $resultEmail = $selectEmail->fetchAll();
        if(!$resultEmail){
            return false;
        }
        return true;
    }
    public function checkIdentifiant($identifiant): bool {
        $selectIdentifiant = $this->pdo->query("SELECT * FROM compteMusical WHERE identifiantC = '$identifiant'");
        $resultIdentifiant = $selectIdentifiant->fetchAll();
        if(!$resultIdentifiant) {
            return false;
        }
        return true;
    }

    public function sendInscription($name, $prenom, $dateDeNaissance, $email, $identifiant, $motDePasse): void 
    {
        $passwordHash = password_hash($motDePasse, PASSWORD_DEFAULT);
        $select = $this->pdo->prepare("INSERT INTO compteMusical (nomC, dateDeNaissance, emailC, identifiantC, motDePasseC, prenomC) VALUES ('$name', '$dateDeNaissance', '$email', '$identifiant', '$passwordHash', '$prenom')");
        $select->execute([
            'nomC' => $name,
            'dateDeNaissance' => $dateDeNaissance,
            'emailC' => $email,
            'identifiantC' => $identifiant,
            'motDePasseC' => $passwordHash,
            'prenomC' => $prenom
        ]);
        header("Location: ../Public/connexion.php");
    }
}
