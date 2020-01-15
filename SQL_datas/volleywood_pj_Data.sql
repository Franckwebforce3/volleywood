--
-- Base de données :  `volleywood`
--

-- --------------------------------------------------------

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `categorie`, `taille`, `couleur`, `prix_vente`) VALUES
(1, 'Casquette grise', 'Casquette grise avec le logo du club', 'Casquette', NULL, '#BDBDBD;#0402d1;#f2c506', '30.00'),
(2, 'Casquette noire', 'Casquette noire avec le logo du club', 'Casquette', NULL, '#000000;#0402d1;#f2c506', '30.00'),
(3, 'Débardeur blanc pour Homme', 'Débardeur avec le logo du club', 'Vêtements', 'M;L', NULL, '15.00'),
(4, 'Débardeur blanc pour Femme', 'Débardeur avec le logo du club', 'Vêtements', 'M;L;XL', NULL, '15.00'),
(5, 'Débardeur noire pour Femme', 'Débardeur avec le logo du club', 'Vêtements', 'M;S;L;XL', NULL, '15.00'),
(6, 'Débardeur noir pour Homme', 'Débardeur avec le logo du club', 'Vêtements', 'M', NULL, '15.00'),
(7, 'Ballon  de volley du club', '', 'Ballon', NULL, NULL, '15.00'),
(8, 'Porte-Clé du club', 'Porte-clé du club', 'Goodies', NULL, NULL, '15.00'),
(9, 'Tee-shirt blanc', 'Tee-shirt blanc avec le logo', 'Vêtements', 'M;S;L', NULL, '20.00'),
(10, 'Tee-shirt noir', 'Tee-shirt noir avec le logo', 'Vêtements', 'M;L;XL', NULL, '20.00');

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
(13, 1, 'casquettenoir.png', 'casquette noire aussi');

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
(8, 8, 10),
(9, 9, 20),
(10, 10, 20);