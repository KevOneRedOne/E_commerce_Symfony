-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 mai 2022 à 15:54
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e_commerce_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(16, 'Bijoux'),
(17, 'Chaussures'),
(18, 'Technologie'),
(19, 'Accessoires'),
(20, 'Parfum');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdat` datetime NOT NULL,
  `user_id_id` int(11) NOT NULL,
  `product_id_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `createdat`, `user_id_id`, `product_id_id`) VALUES
(1, 'Il est beau le BB', '2022-05-12 23:10:15', 24, 114),
(2, 'Test', '2022-05-12 23:36:04', 24, 114),
(3, 'Produit de qualité', '2022-05-13 09:33:54', 27, 118);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `email`, `content`, `createdat`) VALUES
(1, 'coucou', 'coucou', 'cou@cou.fr', 'izoebzefnznehzjbfpz', '2022-05-10 10:01:38'),
(2, 'dzedz', 'zejkjdnzjkend', 'test@test.fr', 'jzedoijedjjjjjjjjjjjjjjjjjjj\r\nezoednozjned\r\nzoendoze,dokz,ednzendojznedojnzddzd', '2022-05-10 11:55:35'),
(3, 'coucou', 'couco', 'coucoucoucou@gamil.com', 'test de message', '2022-05-13 09:18:44'),
(4, 'test', 'Test', 'coucou@coucou.com', 'ceci est un test', '2022-05-13 09:30:51');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220428102711', '2022-04-28 12:27:58', 61),
('DoctrineMigrations\\Version20220502214139', '2022-05-02 23:42:33', 286),
('DoctrineMigrations\\Version20220506141119', '2022-05-06 16:11:37', 58),
('DoctrineMigrations\\Version20220510214616', '2022-05-11 10:49:20', 41);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id_id` int(11) NOT NULL,
  `user_id_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id_id`, `user_id_id`, `updated_at`) VALUES
(103, 'Montre en acier', 'Jolie montre en acier inoxydable', 35, '627b9961c21e5893225890.jpg', 16, 24, '2022-05-11 13:09:21'),
(104, 'Montre classique', 'Montre en acier et or', 250, '627b99aa237e7820044552.jpg', 16, 24, '2022-05-11 13:10:34'),
(105, 'Sac à main vert', 'Jolie sac-à-main élégant, couleur jade sombre', 1000, '627b99facb5c4773982945.jpg', 19, 24, '2022-05-11 13:11:00'),
(106, 'Nike Air Rouge', 'Paire de Nike Air Taille 45', 120, '627b9a32009b1424385065.jpg', 17, 24, '2022-05-11 13:12:49'),
(107, 'Nike Air Jordan - Edition Limité', 'Nike Air Jordan - Edition Limité\r\nCouleur Blanc et or', 250, '627b9aa7182bd006046113.jpg', 17, 24, '2022-05-11 13:14:47'),
(108, 'Chaussures en croco', 'Chaussures en peau de crocodile - Dispo en bleu, gris et rouge - taille 43', 200, '627b9b0495160309965530.jpg', 17, 24, '2022-05-11 13:16:20'),
(109, 'MacBook Pro 14\" - Apple', 'MacBook Pro 14\" 512go - M1 - 16GO de RAM', 1300, '627b9b6744589420209993.jpg', 18, 24, '2022-05-11 13:17:59'),
(110, 'Bundle Apple - MacBook + IPad + IPhone', 'MacBook Pro 14\" 512GO + IPad Pro 256GO + IPhone 7 256GO', 2500, '627b9bde7d9b4684261355.jpg', 18, 24, '2022-05-11 13:19:58'),
(111, 'Appareil Photo - FujiFilm', 'Appareil Photo - FujiFilm \r\nPhoto de qualité + carte SD fournis', 150, '627b9c1f62ba3405949578.jpg', 18, 24, '2022-05-11 13:21:03'),
(113, 'Parfum Femme - Queen', 'Parfum Femme sucré - Odeur digne d\'une reine', 90, '627be3ca8576b750182757.jpg', 20, 26, '2022-05-11 18:26:50'),
(114, 'BlackBerry - Le dernier de l\'entreprise', 'Edition limité ! Il est plus en production dans les usines !', 500, '627bedf8a1eb9092939083.jpg', 18, 26, '2022-05-11 19:10:16'),
(118, 'Macb', 'pc Apple - Derniere gen', 20000, '627e09abc9653902261491.jpg', 18, 22, '2022-05-13 09:32:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `roles`, `lastname`) VALUES
(22, 'coucou@coucou.fr', 'test', '$2y$13$0cFWWY244jX4fUeIxbhFZe3mWQ6Ulmx7dZXKDwyMaT2TD3nKXvVrW', '[]', 'coucou'),
(23, 'test@test.com', 'test', '$2y$13$yD9hZ0dPM/Y6ZES2pCSLKOxIOpOvZBpS2.LwrOcpIh3rkQUUZBvpG', '[\"ROLE_ADMIN\"]', 'test'),
(24, 'admin@admin.com', 'ADMIN', '$2y$13$RVHRAG2duyEtyEjDzc4hgenVAxfEmkL0OsIntYp7.YuSEe.o5jXeu', '[\"ROLE_ADMIN\"]', 'ADM'),
(25, 'admin2@admin.com', 'ADMIN2', '$2y$13$jm6w7AU2v4tBpuZExz.Fc.SVfkoAtuV7ACVeUo4RtkCjmLkycxYcC', '[]', 'ADM'),
(26, 'toto@toto.fr', 'Toto', '$2y$13$IBqDCIj0VQAYKMp7yRXC3ebJH0i1caXCxVy9yZZu4hJssPIOJZyvC', '[]', 'Tata'),
(27, 'kevin@kevin.com', 'kevin', '$2y$13$R1QiA3qjb1ojAeQdEHrmLesB6Mg9h9586l37UImUwPX9xStKaPJvy', '[\"ROLE_ADMIN\"]', 'alves');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F9E962A9D86650F` (`user_id_id`),
  ADD KEY `IDX_5F9E962ADE18E50B` (`product_id_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD9777D11E` (`category_id_id`),
  ADD KEY `IDX_D34A04AD9D86650F` (`user_id_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5F9E962ADE18E50B` FOREIGN KEY (`product_id_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD9777D11E` FOREIGN KEY (`category_id_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D34A04AD9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
