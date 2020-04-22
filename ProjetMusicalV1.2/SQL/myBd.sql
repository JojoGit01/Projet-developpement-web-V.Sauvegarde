/* My Base */

CREATE DATABASES ProjetMusical;

CREATE TABLE compteMusical (
    idCompteC INT AUTO_INCREMENT NOT NULL,
    nomC VARCHAR(300) NOT NULL,
    dateDeNaissance date NOT NULL,
    emailC VARCHAR(500) NOT NULL,
    identifiantC tinytext NOT NULL,
    motDePasseC CHAR(255) NOT NULL,
    prenomC VARCHAR(300) NOT NULL, 
    PRIMARY KEY(idCompteC)
);

CREATE TABLE album (
    codeAlbum INT AUTO_INCREMENT NOT NULL,
    nomAL VARCHAR(255) NOT NULL,
    anneeSortie year(4) NOT NULL,
    urlPochette VARCHAR(255) NOT NULL,
    PRIMARY KEY(codeAlbum)
);

CREATE TABLE artiste (
    numA INT AUTO_INCREMENT NOT NULL,
    nomA VARCHAR(255) NOT NULL,
    prenomA VARCHAR(255) NOT NULL,
    urlPhoto VARCHAR(255) NOT NULL,
    biographie TEXT NOT NULL, 
    PRIMARY KEY(numA)
);

CREATE TABLE chanson (
    codeChanson INT AUTO_INCREMENT NOT NULL,
    titreC VARCHAR(255) NOT NULL,
    duree TIME NOT NULL,
    auteurC VARCHAR(255) NOT NULL,
    noteOpinionC SMALLINT NOT NULL,
    
)

CREATE TABLE noter (

)