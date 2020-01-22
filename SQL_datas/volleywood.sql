-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 22 jan. 2020 à 16:15
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `volleywood`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_publication` datetime NOT NULL,
  `photo2` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo3` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo4` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apercu` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `photo`, `categorie`, `date_publication`, `photo2`, `photo3`, `photo4`, `apercu`) VALUES
(2, 'Tournoi special à Greoux-les-bains', 'L\'un des tournoi 3x3 que je peux vous conseiller se déroule en juillet tous les ans sur le site de la piscine municipale de Gréoux les bains. Une formule qui propose 2 tournois : un tournoi 3×3 masculin et un tournoi 3×3 féminin sur les 6 terrains à notre disposition. De nombreux lots sont à gagner et notamment de la Prize Money. Pour s\'inscrire c\'est ici : http://www.epdmvolley.fr/evenementiels/tournoi-beach-de-greoux/\r\n\r\nLe tarif est de 20€ par joueur et comprend un débardeur (dans la limite des tailles disponibles) et l’entrée de la piscine pour les deux jours. Il est à noter que les accompagnants pourront bénéficier du prix préférentiel d’entrée à la piscine de 2€ par journée.', 'greouxlesbains3-5e28500d7a5a4.jpeg', 'le gros plus de ce Tournoi 3x3 Soirée à la 8ème Avenue, restaurant en plein coeur de Gréoux et de la soirée brésilienne. Apéritif, plat, dessert et café accompagné d’un concert, le tout en terrasse privatisée. Le prix de cette soirée est de 20€ par personne, limitée à 110 personnes et uniquement sur réservation.', '2020-01-22 13:37:19', 'greouxlesbains4-5e28500d7c36e.jpeg', 'greouxlesbains1-5e28500e83ee1.jpeg', 'greouxlesbains2-5e28500e07da7.jpeg', 'greouxlesbains2-5e28500e07da7.jpeg'),
(4, 'Volleywood Summer #1', 'Présent depuis le printemps 2017 nos tournois sont annoncés sur le groupe Facebook ou la page officielle et propose des formules 2x2, 3x3, 4x4, Mixte, junior, tout niveau.\r\n\r\nen ligue sur toute la journée de 9h à 17h ou toutes les équipes s\'affrontent, ou en phase de poule avec classement par niveau : Elite, conselite et consolante, tous nos participants sont assurés de jouer toute la journée sans attendre entre les matchs.', 'summervolleywood1-5e285bc9b85cd.jpeg', 'N\'hésitez pas à nous rejoindre pour connaitre tous les tournois à venir et participer à nos sessions d\'entrainements et jeux.', '2020-01-22 14:27:23', 'summervolleywood2-5e285bc9bab66.jpeg', 'summervolleywood4-5e285bca40315.jpeg', 'summervolleywood3-5e285bcabc2e6.jpeg', 'summervolleywood3-5e285bcabc2e6.jpeg'),
(5, 'BeachvolleyMarathon', 'Si vous souhaiter participer à un tournoi international pendant 2 jours en 2x2, 3x3, 4x4 Mixte et visiter Venise et Bibione en Italie. Voici le Tournoi idéal. 2 fois par an le tournoi réunit des joueurs et joueuses du monde entier plus de 25000 participants.  Pour plus d\'information\r\nhttps://beachvolleymarathon.it', 'beachvolleymarathon60-5e285d7386735.jpeg', '💪 J\'ai eu la chance de participer 2 fois à des stages de perfectionnement ainsi qu\'au beachvolleymarathon à Bibione. 1 semaine complète de stage avec la coach pro Olga Troshina fut pour moi une veritable révélation. J\'avais jusqu\'alors un léger niveau \"Loisir\", je pratiqué le volley en Fsgt mais je n\'avais jamais eu l\'occasion d\'avoir un coaching personnalisé. N\'hesitez pas à sauter le pas ! Ne vous dites pas : \"ça sera trop difficile\", que \"vous n\'etes pas assez fort\", \"trop cher\" ou que \"la méthode ne vous conviendra pas\". 2 sessions d\'entrainements de 2h chaque jour pendant 1 semaine : perfectionnement techniques, tactiques et phases de jeux m\'ont permis d\'améliorer mes qualités physiques et mentales. (J\'ai perdu -3kg et affûté ma silhouette en 1 semaine) explosivité, réflexes, motricité, vision du jeu, discipline, endurance, puissance de frappes...\r\n\r\nTous ces indispensables à travailler pour passer d\'un bon à un excellent joueur de beachvolley. À mon retour sur Marseille mon niveau a totalement évolué, j\'ai gagné de très nombreux tournois, augmenté mon volume de jeu offensivement et defensivement ... C\'est même moi actuellement qui conseille et enseigne des secrets de volley à mes amis et co-équipiers. Les stages sont très formateurs, permettent de progresser rapidement et corrigent vos points faibles. Enfin pour lier le plaisir et l\'agréable vous pouvez voyager, découvrir, affronter des joueurs pros de toutes nationalitées, pratiquez la langue, profiter du dépaysement et la culture locale\".', '2020-01-22 14:34:29', 'beachvolleymarathon61-5e285d7388979.jpeg', 'beachvolleymarathon63-5e285d740e8be.jpeg', 'beachvolleymarathon62-5e285d748cbb2.jpeg', 'beachvolleymarathon62-5e285d748cbb2.jpeg'),
(6, 'Athlètes internationaux', 'Si il y a bien une chose incroyable avec le volley et le beachvolleyball c\'est la facilité de rencontrer des athlètes de toutes origines, tout niveau et se faire des amis.', 'rencontre60-5e286385f32bd.jpeg', 'Si en France ce sport n\'est pas assez populaire à mon avis, j\'ai pu constater que nos amis Allemands Italiens, Réunionnais, kanaks, Russes et Camerounais c\'est une vrai passion et lors d\'un séjour vacances ou erasmus trouvent toujours une occasion de jouer.', '2020-01-22 15:00:24', 'rencontre61-5e28638601f7b.jpeg', 'rencontre63-5e2863868082e.jpeg', '62-5e28638708e19.jpeg', '62-5e28638782ccd.jpeg'),
(7, 'Événements à venir', 'Pour 2020 Nous allons continuer nos sessions entrainements les week-ends plage du prophète 2x2 3x3 de 13h30 à 17h. Dès les beaux jours du printemps nous organiserons des Tournois plage du Prado, 1 fois par mois.\r\n\r\nà partir de Juin nous organiserons les soirées de 17h à 22h apéros-beachvolley-barbecue-coucherdesoleil et profiterons des événements de la région pour participer à un maximum de Tournoi de fin de saison.', 'avenir60-5e2864052ff37.jpeg', 'N\'hésitez pas à nous contacter si vous êtes un amoureux du volley, beach-volleyball et que vous souhaitez faire évoluer cette activité sur Marseille. Le Beachvolleyball 2x2 - 3x3 à Marseille pour tous 100% gratuit ! C\'est Nous ! Hommes, femmes, Mixtes, enfants, erasmus, debutants, pros, etc... C\'est ici que ça se passe ! Toute l\'année.', '2020-01-22 15:02:31', 'avenir61-5e28640531f64.jpeg', 'avenir63-5e286405ac552.jpeg', 'avenir62-5e28640633283.jpeg', 'avenir62-5e286406ad388.jpeg'),
(8, 'Tournoi 6x6 en salle', 'En Hivers et durant les vacances les clubs organisent des tournois en salle 4x4 mixte ou 6x6. Nous organisons les co-voiturages, les compositions des équipes si il manque des joueurs dans les équipes...', 'tournoi6x660-5e28649630ae8.jpeg', 'pour passer des journées à s\'éclater et repartir les bras chargés de cadeaux ou de bons souvenirs.', '2020-01-22 15:04:56', 'tournoi6x661-5e2864963337a.jpeg', 'tournoi6x663-5e286496aef7a.jpeg', 'tournoi6x662-5e286497363d6.jpeg', 'tournoi6x662-5e286497af0de.jpeg'),
(9, 'Shooting pour la collection Volleywood', 'Vous souhaitez porter nos couleurs ?', 'shooting60-5e2865104b31a.jpeg', 'Nous avons les casquettes, tee-shirts et débardeurs, Homme, Femme... grace à la boutique officielle.', '2020-01-22 15:06:58', 'shooting61-5e2865104e0a3.jpeg', 'shooting63-5e286510cbdaf.jpeg', 'shooting62-5e286511542e4.jpeg', 'shooting62-5e286511d0ded.jpeg'),
(10, 'La Tournée Volleywood', 'à partir du printemps de nombreux événements volley s\'offre à nous et nous avons nos tournois favoris à ne pas rater.\r\n\r\nAnnecy, Briançon, Digne Greoux-les-bains, Toulon, St Clair Lavandou, Fos Cavaou, Le Pradet, Le Luc ...', 'tournee60-5e286582c9d0c.jpeg', 'N\'hésitez pas à nous contacter si vous souhaitez faire partie de l\'aventure et découvrir les meilleurs tournois en France.', '2020-01-22 15:08:52', 'tournee61-5e286582cbc66.jpeg', 'tournee63-5e28658355679.jpeg', 'tournee62-5e286583d1bd0.jpeg', 'tournee62-5e286584581ff.jpeg'),
(11, 'Tournoi mixte 3x3', 'Nous avons pu organiser l\'événement parfait ce 30 et 31 Mars 2019. Avec la célèbre Coach FIVB et joueuse pro internationale Olga Troshina qui vient spécialement pour l\'occasion sur Marseille.', 'le3x360-5e2865dcf17dd.jpeg', 'Lors du Tournoi Special 3x3 et le stage de perfectionnement.', '2020-01-22 15:10:23', 'le3x361-5e2865dcf395a.jpeg', 'le3x363-5e2865dd7cab3.jpeg', 'le3x362-5e2865de07c4c.jpeg', 'le3x362-5e2865de80986.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `date_livraison` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6EEAA67DA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  PRIMARY KEY (`commande_id`,`produit_id`),
  KEY `IDX_DF1E9E8782EA2E54` (`commande_id`),
  KEY `IDX_DF1E9E87F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `poce_bleu` int(11) DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `date_publication` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC67B3B43D` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_article`
--

DROP TABLE IF EXISTS `commentaire_article`;
CREATE TABLE IF NOT EXISTS `commentaire_article` (
  `commentaire_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`commentaire_id`,`article_id`),
  KEY `IDX_71F29C35BA9CD190` (`commentaire_id`),
  KEY `IDX_71F29C357294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

DROP TABLE IF EXISTS `magasin`;
CREATE TABLE IF NOT EXISTS `magasin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produits_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_54AF5F27CD11A2CF` (`produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200122125558', '2020-01-22 12:56:13');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `nom` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14B78418F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couleur` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix_vente` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cle_activation` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar`, `ville`, `cp`, `adresse`, `cle_activation`) VALUES
(1, 'jerome@mail.me', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZTFBdFZwb2Y1anFZbUlrQw$L7WtVd46lv2rnjRqnJzPYW4oioTDrUwxMpg2/SZ/XZ4', 'jerome', 'decouvrez-pourquoi-l-alcool-est-interdit-dans-l-espace_0c19eaa8443c1d49ce45c31ecd61b67c92c431ec-5e2846d5141a9.jpeg', 'adjfhldskgrvb', '12345', 'dhgdycjh(dytrujhrytfgdvjgj', 'd7f2202e1f9a65a877fa143f21c1188e');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `FK_DF1E9E8782EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DF1E9E87F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commentaire_article`
--
ALTER TABLE `commentaire_article`
  ADD CONSTRAINT `FK_71F29C357294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_71F29C35BA9CD190` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `magasin`
--
ALTER TABLE `magasin`
  ADD CONSTRAINT `FK_54AF5F27CD11A2CF` FOREIGN KEY (`produits_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_14B78418F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
