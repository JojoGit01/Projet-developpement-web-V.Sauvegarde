<?php
//===================================================
// Name        : inscription.php
// Author      : Jonathan
// Version     : Final
// Description : Cette page permet à un utilisateur de s'inscrire sur le site.
//===================================================
require_once '../vendor/autoload.php';
require_once '../useFunction/sanitizeString.php';
use App\App;
use App\Inscription;
use App\User;
//Vérifier que l'utilisateur n'est pas déja connecter
if(User::checkIfUserCo(App::getAuth())) {
    header('Location: ../Public/accueilClient.php?log=1');
    exit();
}
if(isset($_POST['ValiderI'])) {
    $name = sanitizeString(utf8_decode($_POST['nameI']));
    $prenom = sanitizeString(utf8_decode($_POST['prenomI']));
    $dateDeNaissance = sanitizeString(utf8_decode($_POST['ddnI']));
    $email = sanitizeString(utf8_decode($_POST['emailI']));
    $identifiant = sanitizeString(utf8_decode($_POST['identfiantI']));
    $motDePasse = sanitizeString(utf8_decode($_POST['passwordI']));
    try {
        $pdo = new Inscription(App::getPDO());
        //Vérifier que l'email n'existe pas dans la base de donnée.
        $emailCheck = $pdo->checkEmail($email);
        //Vérifier que l'identifiant n'existe pas dans la base de donnée.
        $identifiantCheck = $pdo->checkIdentifiant($identifiant);
        if(!$emailCheck && !$identifiantCheck) {
            $pdo->sendInscription($name, $prenom, $dateDeNaissance, $email, $identifiant, $motDePasse);
        } 
        else {
            $errorIdentifiant = "Identifiant déja utilisée !";
            $errorEmail = "Email déja utilisée !";
        }
    } catch (PDOExpression $e) {
        echo 'Connexion éhouée : ' .$e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../Js/footerInformation/information.js"></script>
        <link rel="stylesheet" href="../Css/styleInscription.css">
        <title>Inscription Musical</title>
    </head>
    <body class="body-I">
        <header class="topbar">
            <nav>
                <img src="../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbar-D">
                    <a href="../index.php" title="Accueil Musical">Accueil</a>
                    <a href="connexion.php" title="Connexion Musical">Connexion</a>
                    <a href="#" onclick="informationLegales()" title="A propos">A propos</a>
                </div>
            </nav>
        </header>
        <div class="body-inscription">
            <main class="main-inscription">
                <form action="" method="post">
                    <fieldset class="fieldsetI">
                        <legend>Inscription</legend>
                        <?php if($emailCheck && $identifiantCheck || $emailCheck || $identifiantCheck): ?>
                            <label class="error"><?= $emailCheck && $identifiantCheck ? $errorEmail. "<br>" . $errorIdentifiant : ($emailCheck? $errorEmail : $errorIdentifiant) ?></label>
                        <?php endif ?>
                        <div class="nomI">
                            <label for="nomI">Nom :</label>
                            <input type="text" name="nameI" placeholder="Entrez nom" required>
                        </div>
                        <div class="prenomI">
                            <label for="prenomI">Prenom :</label>
                            <input type="text" name="prenomI" placeholder="Entrez prenom" required>
                        </div>
                        <div class="dateDeNaissanceI">
                            <label for="dateDeNaissanceI">Date de naissance :</label>
                            <input type="date" name="ddnI" placeholder="date de naissance" required>
                        </div>
                        <div class="emailI">
                            <label for="emailI">Email :</label>
                            <input type="email" name="emailI" placeholder="Votre email" required>
                        </div>
                        <div class="identifiantI">
                            <label for="identifiantI">Identifiant :</label>
                            <input type="text" name="identfiantI" placeholder="Votre identifiant" required>
                        </div>
                        <div class="motDePasseI">
                            <label for="motDePasseI">Mot de passe :</label>
                            <input type="password" name="passwordI" placeholder="Votre mot de passe" required>
                        </div>
                        <div class="verificationMotDePasseI">
                            <ul>
                                <li>Minimum 8 caractéres</li>
                                <li>Une lettre et un chiffre</li>
                                <li>Caractéres spéciaux</li>
                            </ul>
                        </div>
                        <div class="buttonI">
                            <input type="submit" id="validerI" name="ValiderI" value="Valider">
                            <input type="reset" id="resetI" name="resetI" value="Annuler">
                        </div>
                    </fieldset>
                </form>
            </main>
        </div>
        <?php require_once 'FooterUse/footer.php' ?>
    </body>
</html>