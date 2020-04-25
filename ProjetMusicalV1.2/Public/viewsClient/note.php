<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\Note;
use App\App;
use App\Auth;
use App\Chanson;
use App\User;

$user = App::getAuth()->user();
$chansons = Chanson::getChanson();
$note = new Note();

// Envoyer note
if(isset($_POST['sendNote'])) {
    $checkNote = $note->noteBewteen0_5($_POST['noteNumber']);
    if($checkNote) {
        //Récupére le numero de la chanson
        $codeChanson = $note->recupereTitre($_POST['titreC']); 
        $checkUserNote = $note->checkUserNote($codeChanson, $user->identifiantC);
        if(!$checkUserNote) {
            $note->insertNote($codeChanson, $user->identifiantC, $_POST['noteNumber']);
            $success = "Votre note à été transmis";
        } else {
            $errorUser = "Vous avez déja noter cette chanson : " . $_POST['titreC'] . ".<br> Vous avez mis : " . Note::$getUserNote . " / 5 .";
        }
    } else {
        $error = "Nombre compris entre 0 et 5";
    }
}

// Changer note //
$getUserNote = $note->userHaveNote($user->identifiantC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Chanson Musical</title>
</head>
<body>
    <h1>Vous etes <?= $user->identifiantC?></h1>
    <main class="main">
        <div class="note">
            <h1>Noter une chanson</h1>
            <form action="" method="post">
                <?php if(!$checkNote): ?>
                    <p class="errorNote"><?= $error ?></p>
                <?php endif ?>
                <?php if($checkUserNote): ?>
                    <p class="errorUser"><?= $errorUser ?><br></p>
                <?php endif ?>
                <?php if($success): ?>
                    <p><?= $success ?></p>
                <?php endif ?>
                <select name="titreC" value="<?php sanitizeString($_POST['titreC'])?>">
                    <?php foreach ($chansons as $chanson): ?>
                        <option><?= $chanson->titreC ?></option>
                    <?php endforeach ?>
                </select>
                <input type="number" name="noteNumber" value="<?php sanitizeString($_POST['noteNumber']) ?>">
                <input type="submit" name="sendNote" value="Noter">
            </form>
        </div>
        <!-- A FINIR CETTE PARTIE IMPORTANTE -->
        <?php if($getUserNote): ?>
        <?php $notes = $note->getUserHaveNote($user->identifiantC) ?>
        <div class="updateNote">
            <h1>Changer une note</h1>  
            <div class="noteUser">
                <form action="" method="post">
                    <select>
                        <?php foreach ($notes as $note): ?>
                            <option name="<?php $note->codeChanson ?>"><?= "$note->codeChanson : $note->titreC" ?></option>
                        <?php endforeach ?>
                        <input type="number" name="newNote" value="<?php sanitizeString($_POST['newNote'])?>">  
                        <input type="submit" name="sendNewNote" value="Changer note">
                        <?php var_dump($_POST[$note->codeChanson]); ?>
                        <?php $note->getNewNote($note->codeChanson, $_POST['newNote'], $user->identifiantC); ?>
                    </select>
                </form>
            </div>    
        </div>
        <?php endif ?>
    </main>
</body>
</html>