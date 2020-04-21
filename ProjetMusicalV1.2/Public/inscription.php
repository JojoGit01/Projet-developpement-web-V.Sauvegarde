<?php
require_once '../vendor/autoload.php';
require_once '../useFunction/sanitizeString.php';
use App\App;
use App\Inscription;
use App\User;
if(User::checkIfUserCo(App::getAuth())){
    header('Location: ../Public/accueilClient.php?log=1');
    exit();
}
if(isset($_POST['ValiderI'])){
    $name = sanitizeString(utf8_decode($_POST['nameI']));
    $prenom = sanitizeString(utf8_decode($_POST['prenomI']));
    $dateDeNaissance = sanitizeString(utf8_decode($_POST['ddnI']));
    $email = sanitizeString(utf8_decode($_POST['emailI']));
    $identifiant = sanitizeString(utf8_decode($_POST['identfiantI']));
    $motDePasse = sanitizeString(utf8_decode($_POST['passwordI']));
    try {
        $pdo = new Inscription(App::getPDO());
        $emailCheck = $pdo->checkEmail($email);
        if(!$emailCheck){
            $pdo->sendInscription($name, $prenom, $dateDeNaissance, $email, $identifiant, $motDePasse);
        } 
        else {
            $errorEmail = "Email déja utilisée !";
        }
    } catch (PDOExpression $e){
        echo 'Connexion éhouée : ' .$e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php if($emailCheck): ?>
        <p><?= $errorEmail ?>
    <?php endif ?>
    <form action="" method="post">
        <div class="">
            <input type="text" name="nameI" palceholder="Entrez nom" required>
            <input type="text" name="prenomI" placeholdeer="Prenom" required>
            <input type="date" name="ddnI" placeholder="date de naissance" required>
            <input type="email" name="emailI" placeholder="email" required>
            <input type="text" name="identfiantI" placeholder="identifiant" required>
            <input type="password" name="passwordI" placeholder="mdp" required>
        </div>
        <input type="submit" name="ValiderI" value="Valider">
    </form>
</body>
</html>