<?php
//===================================================
// Name        : contact.php
// Author      : Jonathan
// Version     : Final
// Description : Page qui permet à un utilisateur de contacter le propiétaire du site.
//===================================================
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;
$user = App::getAuth()->user();
if(!$user) { header('Location: ../connexion.php'); }
if (isset($_POST['sendMessage'])) {
    $option = sanitizeString($_POST['optionContact']);
    $message = sanitizeString($_POST['message']);
    $message = strtr($message,[ "'" => "''" ]);
    $date = date("Y/m/d");
    if (strlen($message) >= 10) {
        if (strlen ($message) <= 1000) {
            $pdo = App::getPDO();
            $send = $pdo->prepare("INSERT INTO contact (identifiantC, optionC, messageC, dateC) VALUES ('$user->identifiantC', '$option', '$message', '$date')");
            $send->execute([
                'contact' => $user->identifiantC,
                'optionC' => $option,
                'messageC' => $message,
                'dateC' => $date
            ]);
            $succes = "Votre message à été envoyer !";
        } else {
            $errorBig = "Votre message est trop long";
        }
    } else {
        $errorSmall = "Votre message est trop court";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../../Js/footerInformation/information.js"></script>
        <!--<link rel="stylesheet" href="../../Css/styleFooter.css">-->
        <link rel="stylesheet" href="../../Css/styleContact.css">
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
                        <legend class="title-contact">Contactez nous</legend>
                        <div class="error_succes">
                            <?php if(strlen($message) < 10): ?>
                                <?= $errorSmall ?>
                            <?php endif ?>
                            <?php if(strlen($message) > 1000): ?>
                                <?= $errorBig ?>
                            <?php endif ?>
                            <?php if(strlen($message) > 10 || strlen($message) < 1000): ?>
                                <?= $succes ?>
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
                            <label for="message">Votre message </label>
                            <textarea name="message" id="message" rows = "15" cols = "30" style="resize: none"><?php sanitizeString($_POST['message'])?></textarea>
                        </div>
                        <div class="buttonSend">
                            <input type="submit" name="sendMessage" id="sendMessage" value="Envoyez mon message">
                        </div>
                    </fieldset>
                </form>
            </main>
        </div>
        <footer class="footer">
        <nav>
            <a href="/ProjetMusical/Public/viewsClient/contact.php" title="Conctater nous">Contactez nous</a>
            <a href="#" onclick="informationLegales()" title="Information légales">Information légales</a>
            <a href="#" onclick="politiqueDeConfidentialiteMusical()" title="Politique de confidentialité Musical">Politique de confidentialité Musical</a>
            <a href="#" onclick="informationCookie()" title="Information sur les cookies">Information sur les cookies</a>
        </nav>
    </footer>   
    </body>
    </html>