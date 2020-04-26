<?php
/*
    - Ce code permet de sanitize les données rentrées par l'utilisateur
*/
// Sanitize les données //
function sanitizeString($var)
{
    if (get_magic_quotes_gpc())
    {
        //Supprimer les slashes
        $var = stripcslashes($var);
    }
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;   
}
?>