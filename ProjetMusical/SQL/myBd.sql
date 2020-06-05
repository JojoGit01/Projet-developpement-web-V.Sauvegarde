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
    noteOpinionC FLOAT NOT NULL,
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
    note FLOAT NOT NULL,
    PRIMARY KEY(codeChanson, identifiantC)
);

CREATE TABLE contact (
    identifiantC VARCHAR(300) NOT NULL,
    optionC VARCHAR(100) NOT NULL,
    messageC VARCHAR(1000) NOT NULL,
    dateC DATE NOT NULL
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
('Come Together', '00:04:20', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/45cYwDMibGo'),
('Amigo', '00:04:04', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/eUgZZiPbXxg'),


('Together', '00:03:48', 'Marshmello', '5', '1', '1',       'https://www.youtube.com/embed/JePnQ1gSagc'),
('Rooftops', '00:03:04', 'Marshmello', '5', '1', '1',       'https://www.youtube.com/embed/1N3vUlC5354'),
('Check This Out', '00:03:13', 'Marshmello', '5', '1', '1', 'https://www.youtube.com/embed/D8tA6KGgmJE'),
('Flashbacks', '00:02:45', 'Marshmello', '5', '1', '1',     'https://www.youtube.com/embed/Lj-_mD0w474'),
('Tell Me', '00:02:39', 'Marshmello', '5', '1', '1',        'https://www.youtube.com/embed/x3y4WdN4PI8'),
('Paralyzed', '00:03:10', 'Marshmello', '5', '1', '1',      'https://www.youtube.com/embed/bYiAspDYNgU'),
('Power', '00:02:52', 'Marshmello', '5', '1', '1',          'https://www.youtube.com/embed/KUaVjms6yyY'),
('Imagine', '00:02:55', 'Marshmello', '5', '1', '1',        'https://www.youtube.com/embed/dUweAQ38Ed8'),


("Regarde-nous", '00:03:33', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/g26R1RC_tg4'),
("Rester vivant", '00:04:37', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/K1WEkxzgqRQ'),
("Seul", '00:03:40', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/SrhesRJdsWM'),
("Au café de l'avenir", '00:04:11', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/K5A03tm_JS8'),
("Une lettre à l'enfant que j'étai", '00:03:35', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/0woJBcmxmD0'),
("J'tai même pas dit merci", '00:05:17', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/8C5uSq1Y4A8'),
("Si j'avais su la vie", '00:03:44', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/x5N65RhcdH4'),
("On s'habitue à tout", '00:03:39', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/6U_SQJowAMk'),
("Te manquer", '00:04:41', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/48LzuCWr_qI'),
("Te voir grandir", '00:03:22', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/y2DhmmvLfPM'),
("À nos promesses", '00:03:59', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/rfEpq5UEdxI'),
("Chanteur de chansons", '00:03:33', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/l9I0uFKX-zQ'),
("On s'accroche", '00:03:05', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/2CxcvqpPLng'),
("Je t'attendrai", '00:03:48', 'Johnny Hallyday','5', '2', '2', 'https://www.youtube.com/embed/bxg8WRaZfb8'),




('Piranhas', '00:04:08', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/o_tuNE5ei9o'),
('Avec le temps', '00:04:15', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/OwsEXKn2Rlk'),
('Dopé', '00:03:50', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/K2wzwBUhVlE'),
('Fly', '00:03:35', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/7uVZ1HHp00g'),
('Invincible ', '00:04:49', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/L_wFlBGwIkk'),
('Kamarades', '00:04:16', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/lF-dWfG7QfA'),
('Interlude', '00:02:34', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/0_d1GrvCluc'),
("C'est la vie", '00:03:59', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/sgGaNAxzz3s'),
('Regarde-moi', '00:04:35', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/iAdOjMbMMzI'),
('Halloween', '00:04:37', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/1t-iO0koIGQ'),
('Sale Sud Anthem', '00:03:58', 'Soprano', '5', '3', '3', 'https://www.youtube.com/embed/Bs_8TdfOFlU'),


('Legendary Lovers', '00:03:44', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/2t2WLGW2Kvs'),
('Birthday', '00:03:35', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/C8nmKMBgrFI'),
('Walking on Air', '00:03:42', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/t4D5egXVqSg'),
('Unconditionally', '00:03:49', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/kWKoOlksycA'),
('Dark Horse', '00:03:35', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/F7VBnbt0_-w'),
('This Is How We Do', '00:03:24', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/NIWOv6yiorE'),
('International Smile', '00:03:48', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/MbgqBjF_CSE'),
('Ghost', '00:03:23', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/1Y2RCpL-cN4'),
('Love Me', '00:03:53', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/cs70lPVw_Fs'),
('This Moment', '00:03:47', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/8gslblqGkWI'),
('Double Rainbow', '00:03:52', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/JvivlCTnu78'),
('By the Grace of God', '00:04:28', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/HfIZ7WXvDxo'),
('Spiritual', '00:04:36', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/p-T3Zv_1vdQ'),
('It Takes Two', '00:03:54', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/QABAMRwe53Q'),
('Choose Your Battles', '00:04:27', 'Katy Perry', '5', '4', '4', 'https://www.youtube.com/embed/InWVBB9UCqQ'),


('Tant pis', '00:03:49', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/MBotef6Af9w'),
('Caméléon', '00:03:26', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/_JwpG_rRkHs'),
('Fuegolando', '00:03:01', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/GT3wNLS98IM'),
('La Même', '00:03:20', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/fC6YV65JJ6g'),
('Loup-garou', '00:03:58', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/LLK3Jit-sWk'),
("Entre nous c'est mort", '00:03:38', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/e_8yA9LD_oY'),
('Laissez-moi tranquille', '00:03:28', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/6fP5irHryt4'),
('Mi Gna', '00:03:35', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/NtccSFkAhrM'),
('Tu reviendras', '00:03:29', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/3yv5x7xE3j0'),
('Nos valeurs', '00:03:56', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/Oac96ew0wjU'),
('Tu ne le vois pas', '00:04:22', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/CTTth1-G2o4'),
('Merci Maman', '00:02:55', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/gEVVOVvxrNc'),
("T'es partie", '00:03:57', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/GiEf37zX8yA'),
("Tu m'as dit", '00:03:55', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/sPHVY6QGKwA'),
('Oulala', '00:03:01', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/mUG23j1r7Ak'),
('Bonita', '00:03:34', 'Gims', '5', '5', '5', 'https://www.youtube.com/embed/yN80UcVuAXE'),


("Saint-Tropez", '00:02:30', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/le3l_6K6U0E'),
("Enemies", '00:03:16', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/qT_y5Yc8jSA'),
("Allergic", '00:02:36', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/JdttvuGdlvs'),
("A Thousand Bad Times", '00:03:41', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/ul-9U681Y2c'),
("Circles", '00:03:46', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/wXhTHyIgQ_U'),
("Die for Me", '00:04:05', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/I_QpDE-Uco0'),
("On the Road", '00:03:38', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/yw_ShLNyHTk'),
("Take What You Want", '00:03:49', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/LYa_ReqRlcs'),
("I'm Gonna Be", '00:03:20', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/s1XbPXdgEEA'),
("Staring at the Sun", '00:02:48', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/Wq6EeYFiAZU'),
("Sunflower", '00:02:38', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/z9VMaLxg9Ok'),
("Internet", '00:02:03', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/weXNuvoyEr0'),
("Goodbyes", '00:02:56', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/YgKDE5eYNqc'),
("Myself", '00:02:38', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/gqthPT8vK7o'),
("I Know", '00:02:21', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/k7fiZ_if2Bg'),
("Wow", '00:02:29', 'Post Malone', '5', '6', '6', 'https://www.youtube.com/embed/NA4uIFbVCPM'),


('Carousel', '00:03:50', 'Melanie Martinez', '5', '7', '7', 'https://www.youtube.com/embed/zAB5AC9yhY0'),
('Dead to Me', '00:03:30', 'Melanie Martinez', '5', '7', '7', 'https://www.youtube.com/embed/s2N_-TJUE_w'),
('Bittersweet Tragedy', '00:04:49', 'Melanie Martinez', '5', '7', '7', 'https://www.youtube.com/embed/Y9bETCh68c4'),


('China Girl', '00:04:06', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/_YC3sTbAPcU'),
("Let's Dance", '00:07:38', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/gHlwJvPv9C0'),
('Without You', '00:03:08', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/nXoD5Gz-Aak'),
('Ricochet', '00:05:14', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/YOKA-e4MWPo'),
('Criminal World', '00:04:25', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/oUbLegcKgIc'),
('Cat People', '00:05:09', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/m0ODoeBc04g'),
('Shake It', '00:03:52', 'David Bowie', '5', '8', '8', 'https://www.youtube.com/embed/jsQkWanuDOA'),


('Doing the Best I Can', '00:07:42', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/DRLNwl3-SJE'),
('Take Some...Leave Some', '00:08:33', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/4k1V0w7-Xrs'),
('Shoot Your Shot', '00:08:09', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/r16GK_zm7sc'),
('Forever Suffering', '00:05:52', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/qGdQs5nn_Ug'),
('Time Is Running out Fast', '00:12:47', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/Oklr8eOwsVI'),
('Stone to the Bone', '00:10:14', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/QON_23CPKQQ'),
('Mind Power', '00:12:04', 'James Brown', '5', '9', '9', 'https://www.youtube.com/embed/7naR12OPxRw'),


('Exodus', '00:07:40', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/HmLNHVBhEjA'),
('Redemption Song', '00:03:53', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/1A95dcLxAuA'),
('Coming in from the Cold', '00:04:31', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/EF0Jtl-dpyE'),
('Could You Be Loved', '00:03:57', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/zBqW6yKz8WA'),
('Is This Love', '00:03:54', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/69RdQFDuYPI'),
('Work', '00:03:41', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/NKHdvDkDAHk'),
('Get Up, Stand Up', '00:03:10', 'Bob Marley', '5', '10', '10', 'https://www.youtube.com/embed/O8ECZOPgId0'),


('Something', '00:03:02', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/MZ3Vh8jZFdE'),
("Maxwell's Silver Hammer", '00:03:27', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/mJag19WoAe0'),
('Oh! Darling', '00:03:26', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/9BznFjbcBVs'),
("Octopus's Garden", '00:02:51', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/De1LCQvbqV4'),
('I Want You', '00:07:47', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/tAe2Q_LhY8g'),
('Here Comes the Sun', '00:03:05', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/xUNqsfFUwhY'),
('Because', '00:02:45', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/hL0tnrl2L_U'),
('You Never Give Me Your Money', '00:04:02', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/BpndGZ71yww'),
('Sun King', '00:02:25', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/6bNMxWGHlTI'),
('Mean Mr. Mustard', '00:01:06', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/oMarHac3VpQ'),
('Polythene Pam', '00:01:12', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/Cb0dTdTeHMU'),
('She Came In Through the Bathroom Window', '00:01:58', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/NVv7IzEVf3M'),
('Golden Slumbers', '00:01:31', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/AcQjM7gV6mI'),
('Carry That Weight', '00:01:36', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/6B224XDJw6g'),
('The End', '00:02:05', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/12R4FzIhdoQ'),
('Her Majesty', '00:00:23', 'John Lennon', '5', '11', '11', 'https://www.youtube.com/embed/Mh1hKt5kQ_4'),


('Henrico', '00:03:49', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/CGg8fZ1LUFI'),
('Délicieuse', '00:04:04', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/e21P62KZqAM'),
('Tu mentiras', '00:03:40', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/yxvb7LLVh5k'),
('La tête dans les nuages', '00:03:43', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/d1MYi2-SSmk'),
('Ou lalala', '00:03:36', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/Utc4PS47esI'),
("Je vais t'oublier", '00:02:54', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/rTKoFEEJnaw'),
("Je traîne seul", '00:03:57', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/r9EiQSQsWS0'),
("Comme les gens d'ici", '00:03:10', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/7echk8kqtJw'),
("Fratellu", '00:03:54', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/X5i5gANNc4k'),
('Madame', '00:04:01', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/eH_DVHr37M4'),
('Le jaloux', '00:04:27', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/jmVXFufyHZ4'),
('Je ne vous oublie pas', '00:04:42', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/PNpe_7MtM84'),
('Je ne veux pas partir', '00:04:11', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/HdvxmubFypo'),
('Samantha', '00:04:17', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/9dz78yQcJ3I'),
('Facilement', '00:03:21', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/PtylfuNogG4'),
('Comme un fou', '00:03:16', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/S2ZwocpPRLk'),
('Mauvaise journée', '00:04:25', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/EYcHCt2Y3NM'),
("Temps d'avant", '00:05:41', 'Jul', '5', '12', '12', 'https://www.youtube.com/embed/rRuwrwZZXvY'),








