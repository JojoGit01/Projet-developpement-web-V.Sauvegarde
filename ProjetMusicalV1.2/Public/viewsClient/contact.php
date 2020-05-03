<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';

use App\App;
$user = App::getAuth()->user();
if(!$user) { header('Location: ../connexion.php'); }
if (isset($_POST['sendMessage'])) {
    $option = sanitizeString($_POST['optionContact']);
    $message = sanitizeString($_POST['message']);
    if (strlen($message) < 1000){
        $pdo = App::getPDO();
        $send = $pdo->prepare("INSERT INTO contact VALUES (emailC, nomC, prenomC, optionC, messageC) VALUES ('$user->emailC', '$user->nomC', '$user->prenomC', '$option', '$message')");
        $send->execute();
    } else {
        $error = "Votre message est trop long";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../../Js/footerInformation/information.js"></script>
        <link rel="stylesheet" href="../../Css/styleFooter.css">
        <title>Contacter nous</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbarCLient-D">
                    <a href="../accueilClient.php" title="Accueil">Accueil</a>
                    <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <div class="body-Contact">
            <main class="main-Conctact">
                <form action="" method="post">
                    <fieldset class="fieldset-contact">
                        <legend>Contactez nous</legend>
                        <div class="error">
                            <?php if(strlen($message) > 1000): ?>
                                <?= $error ?>
                            <?php endif ?>
                        </div>
                        <div class="optionContact">
                            <label for="option">Choissisez une option</label>
                            <select name="optionContact">
                                <option>Problémes à signaler</option>
                                <option>Avis à propos du site</option>
                                <option>Besoin d'aide</option>
                                <option>Amélioration du site</option>
                            </select>
                        </div>
                        <div class="message">
                            <label for="message">Votre message :</label>
                            <textarea name="message" id="message" rows = "10" cols = "50"><?php sanitizeString($_POST['message'])?></textarea>
                        </div>
                        <div class="buttonSend">
                            <input type="submit" name="sendMessage" id="sendMessage" value="Envoyez mon message">
                        </div>
                    </fieldset>
                </form>
            </main>
        </div>
        <?php require_once '../FooterUse/footer.php' ?>
    </body>
    </html>