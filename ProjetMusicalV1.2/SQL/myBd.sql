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
    son VARCHAR(1000) NOT NULL,
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
('Comstock', 'Christopher', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/2016_Open_Beatz_-_Marshmello_-_by_2eight_-DSC_4448.jpg/220px-2016_Open_Beatz_-_Marshmello_-_by_2eight_-DSC_4448.jpg', "Christopher Comstock, né le 19 mai 1992, plus connu sous le pseudonyme de Marshmello, est un producteur, compositeur, DJ de musique électronique américain. Il a d'abord été connu pour ses remixes de Jack Ü et Zedd. En 2016, il se classe 28e puis 10e en 2017 dans le classement des DJ internationaux établi par DJ Mag3."),
('Jean-Philippe Smet', 'Léo', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Johnny_Hallyday_avp_2014_%28cropped%29.jpg/220px-Johnny_Hallyday_avp_2014_%28cropped%29.jpg', "Johnny Hallyday, de son vrai nom Jean-Philippe Smet, né le 15 juin 1943 dans le 9e arrondissement de Paris et mort le 5 décembre 2017 à Marnes-la-Coquette (Hauts-de-Seine), est un chanteur, compositeur et acteur français.Durant ses 57 ans de carrière, il s'impose comme l'un des plus célèbres chanteurs francophones et l'une des personnalités les plus présentes dans le paysage médiatique français.S'il n'est pas le premier à chanter du rock en France, il est, à partir de 1960, le premier à populariser le rock 'n' roll dans l'Hexagone. Les différents courants musicaux auxquels il s'adonne – le rock 'n' roll, la pop, le rhythm and blues, la soul, le rock psychédélique, le soft rock – puisent tous leurs origines dans le blues. Bien qu'il interprète de nombreuses ballades, des chansons de variété et parfois de country, le rock reste sa principale référence."),
("M'Roumbaba", 'Saïd', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Festival_des_Vieilles_Charrues_2015_-_Soprano_-_018.jpg/260px-Festival_des_Vieilles_Charrues_2015_-_Soprano_-_018.jpg', "Soprano, pseudonyme de Saïd M'Roumbaba, né le 14 janvier 1979, à Marseille (Bouches-du-Rhône)1, est un rappeur, chanteur et compositeur français. Soprano débute dans le rap avec le groupe Psy 4 de la rime dans la fin des années 1990 et courant des années 2000. Il se lance dans des projets solo et sort un premier album en 2007 Puisqu'il faut vivre."),
('Elizabeth Hudson', 'Katheryn', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Katy_Perry_2019_by_Glenn_Francis.jpg/220px-Katy_Perry_2019_by_Glenn_Francis.jpg', "Katy Perry, de son vrai nom Katheryn Elizabeth Hudson, née le 25 octobre 1984 à Santa Barbara (Californie), est une auteure-compositrice-interprète américaine de musique pop et rock. Après avoir chanté à l'église durant son enfance, elle poursuit une carrière dans la musique gospel à l'adolescence. Perry signe avec Red Hill Records et publie son premier album studio Katy Hudson sous son nom de naissance en 2001, ce qui échoue sur le plan commercial. Elle s'installe à Los Angeles, l'année suivante, pour se lancer dans la musique profane, après que Red Hill cesse ses activités, et elle commence ensuite à travailler avec les producteurs Glen Ballard, Dr Luke et Max Martin. Après avoir adopté le nom de scène Katy Perry, et avoir été abandonnée par Island Def Jam Music Group et Columbia Records, elle signe un contrat d'enregistrement avec Capitol Records en avril 2007."),
('Gandhi Djuna', 'Bilel', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Ma%C3%AEtre_Gims_Cannes_2016.jpg/220px-Ma%C3%AEtre_Gims_Cannes_2016.jpg', "Gandhi Djuna, dit Gims (prononcé : [ɡims]) et anciennement Maître Gims, est un chanteur, rappeur et compositeur congolais, né le 6 mai 1986 à Kinshasa au Zaïre (actuel République démocratique du Congo). Membre du groupe Sexion d'Assaut, il sort son premier album solo Subliminal en 2013, qui s'écoule à un million d'exemplaires1. Deux autres albums suivent, Mon cœur avait raison (2015) et Ceinture noire (2018). Il a vendu plus de 5 millions de disques, dont 2,5 millions d'albums depuis le début de sa carrière."),
('Post', 'Austin Richard', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Post_Malone_2018.jpg/220px-Post_Malone_2018.jpg', "Post Malone, de son vrai nom Austin Richard Post, né le 4 juillet 1995 à Syracuse dans l'État de New York, est un rappeur, chanteur et réalisateur artistique américain originaire de Dallas au Texas. Il se fait mondialement connaître en 2015 avec le titre White Iverson se classant à la 14e place du Billboard Hot 1001. Après une mixtape nommée August 26th (en), il publie son premier album Stoney en décembre 2016. Il atteint la quatrième place du top album américain et est certifié triple disque de platine aux États-Unis."),
('Martinez', 'Melanie', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/Melanie_martinez_%28cropped%29.jpg/260px-Melanie_martinez_%28cropped%29.jpg', "Melanie Adele Martinez, née le 28 avril 1995 à New York, est une auteure-compositrice-interprète, productrice, réalisatrice et actrice américaine. Melanie Martinez étudie à Plaza Elementary School, bénéficiant des cours de chant de son professeur. Elle commence à écrire des poèmes dès la maternelle. À l'âge de quatorze ans, elle apprend à jouer de la guitare d'elle-même."),
('Bowie', 'David', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/David-Bowie_Chicago_2002-08-08_photoby_Adam-Bielawski-cropped.jpg/220px-David-Bowie_Chicago_2002-08-08_photoby_Adam-Bielawski-cropped.jpg', "David Robert Jones dit David Bowie est un auteur-compositeur-interprète et acteur anglais né le 8 janvier 1947 à Londres et mort le 10 janvier 2016 à New York. Après des débuts entre folk et variété dans la seconde moitié des années 1960 et un détour par le mime, Bowie se fait connaître du public en 1969 avec la chanson Space Oddity. Il accède à la notoriété en 1972 : incarnant le personnage flamboyant de Ziggy Stardust, il devient l'une des figures de proue du courant glam rock avec l'album The Rise and Fall of Ziggy Stardust and the Spiders from Mars, épaulé par le guitariste Mick Ronson. Bowie s'intéresse ensuite aux musiques noires (R'n'B, soul et funk), décrochant son premier no 1 aux États-Unis en 1975 avec la chanson Fame, avant de s'expatrier à Berlin-Ouest et se tourner aux côtés de Brian Eno vers la musique électronique. Il produit entre 1977 et 1979 sa « trilogie berlinoise » (Low, 'Heroes' et Lodger), considérée comme un de ses sommets artistiques. "),
('Brown', 'James', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Jamesbrown4.jpg/220px-Jamesbrown4.jpg', "James Joseph Brown, Jr, né le 3 mai 1933 à Barnwell, Caroline du Sud, et mort le 25 décembre 2006 à Atlanta, est un musicien, chanteur, auteur-compositeur, danseur et producteur américain. Il est l'une des figures majeures du rhythm and blues, du funk, de la soul music, et du Black Arts Movement. Un des initiateurs du funk, il est fréquemment surnommé « The Godfather of Soul » (« Le Parrain de la Soul »). Tout au long d'une carrière qui a couvert six décennies, Brown est l'une des figures les plus influentes de la musique populaire du XXe siècle et est réputé pour ses performances scéniques. En 2004, le magazine Rolling Stone le classe à la 7e place dans sa liste des 100 plus grands artistes de tous les temps (List of the 100 Greatest Artists of All Time). James Brown a notamment été une grande source d'inspiration pour des chanteurs tels que Michael Jackson et Prince pour ne citer qu'eux. "),
('Marley', 'Bob', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Bob-Marley.jpg/260px-Bob-Marley.jpg', "Bob Marley, né Robert Nesta Marley le 6 février 1945 à Nine Mile (Jamaïque) et mort à trente-six ans d'un cancer généralisé le 11 mai 1981 à Miami (États-Unis), est un auteur-compositeur-interprète, chanteur et musicien jamaïcain. Il rencontre de son vivant un succès mondial, et reste à ce jour le musicien le plus connu du reggae, tout en étant considéré comme celui qui a permis à la musique jamaïcaine et au mouvement rastafari de connaître une audience planétaire. Il a vendu plus de 200 millions de disques à travers le monde."),
('Lennon', 'John', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/John_Lennon_rehearses_Give_Peace_A_Chance_cropped.jpg/260px-John_Lennon_rehearses_Give_Peace_A_Chance_cropped.jpg', "John Winston Ono Lennon, né le 9 octobre 1940 à Liverpool et mort assassiné le 8 décembre 1980 à New York, est un auteur-compositeur-interprète, musicien et écrivain britannique. Il est le fondateur des Beatles, groupe musical anglais au succès planétaire depuis sa formation au début des années 1960. Au sein des Beatles, il forme avec Paul McCartney l'un des tandems d'auteurs-compositeurs les plus influents et prolifiques de l'histoire du rock, donnant naissance à plus de deux cents chansons."),
('Mari', 'Julien', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/JUL_-_Julien_Mari_2018.jpg/220px-JUL_-_Julien_Mari_2018.jpg', "Jul, de son vrai nom Julien Mari1, est un rappeur et chanteur français, né le 14 janvier 1990 à Marseille. Il publie son premier single, Sort le cross volé, en novembre 2013 suivi en février 2014 d'un album entier, Dans ma paranoïa, le premier d'une série prolifique : deux albums complets par an depuis le début de sa carrière, tous certifiés au moins disque de platine. En 2015, Jul quitte le label Liga One Industry à la suite de désaccords financiers et fonde son propre label indépendant, D'or et de platine. L'année suivante, il reçoit la récompense du meilleur album de musique urbaine aux 32e Victoires de la musique pour l'album My World."),


/* Insert album */
INSERT INTO album ( nomAL, anneeSortie, urlPochette)
VALUES
('Joytime II', '2018', 'https://upload.wikimedia.org/wikipedia/en/thumb/0/0a/Marshmello_Joytime_II.jpg/220px-Marshmello_Joytime_II.jpg'),
('Rester vivant', '2014', 'https://img.discogs.com/84DRQLjj_lOmBtd3VEVf54lvV9c=/fit-in/300x300/filters:strip_icc():format(jpeg):mode_rgb():quality(40)/discogs-images/R-12306162-1532672176-9249.jpeg.jpg'),
('Le Corbeau', '2011', 'https://static.fnac-static.com/multimedia/FR/Images_Produits/FR/fnac.com/Visual_Principal_340/3/0/3/5099909779303/tsp20120919131625/Le-corbeau.jpg'),
('Prism', '2013', 'https://e.snmc.io/i/300/w/7da57c21ddb0fcf43380c19a6e60e129/7492365'),
('Ceinture noire', '2018', 'https://static.fnac-static.com/multimedia/Images/FR/NR/52/3e/90/9453138/1540-1/tsp20180802173439/Ceinture-Noire-1er-Dan.jpg'),
("Hollywood's Bleeding", '2019', 'https://twincitiesmedia.net/blog/wp-content/uploads/2019/09/postmalone_hollywoodsbleeding.jpg'),
('Dollhouse', '2014', 'https://img.discogs.com/YynP78iVFqxyU2rW1NS9xt4-f2s=/fit-in/300x300/filters:strip_icc():format(jpeg):mode_rgb():quality(40)/discogs-images/R-7177497-1439957972-5039.jpeg.jpg'),
("Let's Dance", '1983', 'https://static.fnac-static.com/multimedia/Images/FR/NR/0e/9b/a5/10853134/1540-1/tsp20190110101035/Lets-Dance-Edition-remasterisee.jpg'),
('The Payback', '1973', 'https://upload.wikimedia.org/wikipedia/en/4/40/Jb-the-payback.jpg'),
('Live Forever', '2011', 'https://images-na.ssl-images-amazon.com/images/I/41%2BmPpJPA3L._SY355_.jpg'),
('Abbey Road', '1969', 'https://images-na.ssl-images-amazon.com/images/I/91YlTtiGi0L._SY355_.jpg'),
('La Tête dans les nuages', '2017', 'https://static.booska-p.com/images/albums/la-tete-dans-les-nuages.jpg'),


/* Insert chanson */
INSERT INTO chanson (titreC, duree, auteurC, noteOpinionC, numA, codeAlbum, son) 
VALUES 
('Stars', '00:03:29', 'Marshmello', '5', '1', '1', 'https://www.youtube.com/embed/A57B7B6w3kw'),
("J'ai ce que j'ai donné", '00:03:40', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/LuCss-iwr-g'),
('One Love', '00:03:53', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/3XJmq96AFck'),
('Roar', '00:04:30', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/CevxZvSJLk8'),
('Intro', '00:01:10', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/M_QjE8062LI'),
("Hollywood's Bleeding", '00:02:36', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/w5GrxfjuTTI'),
('Dollhouse', '00:04:25', 'Melanie Martinez', '5', '7', '7', 'https://www.youtube.com/embed/HcVv9R1ZR84'),
('Modern Love', '00:03:49', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/HivQqTtiHVw'),
('The Payback', '00:07:39', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/istJXUJJP0g'),
('Jamming', '00:03:20', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/oFRbZJXjWIA'),
('Come Together', '00:04:20', '	John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/45cYwDMibGo'),
('Amigo', '00:04:04', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/eUgZZiPbXxg'),


