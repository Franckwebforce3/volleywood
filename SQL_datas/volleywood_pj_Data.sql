--
-- Base de données :  `volleywood_pjok`
--

-- --------------------------------------------------------

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar`, `ville`, `cp`, `adresse`, `cle_activation`) VALUES
(1, 'pascal.juillan@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$SFJUUTBJYWNzTDBGSWQzUg$8HFOqqh+5OPhZdZ98wHKQdrPHw2qLvLZY6RISDe6Huw', 'Pascal', 'avatar.jpg', 'Marseille', '13012', '', '1234'),
(2, 'volley.wood13@gmail.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$SFJUUTBJYWNzTDBGSWQzUg$8HFOqqh+5OPhZdZ98wHKQdrPHw2qLvLZY6RISDe6Huw', 'VolleyWood', 'avatar.jpg', 'Marseille', '13012', '', '1234');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `categorie`, `taille`, `couleur`, `prix_vente`) VALUES
(1, 'Casquette grise', 'Conçu pour le volley intense, votre tête sera toujours protégée du soleil\r\n\r\nCasquette grise, pliable et réglable. ', 'Casquette', NULL, '#BDBDBD;#0402d1;#f2c506', '30.00'),
(2, 'Casquette noire', 'Conçu pour le volley intense, votre tête sera toujours protégée du soleil\r\n\r\nCasquette grise, pliable et réglable. ', 'Casquette', NULL, '#000000;#0402d1;#f2c506', '30.00'),
(3, 'Débardeur blanc pour Homme', ' Nos concepteurs ont développé ce T-shirt Fitness coupe regular pour votre pratique du Pilates Gym douce. Il a été conçu pour une pratique à faible intensité.\r\n\r\nCe T-Shirt 100 Pilates Gym douce est travaillé en coupe droite et vous assure un confort optimal dans votre pratique sportive. ', 'Vêtements', 'M;L', NULL, '15.00'),
(4, 'Débardeur blanc pour Femme', ' Nos concepteurs ont développé ce T-shirt Fitness coupe regular pour votre pratique du Pilates Gym douce. Il a été conçu pour une pratique à faible intensité.\r\n\r\nCe T-Shirt 100 Pilates Gym douce est travaillé en coupe droite et vous assure un confort optimal dans votre pratique sportive. ', 'Vêtements', 'M;L;XL', NULL, '15.00'),
(5, 'Débardeur noire pour Femme', ' Nos concepteurs ont développé ce T-shirt Fitness coupe regular pour votre pratique du Pilates Gym douce. Il a été conçu pour une pratique à faible intensité.\r\n\r\nCe T-Shirt 100 Pilates Gym douce est travaillé en coupe droite et vous assure un confort optimal dans votre pratique sportive. ', 'Vêtements', 'S;M;L', NULL, '15.00'),
(6, 'Débardeur noir pour Homme', ' Nos concepteurs ont développé ce T-shirt Fitness coupe regular pour votre pratique du Pilates Gym douce. Il a été conçu pour une pratique à faible intensité.\r\n\r\nCe T-Shirt 100 Pilates Gym douce est travaillé en coupe droite et vous assure un confort optimal dans votre pratique sportive. ', 'Vêtements', 'M', NULL, '15.00'),
(7, 'Ballon de volley du club', 'Ballon de volley de taille officielle 5 adapté pour jouer au volley extérieur (taille 5). Grande résistance.  Ce ballon existe en tailles officielles 5 pour les enfants et les adultes. Robuste et agrippant, il est parfait pour débuter en extérieur à la maison ou sur le playground. ', 'Ballon', NULL, NULL, '15.00'),
(8, 'Porte-Clé du club', 'Porte-clé du club', 'Goodies', NULL, NULL, '15.00'),
(9, 'Tee-shirt blanc', ' Nos concepteurs ont développé ce T-shirt Fitness coupe regular pour votre pratique du Pilates Gym douce. Il a été conçu pour une pratique à faible intensité.\r\n\r\nCe T-Shirt 100 Pilates Gym douce est travaillé en coupe droite et vous assure un confort optimal dans votre pratique sportive. ', 'Vêtements', 'S;M;L', NULL, '20.00'),
(10, 'Tee-shirt noir', ' Nos concepteurs ont développé ce T-shirt Fitness coupe regular pour votre pratique du Pilates Gym douce. Il a été conçu pour une pratique à faible intensité.\r\n\r\nCe T-Shirt 100 Pilates Gym douce est travaillé en coupe droite et vous assure un confort optimal dans votre pratique sportive. ', 'Vêtements', 'M;L;XL', NULL, '20.00'),
(11, 'Moi en photo', 'test', 'Vêtements', 'M;L', NULL, '15.00');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `produit_id`, `nom`, `description`) VALUES
(1, 1, 'casquettegrise.png', 'Casquette grise'),
(2, 2, 'casquettenoir.png', 'Casquette noire'),
(3, 3, 'debardeurblanchomme.png', 'Débardeur blanc'),
(4, 4, 'debardeurfemmeblanc.png', 'Débardeur blanc'),
(7, 5, 'debardeurfemmenoir.png', 'Débardeur noire'),
(8, 6, 'debardeurnoirhomme.png', 'Débardeur noire'),
(9, 7, 'logo_ballon.png', 'Ballon avec le logo'),
(10, 8, 'portecle.png', 'Porte-clé du club'),
(11, 9, 'tee-shirtblanc.png', 'Tee-shirt blanc'),
(12, 10, 'tee-shirtnoir.png', 'Tee-shirt noir'),
(13, 1, 'casquettenoir.png', 'casquette noire aussi'),
(14, 1, 'tee-shirtnoir.png', 'casquette noire aussi 2'),
(16, 11, 'debardeurfemmenoir.png', 'sdsdsd');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `magasin`
--

INSERT INTO `magasin` (`id`, `produits_id`, `quantite`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 15),
(4, 4, 10),
(5, 5, 20),
(6, 6, 10),
(7, 7, 20),
(8, 8, 0),
(9, 9, 0),
(10, 10, 20),
(11, 11, 6);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `etat`, `date_livraison`, `refcommande`) VALUES
(1, 1, 2, '2015-01-01 00:00:00', '17012018-1723');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`id`, `commandes_id`, `produits_id`, `quantite`) VALUES
(1, 1, 5, 2),
(2, 1, 8, 3),
(3, 1, 7, 3);