<?php
namespace App;
use PDO;
use App\App;

class Note{

    public $codeChanson, $identifiantC, $note, $titreC;
    public function __construct () {}

    public function noteBewteen0_5 ($noteNumber) : bool {    
        $noteNumber > 5 || $noteNumber < 0 ?  $error = false : $error = true;
        return $error;
    }

    public function recupereTitre($titreC) {
        $pdo = App::getPDO();
        $selectNumber = $pdo->prepare("SELECT codeChanson FROM chanson WHERE titreC = '$titreC'");
        $selectNumber->execute();
        $numberTitreC = (int)$selectNumber->fetch()->codeChanson;
        return $numberTitreC;
    }

    public static $getUserNote;
    public function checkUserNote($idChanson, $identifiantU) {
        $pdo = App::getPDO();
        $selectLigneNumber = $pdo->prepare("SELECT COUNT(*) as getNote FROM noter WHERE codeChanson = '$idChanson' AND identifiantC = '$identifiantU'");
        $selectLigneNumber->execute();     

        $getLigneNumber = (int)$selectLigneNumber->fetch()->getNote;
        $selectNote = $pdo->prepare("SELECT note FROM noter WHERE codeChanson = '$idChanson' AND identifiantC = '$identifiantU'");   
        $selectNote->execute();
        self::$getUserNote = (int)$selectNote->fetch()->note;
        if($getLigneNumber === 0){
            // Note inexistante
            return false;
        } else {
            //Note existante
            return true;
        }
        // Dans tous les cas retourne true // NO-BUG //
        return true;
        
    }

    public function insertNote($codeChanson, $idUser, $note){
        $pdo = App::getPDO();
        $insertNote = $pdo->prepare("INSERT INTO noter (codeChanson, identifiantC, note) VALUES ('$codeChanson', '$idUser', '$note')");
        $insertNote->execute([
            'codeChanson' => $codeChanson,
            'identifiantC' => $idUser,
            'note' => $note
        ]);
    }


    // Pour modifier la note //
    public function userHaveNote($user) {
        $pdo = App::getPDO();
        $selectCountNoteHave = $pdo->prepare("SELECT COUNT(note) as noteHave FROM noter WHERE identifiantC = '$user'");
        $selectCountNoteHave->execute(); 
        $getCountUserNote = (int)$selectCountNoteHave->fetch()->noteHave;
        if($getCountUserNote >= 1) {
            return true;
        }
        return false;
    }

    public function getUserHaveNote($user) {
        $pdo = App::getPDO();
        $selectNoteUser = $pdo->prepare("SELECT * FROM noter JOIN chanson ON noter.codeChanson = chanson.codeChanson WHERE identifiantC = '$user'");
        $selectNoteUser->execute();
        $getAll = $selectNoteUser->fetchAll();
        return $getAll;
    }

    public function getNewNote($codeChanson, $newNote, $user) {
        $pdo = App::getPDO();
        $updateNote = $pdo->prepare("UPDATE noter SET note = '$newNote' WHERE codeChanson = '$codeChanson' AND identifiantC = '$user'");
        $updateNote->execute();
        return true;
    }


    // Afficher les notes des utilisateur //
    public function selectAllNote() {
        $pdo = App::getPDO();
        $selectAll = $pdo->prepare("SELECT * FROM noter JOIN chanson ON noter.codeChanson = chanson.codeChanson");
        $selectAll->execute();
        $getAll = $selectAll->fetchAll();
        return $getAll;
    }

}