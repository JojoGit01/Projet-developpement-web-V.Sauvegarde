<?php
//===================================================
// Name        : Note.php
// Author      : Jonathan
// Version     : Final
// Description : Class qui permet à un utilisateur de noter,modifier et de visualiser les notes.
//===================================================
namespace App;
use PDO;
use App\App;
$pdo = App::getPDO();

class Note{

    public $codeChanson, $identifiantC, $note, $titreC;
    public function __construct () {}

    //Vérifier que la note est entre 0 et 5
    public function noteBewteen0_5 ($noteNumber) : bool {    
        $noteNumber > 5 || $noteNumber < 0 ?  $error = false : $error = true;
        return $error;
    }

    //Récupére le titre de la chanson
    public function recupereTitre($titreC) {
        $selectNumber = App::getPDO()->prepare("SELECT codeChanson FROM chanson WHERE titreC = '$titreC'");
        $selectNumber->execute();
        return (int)$selectNumber->fetch()->codeChanson;
    }

    public static $getUserNote;
    public function checkUserNote($idChanson, $identifiantU) {
        $selectLigneNumber = App::getPDO()->prepare("SELECT COUNT(*) as getNote FROM noter WHERE codeChanson = '$idChanson' AND identifiantC = '$identifiantU'");
        $selectLigneNumber->execute();     

        $getLigneNumber = (int)$selectLigneNumber->fetch()->getNote;
        $selectNote = App::getPDO()->prepare("SELECT note FROM noter WHERE codeChanson = '$idChanson' AND identifiantC = '$identifiantU'");   
        $selectNote->execute();
        self::$getUserNote = (int)$selectNote->fetch()->note;
        if($getLigneNumber === 0){
            // Note inexistante
            return false;
        } else {
            //Note existante
            return true;
        }
        // Dans les cas existant retourne true // NO-BUG //
        return true;   
    }

    //Insérer la note
    public function insertNote($codeChanson, $idUser, $note){
        $insertNote = App::getPDO()->prepare("INSERT INTO noter (codeChanson, identifiantC, note) VALUES ('$codeChanson', '$idUser', '$note')");
        $insertNote->execute([
            'codeChanson' => $codeChanson,
            'identifiantC' => $idUser,
            'note' => $note
        ]);
        self::updateNoteInChanson($codeChanson);
    }


    //Function qui permet de faire un changement de la note d'opinion d'une chanson à partir de la note obtenu et des notes auparavant obtenu.
    //Par défaut la note d'opinion = 5, donc celle-ci sera tenu en compte pour le calcul de la note d'opinion.
    const DEFAULT_NOTE = 5;
    const DEFAULT_NOTE_COUNT = 1;
    public static function updateNoteInChanson ($codeChanson) {
        $noteCountC = App::getPDO()->prepare("SELECT COUNT(note) as noteCount FROM noter WHERE codeChanson = '$codeChanson'");
        $sumNoteN = App::getPDO()->prepare("SELECT SUM(note) as sumNote FROM noter WHERE codeChanson = '$codeChanson'") ;
        $noteCountC->execute();
        $sumNoteN->execute();
        $getNoteCountC = (int)$noteCountC->fetch()->noteCount;
        $getSumNoteN = (float)$sumNoteN->fetch()->sumNote;
        //Calcul de la nouvelle note
        $updateNote = ( round( (($getSumNoteN + self::DEFAULT_NOTE) / ($getNoteCountC + self::DEFAULT_NOTE_COUNT)), 2 ) );
        //Update la nouvelle note pour la note d'opinion d'une chanson
        $updateNoteOpinionC = App::getPDO()->prepare("UPDATE chanson JOIN noter ON chanson.codeChanson=noter.codeChanson SET chanson.noteOpinionC = '$updateNote' WHERE chanson.codeChanson = '$codeChanson'");
        $updateNoteOpinionC->execute();     
    }

    // Pour modifier la note //
    public function userHaveNote($user) {
        $selectCountNoteHave = App::getPDO()->prepare("SELECT COUNT(note) as noteHave FROM noter WHERE identifiantC = '$user'");
        $selectCountNoteHave->execute(); 
        $getCountUserNote = (int)$selectCountNoteHave->fetch()->noteHave;
        if($getCountUserNote >= 1) {
            return true;
        }
        return false;
    }

    //Vérifie si l'utilisateur a déja noter une chanson
    public function getUserHaveNote($user) {
        $selectNoteUser = App::getPDO()->prepare("SELECT * FROM noter JOIN chanson ON noter.codeChanson = chanson.codeChanson WHERE identifiantC = '$user'");
        $selectNoteUser->execute();
        return $selectNoteUser->fetchAll();
    }

    //Récupérer la note qui à était changer
    public function getNewNote($codeChanson, $newNote, $user) {
        $updateNote = App::getPDO()->prepare("UPDATE noter SET note = '$newNote' WHERE codeChanson = '$codeChanson' AND identifiantC = '$user'");
        $updateNote->execute();
        self::updateNoteInChanson($codeChanson);
        return true;
    }

    // Afficher les notes des utilisateur //
    public function selectAllNote() {
        $selectAll = App::getPDO()->prepare("SELECT * FROM noter JOIN chanson ON noter.codeChanson = chanson.codeChanson");
        $selectAll->execute();
        return $selectAll->fetchAll();
    }
}