-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 13 jan. 2019 à 20:54
-- Version du serveur :  5.6.38
-- Version de PHP :  5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ft_minishop`
--

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'sweet home apero', 'Table basse\r\n<br> Fabriquée sur demande\r\n<br> Différents pieds au choix', '400.00', 'image/photo-article/tb-b-1-web.jpg'),
(2, 'sweet home bureau', 'Bureau\r\n<br> Fabriqué sur demande\r\n', '600.00', 'image/photo-article/b-b-2-web.jpg'),
(3, 'Etagère skate', 'Recyclez vos vieux skates pour des étagères stylées', '150.00', 'image/photo-article/e-b-1-web.jpg'),
(4, 'Bureau plein bois', 'Brut et élégant', '150.00', 'image/photo-article/b-b-4.jpeg'),
(5, 'Bureau bois clair', 'PIeds en biais pour plus de place pour les jambes', '250.00', 'image/photo-article/b-b-5.jpeg'),
(6, 'Bureau écolier', 'Forme écolier \r\n<br> Matières modernes', '250.00', 'image/photo-article/b-bm-1.jpeg'),
(7, 'bureau beau pied', 'D\'une stabilité à toute épreuve', '159.00', 'image/photo-article/b-m-2.jpeg'),
(8, 'Epure', 'La simplicité à l\'état pur', '360.00', 'image/photo-article/b-m-3.jpeg'),
(9, 'Estalière', 'Etagère en escalier\r\n<br> Beau bois clair', '674.00', 'image/photo-article/e-b-4.jpeg'),
(10, 'pyragère', 'Etagère en forme de pyramide\r\n<br> Toute de bois', '145.00', 'image/photo-article/e-b-7.jpeg'),
(11, 'Noir X bois', 'Une structure renforcée\r\n<br> Pour une étagère solde', '350.00', 'image/photo-article/e-bm-8.jpeg'),
(12, 'Blacky', 'Métal noir', '159.00', 'image/photo-article/e-m-3.jpeg'),
(13, 'S Z S', 'Chemin de métal', '650.00', 'image/photo-article/e-m-4.jpeg'),
(14, 'Black Mondrian', 'Les forme de Mondrian sans les couleurs', '790.00', 'image/photo-article/e-m-6.jpeg'),
(15, 'Rondin', 'Table basse\r\n<br>Trois pieds\r\n<br> un rondin de bois brut', '125.00', 'image/photo-article/tb-b-6.jpeg'),
(16, 'APLAT', 'Plateau de bois\r\n<br>Pieds rectangles', '350.00', 'image/photo-article/tb-bm-1.jpeg'),
(17, 'BRUT de BRUT', 'Un beau plateau cerclé de métal', '560.00', 'image/photo-article/tb-bm-7.jpeg');

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Bois'),
(4, 'Bureau'),
(5, 'Etagère'),
(2, 'Métal'),
(3, 'Table basse');

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `username`, `total`, `payment_date`) VALUES
(1, 'taminh', '400.00', '2019-01-13 20:39:17');

--
-- Déchargement des données de la table `link`
--

INSERT INTO `link` (`id`, `article_id`, `quantity`, `category_id`) VALUES
(1, 1, 0, 1),
(2, 1, 0, 2),
(3, 1, 0, 3),
(4, 2, 0, 1),
(5, 2, 0, 4),
(6, 3, 0, 1),
(7, 3, 0, 5),
(8, 4, 0, 1),
(9, 4, 0, 4),
(10, 5, 0, 1),
(11, 5, 0, 4),
(12, 7, 0, 4),
(13, 7, 0, 2),
(14, 8, 0, 4),
(15, 8, 0, 2),
(16, 9, 0, 1),
(17, 9, 0, 5),
(18, 10, 0, 1),
(19, 10, 0, 5),
(20, 11, 0, 1),
(21, 11, 0, 5),
(22, 11, 0, 2),
(23, 12, 0, 5),
(24, 12, 0, 2),
(25, 13, 0, 5),
(26, 13, 0, 2),
(27, 14, 0, 5),
(28, 14, 0, 2),
(29, 15, 0, 1),
(30, 15, 0, 3),
(31, 16, 0, 1),
(32, 16, 0, 2),
(33, 16, 0, 3),
(34, 17, 0, 1),
(35, 17, 0, 2),
(36, 17, 0, 3);

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `permission`, `creation_date`) VALUES
(1, 'admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 1, '2019-01-13 18:49:29'),
(2, 'taminh', '31d76f669c199f0fc304947b9670676a8caf9ecf92f4f4a33b8794ae12640b8d58e801a9cc7894634ba17cbea901154867b3350b429992d27671f100a684e3d2', 0, '2019-01-13 18:49:36');
