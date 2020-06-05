<?php
//===================================================
// Name        : logout.php
// Author      : Jonathan
// Version     : Final
// Description : Ce code permet la déconnexion de l'utilisateur. Un utilisateur qui se déconnecte sera renvoyé à la page principal.
//===================================================
session_start();
session_destroy();
header('Location: ../index.php');
?>