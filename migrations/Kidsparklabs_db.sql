-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+jammy2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 03 juin 2024 à 11:26
-- Version du serveur : 8.0.36-0ubuntu0.22.04.1
-- Version de PHP : 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Kidsparklabs_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `consulter`
--

CREATE TABLE `consulter` (
  `id` int NOT NULL,
  `date_consulter` date NOT NULL,
  `eleve_id` int NOT NULL,
  `projet_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `consulter`
--

INSERT INTO `consulter` (`id`, `date_consulter`, `eleve_id`, `projet_id`) VALUES
(1, '2024-06-04', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `creer`
--

CREATE TABLE `creer` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_creation` date NOT NULL,
  `quiz_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `creer`
--

INSERT INTO `creer` (`id`, `user_id`, `date_creation`, `quiz_id`) VALUES
(1, 1, '2024-06-02', 4),
(3, 1, '2024-06-03', 5);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240531123949', '2024-06-02 21:58:08', 4116),
('DoctrineMigrations\\Version20240531123950', '2024-06-02 21:58:13', 30857),
('DoctrineMigrations\\Version20240531172211', '2024-06-02 21:58:44', 3096),
('DoctrineMigrations\\Version20240531174859', '2024-06-02 21:58:47', 912),
('DoctrineMigrations\\Version20240531175817', '2024-06-02 21:58:48', 3057),
('DoctrineMigrations\\Version20240531200020', '2024-06-02 21:58:51', 496),
('DoctrineMigrations\\Version20240602190821', '2024-06-02 21:58:52', 1604),
('DoctrineMigrations\\Version20240602201722', '2024-06-02 21:58:53', 3704),
('DoctrineMigrations\\Version20240602203025', '2024-06-02 21:58:57', 1102),
('DoctrineMigrations\\Version20240602203228', '2024-06-02 21:58:58', 2912),
('DoctrineMigrations\\Version20240602203918', '2024-06-02 21:59:02', 2970),
('DoctrineMigrations\\Version20240602214426', '2024-06-02 21:59:05', 1540),
('DoctrineMigrations\\Version20240602215657', '2024-06-02 21:59:06', 20641),
('DoctrineMigrations\\Version20240602222320', '2024-06-02 22:23:27', 1915);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `pseudo`, `date_naissance`, `sexe`, `password`, `image`) VALUES
(1, 'JOHNSON', 'Clayton', '@yton003', '2003-02-12', 'M', '$2b$10$C1m7I/rJQp2J6toN6suDxOTWNLfp46aMe5li7Qw.158SftNteVCVi', NULL),
(2, 'JOHNSON', 'Clayton', '@yton003', '2003-02-12', 'M', '$2b$10$0zdmpQZx4I/fMha85sCFuuJxdvCbM2cK276Xj05aJQ7LfMGbHL.mu', NULL),
(3, 'OGOUNDELE', 'Tobi', '@tobi17', '2017-04-28', 'M', '$2b$10$ak2VF2ZWxP0pQgzt6fFvtez7QMPmO4Hi8w403hjvAOReyA5wRRoTu', NULL),
(4, 'kkk', 'jjn', '@eleve', '2024-06-01', 'M', '$2b$10$Lmynyu4VdFAfB/U9mB2Axu.wV1oJuS.wnnBd9OPeDXWOLpsi5loeC', NULL),
(5, 'fff', 'fff', '@eleve1', '2024-06-01', 'M', '$2b$10$Xcl2CobHoqDwEdeqsaIZDOpqtvW8F4OVwFDL7tpMLnjzgSNyMKeXG', NULL),
(6, 'fff', 'ccc', '@eleve2', '2024-06-01', 'M', '$2b$10$Thp0t4h5hXvKr8qBpIdzJ.H1QdhBM3WLdBZwbnz4BACeQuyZ6622q', NULL),
(7, 'sdsd', 'dsd', '@eleve3', '2024-06-01', 'M', '$2b$10$nyV5faLOT2C10h8Wdvw8z.tReYduXB3yxkvXevYizytsQNV0e3gMu', NULL),
(8, 'jjk', 'joke', '@jjkjoke1', '2024-06-01', 'M', '$2b$10$CAG2ELd5wjxbNCzsLyzHnOcQ5DGb8tV0XNeAs010iqVCaDlCegmj2', NULL),
(9, 'isac', 'jovi', '@isac1', '2024-06-03', 'M', '$2b$10$wNaM7zzjQ/4MMhdg9AgX5uG3umLHislQNPS0NUG6EV/dNz6gKfB2y', NULL),
(10, 'jacob', 'oke', '@jacob1', '2024-06-29', 'M', '$2b$10$vfusv41znJN6ULGQwuTtX..wNm4s3w0tA6Qc4j3Nagw4/0tVEJ94S', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ajout` date NOT NULL,
  `projet_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `nom`, `image`, `description`, `date_ajout`, `projet_id`) VALUES
(2, 'voiture', '70fbff47-200d-4777-a00a-f8f539c8e197-665b24b868922.jpg', 'ggdhtnnnt', '2024-06-01', 1),
(3, 'Ardino', 'a10dbcea-9a35-49d7-b95e-cc8367a4e5d4-665b4775256a4.jpg', 'acvsdvvdbgnfmgm', '2024-06-01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `jouer`
--

CREATE TABLE `jouer` (
  `id` int NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_jeu` date NOT NULL,
  `quiz_id` int NOT NULL,
  `eleve_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jouer`
--

INSERT INTO `jouer` (`id`, `score`, `date_jeu`, `quiz_id`, `eleve_id`) VALUES
(1, '2/4', '2024-06-02', 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tutoriel_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `description`, `date_creation`, `image`, `tutoriel_id`) VALUES
(1, 'balancoire', 'construction', '2024-06-02', 'Tesla-Model-3-Model-Y-upgrades-2022-4-665ceed26f61a.jpg', 6),
(8, 'lancement', 'avi', '2024-06-03', '800-L-quelle-version-du-tesla-model-y-choisir-en-2022-665d432e7a7f3.jpg', 5),
(9, 'yafoor', 'oke', '2024-06-22', 'model3-configurateur-510km-665d58146d39a.jpg', 3),
(10, 'fusee', 'oki', '2024-06-28', 'Screenshot-from-2022-07-25-09-06-00-665d6320e59af.png', 7);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `questionnaire` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `questionnaire`) VALUES
(3, 4, 'Quelle est la masse molaire de l\'eau ?');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `libelle`) VALUES
(4, 'Quiz sur la physique'),
(5, 'geneaologie');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_correcte` tinyint(1) NOT NULL,
  `question_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `contenu`, `est_correcte`, `question_id`) VALUES
(1, '18 g/mol', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tutoriel`
--

CREATE TABLE `tutoriel` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ajout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tutoriel`
--

INSERT INTO `tutoriel` (`id`, `titre`, `description`, `video`, `date_ajout`) VALUES
(3, 'Aspirateur electronique', 'Les', 'Video-Not-Available-665b24564ddd4.mp4', '2024-06-01'),
(5, 'Allumage leb', 'allume seuelement', 'Zustand-La-MEILLEUR-librairie-de-state-Management-en-React-665c22cdd88be.mp4', '2024-06-02'),
(6, 'Allumage leb', 'allume seuelement', 'Developpement-mobile-avec-Flutter-part03-VS-CODE-665c2827af69c.mp4', '2024-06-02'),
(7, 'oke', 'ooo', 'Next-js-Typescript-HTTP-only-Cookie-Strapi-v4-JWT-Authentication-Login-Logout-665d62d40a130.mp4', '2024-06-16');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, 'admin@gmail.com', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '$2y$13$24q2t1vzO3BBY6d8DPQ4Jux6UiSs3BUVVPObP6fjWmioO5pLz.aCe', 'D\'ALMEIDA', 'Kenneth');

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

CREATE TABLE `utiliser` (
  `id` int NOT NULL,
  `projet_id` int NOT NULL,
  `eleve_id` int NOT NULL,
  `date_utiliser` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utiliser`
--

INSERT INTO `utiliser` (`id`, `projet_id`, `eleve_id`, `date_utiliser`) VALUES
(1, 1, 1, '2024-06-03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `consulter`
--
ALTER TABLE `consulter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_69A83B75A6CC7B2` (`eleve_id`),
  ADD KEY `IDX_69A83B75C18272` (`projet_id`);

--
-- Index pour la table `creer`
--
ALTER TABLE `creer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_311B14AEA76ED395` (`user_id`),
  ADD KEY `IDX_311B14AE853CD175` (`quiz_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B8B4C6F3C18272` (`projet_id`);

--
-- Index pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_825E5AED853CD175` (`quiz_id`),
  ADD KEY `IDX_825E5AEDA6CC7B2` (`eleve_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_50159CA97CB6CDBB` (`tutoriel_id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6F7494E853CD175` (`quiz_id`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5FB6DEC71E27F6BF` (`question_id`);

--
-- Index pour la table `tutoriel`
--
ALTER TABLE `tutoriel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C949109C18272` (`projet_id`),
  ADD KEY `IDX_5C949109A6CC7B2` (`eleve_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `consulter`
--
ALTER TABLE `consulter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `creer`
--
ALTER TABLE `creer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jouer`
--
ALTER TABLE `jouer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tutoriel`
--
ALTER TABLE `tutoriel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utiliser`
--
ALTER TABLE `utiliser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consulter`
--
ALTER TABLE `consulter`
  ADD CONSTRAINT `FK_69A83B75A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_69A83B75C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `creer`
--
ALTER TABLE `creer`
  ADD CONSTRAINT `FK_311B14AE853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `FK_311B14AEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `FK_B8B4C6F3C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD CONSTRAINT `FK_825E5AED853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `FK_825E5AEDA6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `FK_50159CA97CB6CDBB` FOREIGN KEY (`tutoriel_id`) REFERENCES `tutoriel` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC71E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD CONSTRAINT `FK_5C949109A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_5C949109C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
