<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\Note;
use App\App;
use App\Auth;
use App\Chanson;
use App\User;

$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../../index.php');
}

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
$noteNew = false;
$getUserNote = $note->userHaveNote($user->identifiantC);    // Récupére si l'utilisateur à déja noter une chanson
$notes = $note->getUserHaveNote($user->identifiantC);       // Récupére les chansons ayant noter
if (isset($_POST['sendNewNote'])) {
    $getNewNote = $note->noteBewteen0_5(sanitizeString($_POST['newNote']));
    if($getNewNote){
        if($note->getNewNote((int)$_POST['codeChanson'], $_POST['newNote'], $user->identifiantC)){
            $noteNew = true;
            $succesUpdate = "Votre note à était changer !";
        } else {
            $noteNew = false;
            $errorUpdate = "Votre note n'as pas pu étre changer !";
        }
    } else {
        $errorNew = "Nombre compris entre 0 et 5";
    }
}

// Afficher toutes les notes des utilisateur
$gets = $note->selectAllNote() ;

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../../Js/footerInformation/information.js"></script>
        <link rel="stylesheet" href="../../Css/styleFooter.css">
        <link rel="stylesheet" href="../../Css/styleNote.css">
        <link rel="stylesheet" href="../../Css/styleTopbar.css">
        <title>Note Chanson Musical</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbarCLient-D">
                    <a href="../accueilClient.php" title="Artiste">Accueil</a>
                    <a href="artiste.php" title="Noter">Artiste</a>
                    <a href="album.php" title="Album">Album</a>
                    <a href="chanson.php" title="Chanson">Chanson</a>
                    <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <h1>Vous etes <?= $user->identifiantC?></h1>
        <main class="main-note">
            <div class="note-border">
                <div class="note-chanson">
                    <h1 class="title-noter">Noter une chanson</h1>
                    <?php if(!$checkNote || $checkUserNote || $success): ?>
                        <div class="error">
                            <?php if(!$checkNote): ?>
                                <?= $error ?>
                            <?php endif ?>
                            <?php if($checkUserNote): ?>
                                <?= $errorUser ?>
                            <?php endif ?>
                            <?php if($success): ?>
                                <?= $success ?>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                    <form action="" method="post">
                        <div class="chooseChanson">
                            <label for="chooseChanson">Choissisez : </label>
                            <select name="titreC" value="<?php sanitizeString($_POST['titreC'])?>">
                                <?php foreach ($chansons as $chanson): ?>
                                    <option><?= $chanson->titreC ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="note">
                            <label for="note">Votre note : </label>
                            <input type="number" name="noteNumber" value="<?php sanitizeString($_POST['noteNumber']) ?>">
                        </div>
                        <div class="button-sendNote">
                            <input type="submit" name="sendNote" value="Noter">
                        </div>
                    </form>
                </div>
                <?php if($getUserNote): ?>
                    <hr class="separate">
                    <div class="updateNote">
                        <h1 class="title-update">Changer une note</h1>  
                        <div class="noteUser">
                            <div class="error">
                                <?php if (!$getNewNote): ?>
                                    <?= $errorNew ?>
                                <?php endif ?>
                                <?php if (!$noteNew): ?>
                                    <?= $errorUpdate ?>
                                <?php endif ?>
                                <?php if ($noteNew): ?>
                                    <?= $succesUpdate ?>
                                <?php endif ?>
                            </div>
                            <form action="" method="post">
                                <div class="chooseChanson">
                                    <label for="chooseUpdateChanson">Choissisez : </label>
                                    <select name="codeChanson" value="<?php sanitizeString($_POST['codeChanson']) ?>">
                                        <?php foreach ($notes as $note): ?>
                                            <option><strong><?= $note->codeChanson ?></strong> : <?= $note->titreC ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="updateNote">
                                    <label for="updateNote">Nouvelle note : </label>
                                    <input type="number" name="newNote" value="<?php sanitizeString($_POST['newNote'])?>">  
                                </div>
                                <div class="button-sendNewNote">
                                    <input type="submit" name="sendNewNote" value="Changer note">
                                </div>
                            </form>
                        </div>    
                    </div>
                <?php endif ?>
            </div>
            <div class="show-sep">
                <div class="noteUserAll">
                    <h1 class="noteAll-title">Notes des utilisateurs</h1>
                    <?php foreach ($gets as $get): ?>
                        <div class="viewNote">
                            <img src="../../img/imgtop.png" width="150px" height="auto">
                            <div class="getNote">
                                <ul>
                                    <li>Utilisateur : <?= $get->identifiantC ?></li>
                                    <li>Code chanson : <?= $get->codeChanson ?></li>
                                    <li>Titre : <?= $get->titreC ?></li>
                                    <li>Note : <?= $get->note ?></li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </main>
        <?php require_once '../FooterUse/footer.php' ?>
    </body>
</html>