//===================================================
// Name        : inscription-helper.js
// Author      : Jonathan
// Version     : Final
//===================================================

const NEUTRAL = "neutral";
const ACTIVE = "active";

window.onload = () => {
    helperInscription();
}

function helperInscription () {
    
    let inscription_helper = document.getElementById('inscription_helper');
    inscription_helper.style.display = 'none';

    let caractere_minimum = document.getElementById('caractere_minimum');
    let chiffre_lettre = document.getElementById('chiffre_lettre');
    let caractere_speciaux = document.getElementById('caractere_speciaux');
    
    let regexChiffre = /[0-9]/;
    let regexLettre = /[a-z A-Z]/;
    let regexCaractereSpeciaux = /[!@#$%^&*()_+\-=\[\]{};':"\|,.<>\/? ]/;

    var motDePasseI = document.getElementById('passwordI');
    motDePasseI.addEventListener('click', () => { 
        inscription_helper.style.display = 'inline-block';
    });
    motDePasseI.addEventListener('input', () => {
        motDePasseI.value.length >= 8 ? neutralToActiveClass(caractere_minimum) : activeToNeutralClass(caractere_minimum);
        motDePasseI.value.match(regexChiffre) && motDePasseI.value.match(regexLettre) ? neutralToActiveClass(chiffre_lettre) : activeToNeutralClass(chiffre_lettre);
        motDePasseI.value.match(regexCaractereSpeciaux) ? neutralToActiveClass(caractere_speciaux) : activeToNeutralClass(caractere_speciaux);
    })
}

const neutralToActiveClass = ( nameClass ) => {
    nameClass.classList.remove(NEUTRAL);
    nameClass.classList.add(ACTIVE);
}
const activeToNeutralClass = ( nameClass ) => {
    nameClass.classList.remove(ACTIVE);
    nameClass.classList.add(NEUTRAL);
}