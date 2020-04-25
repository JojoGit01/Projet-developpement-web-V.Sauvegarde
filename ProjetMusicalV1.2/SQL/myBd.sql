/* My Base */

CREATE DATABASES ProjetMusical;

CREATE TABLE compteMusical (
    idCompteC INT AUTO_INCREMENT NOT NULL,
    nomC VARCHAR(300) NOT NULL,
    dateDeNaissance date NOT NULL,
    emailC VARCHAR(500) NOT NULL,
    identifiantC VARCHAR(300) NOT NULL,
    motDePasseC CHAR(255) NOT NULL,
    prenomC VARCHAR(300) NOT NULL, 
    PRIMARY KEY(idCompteC, identifiantC)
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
    numA INT NOT NULL,
    codeAlbum INT NOT NULL,
    PRIMARY KEY(codeChanson),
    FOREIGN KEY(numA) REFERENCES artiste(numA),
    FOREIGN KEY(codeAlbum) REFERENCES album(codeAlbum)
);

CREATE TABLE noter (
    codeChanson INT NOT NULL,
    identifiantC VARCHAR(300) NOT NULL,
    note SMALLINT NOT NULL,
    PRIMARY KEY(codeChanson, identifiantC)
);



/* 
    1 album -> 1 artiste -> x chanson -> 15 Artiste min /
*/
/* Insert */

/* Insert artiste */
INSERT INTO artiste ( nomA, prenomA, urlPhoto, biographie) 
VALUES
('Comstock', 'Christopher', 'img/imgArtiste/marshmello.jpeg', "Christopher Comstock, né le 19 mai 1992, plus connu sous le pseudonyme de Marshmello, est un producteur, compositeur, DJ de musique électronique américain. Il a d'abord été connu pour ses remixes de Jack Ü et Zedd. En 2016, il se classe 28e puis 10e en 2017 dans le classement des DJ internationaux établi par DJ Mag3."),
('Jean-Philippe Smet', 'Léo', 'img/imgArtiste/johnnyHallyday.jpg', "Johnny Hallyday, de son vrai nom Jean-Philippe Smet, né le 15 juin 1943 dans le 9e arrondissement de Paris et mort le 5 décembre 2017 à Marnes-la-Coquette (Hauts-de-Seine), est un chanteur, compositeur et acteur français.Durant ses 57 ans de carrière, il s'impose comme l'un des plus célèbres chanteurs francophones et l'une des personnalités les plus présentes dans le paysage médiatique français.S'il n'est pas le premier à chanter du rock en France, il est, à partir de 1960, le premier à populariser le rock 'n' roll dans l'Hexagone. Les différents courants musicaux auxquels il s'adonne – le rock 'n' roll, la pop, le rhythm and blues, la soul, le rock psychédélique, le soft rock – puisent tous leurs origines dans le blues. Bien qu'il interprète de nombreuses ballades, des chansons de variété et parfois de country, le rock reste sa principale référence."),
("M'Roumbaba", 'Saïd', 'img/imgArtiste/soprano.jpg', "Soprano, pseudonyme de Saïd M'Roumbaba, né le 14 janvier 1979, à Marseille (Bouches-du-Rhône)1, est un rappeur, chanteur et compositeur français. Soprano débute dans le rap avec le groupe Psy 4 de la rime dans la fin des années 1990 et courant des années 2000. Il se lance dans des projets solo et sort un premier album en 2007 Puisqu'il faut vivre."),
('Elizabeth Hudson', 'Katheryn', 'img/imgArtiste/katyPerry.jpg', "Katy Perry, de son vrai nom Katheryn Elizabeth Hudson, née le 25 octobre 1984 à Santa Barbara (Californie), est une auteure-compositrice-interprète américaine de musique pop et rock. Après avoir chanté à l'église durant son enfance, elle poursuit une carrière dans la musique gospel à l'adolescence. Perry signe avec Red Hill Records et publie son premier album studio Katy Hudson sous son nom de naissance en 2001, ce qui échoue sur le plan commercial. Elle s'installe à Los Angeles, l'année suivante, pour se lancer dans la musique profane, après que Red Hill cesse ses activités, et elle commence ensuite à travailler avec les producteurs Glen Ballard, Dr Luke et Max Martin. Après avoir adopté le nom de scène Katy Perry, et avoir été abandonnée par Island Def Jam Music Group et Columbia Records, elle signe un contrat d'enregistrement avec Capitol Records en avril 2007."),
('Gandhi Djuna', 'Bilel', 'img/imgArtiste/gims.jpg', "Gandhi Djuna, dit Gims (prononcé : [ɡims]) et anciennement Maître Gims, est un chanteur, rappeur et compositeur congolais, né le 6 mai 1986 à Kinshasa au Zaïre (actuel République démocratique du Congo). Membre du groupe Sexion d'Assaut, il sort son premier album solo Subliminal en 2013, qui s'écoule à un million d'exemplaires1. Deux autres albums suivent, Mon cœur avait raison (2015) et Ceinture noire (2018). Il a vendu plus de 5 millions de disques, dont 2,5 millions d'albums depuis le début de sa carrière."),
('Post', 'Austin Richard', 'img/imgArtiste/postMalone.jpg', "Post Malone, de son vrai nom Austin Richard Post, né le 4 juillet 1995 à Syracuse dans l'État de New York, est un rappeur, chanteur et réalisateur artistique américain originaire de Dallas au Texas. Il se fait mondialement connaître en 2015 avec le titre White Iverson se classant à la 14e place du Billboard Hot 1001. Après une mixtape nommée August 26th (en), il publie son premier album Stoney en décembre 2016. Il atteint la quatrième place du top album américain et est certifié triple disque de platine aux États-Unis."),
('Martinez', 'Melanie', 'img/imgArtiste/melanieMartinez.jpg', "Melanie Adele Martinez, née le 28 avril 1995 à New York, est une auteure-compositrice-interprète, productrice, réalisatrice et actrice américaine. Melanie Martinez étudie à Plaza Elementary School, bénéficiant des cours de chant de son professeur. Elle commence à écrire des poèmes dès la maternelle. À l'âge de quatorze ans, elle apprend à jouer de la guitare d'elle-même."),
('Bowie', 'David', 'img/imgArtiste/davidBowie.jpg', "David Robert Jones dit David Bowie est un auteur-compositeur-interprète et acteur anglais né le 8 janvier 1947 à Londres et mort le 10 janvier 2016 à New York. Après des débuts entre folk et variété dans la seconde moitié des années 1960 et un détour par le mime, Bowie se fait connaître du public en 1969 avec la chanson Space Oddity. Il accède à la notoriété en 1972 : incarnant le personnage flamboyant de Ziggy Stardust, il devient l'une des figures de proue du courant glam rock avec l'album The Rise and Fall of Ziggy Stardust and the Spiders from Mars, épaulé par le guitariste Mick Ronson. Bowie s'intéresse ensuite aux musiques noires (R'n'B, soul et funk), décrochant son premier no 1 aux États-Unis en 1975 avec la chanson Fame, avant de s'expatrier à Berlin-Ouest et se tourner aux côtés de Brian Eno vers la musique électronique. Il produit entre 1977 et 1979 sa « trilogie berlinoise » (Low, 'Heroes' et Lodger), considérée comme un de ses sommets artistiques. "),
('Brown', 'James', 'img/imgArtiste/jamesBrown.jpg', "James Joseph Brown, Jr, né le 3 mai 1933 à Barnwell, Caroline du Sud, et mort le 25 décembre 2006 à Atlanta, est un musicien, chanteur, auteur-compositeur, danseur et producteur américain. Il est l'une des figures majeures du rhythm and blues, du funk, de la soul music, et du Black Arts Movement. Un des initiateurs du funk, il est fréquemment surnommé « The Godfather of Soul » (« Le Parrain de la Soul »). Tout au long d'une carrière qui a couvert six décennies, Brown est l'une des figures les plus influentes de la musique populaire du XXe siècle et est réputé pour ses performances scéniques. En 2004, le magazine Rolling Stone le classe à la 7e place dans sa liste des 100 plus grands artistes de tous les temps (List of the 100 Greatest Artists of All Time). James Brown a notamment été une grande source d'inspiration pour des chanteurs tels que Michael Jackson et Prince pour ne citer qu'eux. "),
('Marley', 'Bob', 'img/imgArtiste/bobMarley.jpg', "Bob Marley, né Robert Nesta Marley le 6 février 1945 à Nine Mile (Jamaïque) et mort à trente-six ans d'un cancer généralisé le 11 mai 1981 à Miami (États-Unis), est un auteur-compositeur-interprète, chanteur et musicien jamaïcain. Il rencontre de son vivant un succès mondial, et reste à ce jour le musicien le plus connu du reggae, tout en étant considéré comme celui qui a permis à la musique jamaïcaine et au mouvement rastafari de connaître une audience planétaire. Il a vendu plus de 200 millions de disques à travers le monde."),
('Lennon', 'John', 'img/imgArtiste/johnLennon.jpg', "John Winston Ono Lennon, né le 9 octobre 1940 à Liverpool et mort assassiné le 8 décembre 1980 à New York, est un auteur-compositeur-interprète, musicien et écrivain britannique. Il est le fondateur des Beatles, groupe musical anglais au succès planétaire depuis sa formation au début des années 1960. Au sein des Beatles, il forme avec Paul McCartney l'un des tandems d'auteurs-compositeurs les plus influents et prolifiques de l'histoire du rock, donnant naissance à plus de deux cents chansons."),
('Mari', 'Julien', 'img/imgArtiste/julienMari.jpg', "Jul, de son vrai nom Julien Mari1, est un rappeur et chanteur français, né le 14 janvier 1990 à Marseille. Il publie son premier single, Sort le cross volé, en novembre 2013 suivi en février 2014 d'un album entier, Dans ma paranoïa, le premier d'une série prolifique : deux albums complets par an depuis le début de sa carrière, tous certifiés au moins disque de platine. En 2015, Jul quitte le label Liga One Industry à la suite de désaccords financiers et fonde son propre label indépendant, D'or et de platine. L'année suivante, il reçoit la récompense du meilleur album de musique urbaine aux 32e Victoires de la musique pour l'album My World."),


/* Insert album */
INSERT INTO album ( nomAL, anneeSortie, urlPochette)
VALUES
('Joytime II', '2018', 'img/imgAlbum/Joytime_II.jpg'),
('Rester vivant', '2014', 'img/imgAlbum/Rester-vivant.jpg'),
('Le Corbeau', '2011', 'img/imgAlbum/Le-corbeau.jpg'),
('Prism', '2013', 'img/imgAlbum/Prism.jpg'),
('Ceinture noire', '2018', 'img/imgAlbum/Ceinture-Noire.jpg'),
("Hollywood's Bleeding", '2019', 'img/imgAlbum/hollywoodsbleeding.jpg'),
('Dollhouse', '2014', 'img/imgAlbum/Dollhouse.jpg'),
("Let's Dance", '1983', 'img/imgAlbum/letDance.jpg'),
('The Payback', '1973', 'img/imgAlbum/the-payback.jpg'),
('Live Forever', '2011', 'img/imgAlbum/LiveForever.jpg'),
('Abbey Road', '1969', 'img/imgAlbum/abbeyRoad.jpg'),
('La Tête dans les nuages', '2017', 'img/imgAlbum/laTeteDansLesNuages.jpg'),


/* Insert chanson */
INSERT INTO chanson (titreC, duree, auteurC, noteOpinionC, numA, codeAlbum) 
VALUES 
('Stars', '00:04:06', 'Marshmello', '5', '1', '1'),
("J'ai ce que j'ai donné", '00:03:40', 'Johnny Hallyday','5', '2', '2'),
('One Love', '00:03:53', 'Soprano', '5', '3', '3'),
('Roar', '00:03:42', 'Katy Perry', '5', '4', '4'),
('Intro', '00:01:10', 'Gims', '5', '5', '5'),
("Hollywood's Bleeding", '00:02:36', 'Post Malone', '5', '6', '6'),
('Dollhouse', '00:03:51', 'Melanie Martinez', '5', '7', '7'),
('Modern Love', '00:04:46', 'David Bowie', '5', '8', '8'),
('The Payback', '00:07:39', 'James Brown', '5', '9', '9'),
('Jamming', '00:04:31', 'Bob Marley', '5', '10', '10'),
('Come Together', '00:04:20', '	John Lennon', '5', '11', '11'),
('Amigo', '00:02:55', 'Jul', '5', '12', '12'),
