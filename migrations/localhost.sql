-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 01 juin 2024 à 16:15
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
-- Base de données : `bdcan`
--
CREATE DATABASE IF NOT EXISTS `bdcan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bdcan`;

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `idequipe` int NOT NULL,
  `nomequipe` varchar(50) NOT NULL,
  `photodrapeau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Equipe`
--

INSERT INTO `Equipe` (`idequipe`, `nomequipe`, `photodrapeau`) VALUES
(1, 'Benin', '/home/kenneth/Images/Benin.png'),
(2, 'Benin', 'uploads/phpZDdAzN');

-- --------------------------------------------------------

--
-- Structure de la table `Matchs`
--

CREATE TABLE `Matchs` (
  `idmatch` int NOT NULL,
  `idequipe1` varchar(50) NOT NULL,
  `idequipe2` varchar(50) NOT NULL,
  `datematch` date NOT NULL,
  `score` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Matchs`
--

INSERT INTO `Matchs` (`idmatch`, `idequipe1`, `idequipe2`, `datematch`, `score`) VALUES
(1, 'cote d\'ivoire', 'Ghana', '2024-01-20', '2-1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`idequipe`);

--
-- Index pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`idmatch`),
  ADD UNIQUE KEY `idequipe1` (`idequipe1`),
  ADD UNIQUE KEY `idequipe2` (`idequipe2`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `idequipe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `idmatch` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Base de données : `bdcan2`
--
CREATE DATABASE IF NOT EXISTS `bdcan2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bdcan2`;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idequipe` int NOT NULL COMMENT 'Primary Key',
  `nomequipe` varchar(255) NOT NULL,
  `photodrapeau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idequipe`, `nomequipe`, `photodrapeau`) VALUES
(1, 'Sénégal', 'image_11042024080016.png'),
(2, 'Benin', 'image_11042024080431.png'),
(4, 'Cote d\'ivoire', 'image_11042024085211.png');

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `idmatch` int NOT NULL,
  `idequipe1` int NOT NULL,
  `idequipe2` int NOT NULL,
  `datematch` date NOT NULL,
  `score` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`idmatch`, `idequipe1`, `idequipe2`, `datematch`, `score`) VALUES
(2, 4, 1, '2024-04-10', '5-2'),
(6, 2, 4, '2024-04-11', '8-2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`idequipe`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`idmatch`),
  ADD KEY `fk_matchs_equipe_idequipe1` (`idequipe1`),
  ADD KEY `fk_matchs_equipe_idequipe2` (`idequipe2`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `idmatch` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `fk_matchs_equipe_idequipe1` FOREIGN KEY (`idequipe1`) REFERENCES `equipe` (`idequipe`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_matchs_equipe_idequipe2` FOREIGN KEY (`idequipe2`) REFERENCES `equipe` (`idequipe`) ON DELETE CASCADE;
--
-- Base de données : `bdFilm`
--
CREATE DATABASE IF NOT EXISTS `bdFilm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bdFilm`;

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `id` int NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `codefil` int NOT NULL,
  `titre` varchar(30) NOT NULL,
  `annee` int NOT NULL,
  `genre` varchar(4) NOT NULL,
  `resume` text NOT NULL,
  `code` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `internaute`
--

CREATE TABLE `internaute` (
  `id_In` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Pays`
--

CREATE TABLE `Pays` (
  `code` int NOT NULL,
  `nom` varchar(30) NOT NULL,
  `langue` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realiser`
--

CREATE TABLE `realiser` (
  `id` int NOT NULL,
  `codefil` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

CREATE TABLE `suivre` (
  `codefil` int NOT NULL,
  `id_In` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`codefil`),
  ADD UNIQUE KEY `codefil` (`codefil`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `internaute`
--
ALTER TABLE `internaute`
  ADD PRIMARY KEY (`id_In`);

--
-- Index pour la table `Pays`
--
ALTER TABLE `Pays`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD PRIMARY KEY (`id`,`codefil`),
  ADD UNIQUE KEY `id` (`id`,`codefil`),
  ADD UNIQUE KEY `codefil` (`codefil`);

--
-- Index pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD PRIMARY KEY (`id_In`,`codefil`),
  ADD UNIQUE KEY `codefil` (`codefil`,`id_In`),
  ADD UNIQUE KEY `id_In` (`id_In`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artiste`
--
ALTER TABLE `artiste`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `codefil` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `internaute`
--
ALTER TABLE `internaute`
  MODIFY `id_In` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Pays`
--
ALTER TABLE `Pays`
  MODIFY `code` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realiser`
--
ALTER TABLE `realiser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD CONSTRAINT `artiste_ibfk_1` FOREIGN KEY (`id`) REFERENCES `film` (`codefil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Pays`
--
ALTER TABLE `Pays`
  ADD CONSTRAINT `Pays_ibfk_1` FOREIGN KEY (`code`) REFERENCES `film` (`codefil`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Base de données : `crudSym_app`
--
CREATE DATABASE IF NOT EXISTS `crudSym_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `crudSym_app`;
--
-- Base de données : `db_crud`
--
CREATE DATABASE IF NOT EXISTS `db_crud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_crud`;

-- --------------------------------------------------------

--
-- Structure de la table `exemple`
--

CREATE TABLE `exemple` (
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exemple`
--
ALTER TABLE `exemple`
  ADD PRIMARY KEY (`email`);
--
-- Base de données : `db_orchestre`
--
CREATE DATABASE IF NOT EXISTS `db_orchestre` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_orchestre`;

-- --------------------------------------------------------

--
-- Structure de la table `concert`
--

CREATE TABLE `concert` (
  `id_concert` int NOT NULL COMMENT 'Primary Key',
  `titre` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `annee` year NOT NULL,
  `evaluation` varchar(50) NOT NULL,
  `id_orchestre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `concert`
--

INSERT INTO `concert` (`id_concert`, `titre`, `type`, `pays`, `annee`, `evaluation`, `id_orchestre`) VALUES
(2, 'Concert C', 'Pop', 'Royaume-Uni', 2023, '2.7            ', 3),
(3, 'Concert B', 'Jazz', 'Allemagne', 2023, '9.0', 2);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int NOT NULL COMMENT 'Primary Key',
  `nom` varchar(255) NOT NULL,
  `poste` varchar(100) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `id_orchestre` int NOT NULL,
  `salaire` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `nom`, `poste`, `experience`, `id_orchestre`, `salaire`) VALUES
(1, 'John Doe', 'Violoniste', '10 ans', 1, 3000),
(2, 'Alice Smith', 'Trompettiste', '8 ans', 2, 2800),
(3, 'Emma Jonhson', 'Altiste', '5 ans', 1, 3200),
(4, 'Peter Brown', 'Percussionniste', '6 ans', 3, 2900);

-- --------------------------------------------------------

--
-- Structure de la table `orchestres`
--

CREATE TABLE `orchestres` (
  `id_orchestre` int NOT NULL COMMENT 'Primary Key',
  `nom` varchar(255) NOT NULL,
  `evaluation` varchar(50) NOT NULL,
  `ville_origine` varchar(50) NOT NULL,
  `pays_origine` varchar(100) NOT NULL,
  `annee` year NOT NULL,
  `membres` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `orchestres`
--

INSERT INTO `orchestres` (`id_orchestre`, `nom`, `evaluation`, `ville_origine`, `pays_origine`, `annee`, `membres`) VALUES
(1, 'Orchestre A', '8.5', 'Paris', 'France', 2000, 50),
(2, 'Orchestre B', '9.2', 'Berlin', 'Allemangne', 1995, 60),
(3, 'Orchestre C', '7.9', 'Londres', 'Royaume-Uni', 2005, 45);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id_concert`),
  ADD KEY `fk_orchestres_concert_id_orchestre` (`id_orchestre`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`),
  ADD KEY `fk_orchestres_membres_id_orchestre` (`id_orchestre`);

--
-- Index pour la table `orchestres`
--
ALTER TABLE `orchestres`
  ADD PRIMARY KEY (`id_orchestre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `concert`
--
ALTER TABLE `concert`
  MODIFY `id_concert` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id_membre` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `orchestres`
--
ALTER TABLE `orchestres`
  MODIFY `id_orchestre` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `fk_orchestres_concert_id_orchestre` FOREIGN KEY (`id_orchestre`) REFERENCES `orchestres` (`id_orchestre`);

--
-- Contraintes pour la table `membres`
--
ALTER TABLE `membres`
  ADD CONSTRAINT `fk_orchestres_membres_id_orchestre` FOREIGN KEY (`id_orchestre`) REFERENCES `orchestres` (`id_orchestre`);
--
-- Base de données : `examen`
--
CREATE DATABASE IF NOT EXISTS `examen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `examen`;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id_cand` int NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `datnais` date NOT NULL,
  `ville` varchar(25) NOT NULL,
  `sexe` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `codfil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id_cand`, `nom`, `prenom`, `datnais`, `ville`, `sexe`, `codfil`) VALUES
(1, 'ADIMI', 'Jean', '1997-08-10', 'Cotonou', 'M', 'SIL'),
(2, 'SOGLO', 'Bernard', '1994-09-12', 'Porto-Novo', 'M', 'RIT'),
(3, 'DOSSOU', 'Brice', '1994-09-12', 'Cotonou', 'M', 'AGRO'),
(4, 'CHABI SIKA', 'Eric', '1993-11-25', 'Parakou', 'M', 'SIL'),
(5, 'DOSSOU', 'Chantal', '1994-02-18', 'Abomey', 'F', 'SIL'),
(6, 'ZINSOU', 'Jules', '1996-08-21', 'Ouidah', 'M', 'SIL'),
(7, 'ALAO', 'Mariam', '1996-04-30', 'Porto-Novo', 'F', 'AGE'),
(8, 'CHABI SIKA', 'Juliette', '1996-05-10', 'Bohicon', 'F', 'SIL'),
(12, 'D&#039;ALMEIDA', 'kenneth', '2000-02-25', 'Abomey-Calavi', 'Masculin', 'SIL'),
(13, 'D&#039;ALMEIDA', 'kenneth', '2000-02-25', 'Abomey-Calavi', 'Masculin', 'SIL'),
(14, 'Assogba', 'Felicia', '2024-04-08', 'Abomey-Calavi', 'Feminin', 'AGRO');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `codfil` varchar(100) NOT NULL,
  `nomfil` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`codfil`, `nomfil`) VALUES
('AGE', 'Administration de gestion des entreprises'),
('AGRO', 'Agronomie'),
('RIT', 'Reseaux Informatiques et Telecomminications'),
('SIL', 'Systemes Informatiques et Logicies');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id_cand`),
  ADD KEY `fk_id_cand_filiere_codfil` (`codfil`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`codfil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id_cand` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `fk_id_cand_filiere_codfil` FOREIGN KEY (`codfil`) REFERENCES `filiere` (`codfil`);
--
-- Base de données : `gestion_football`
--
CREATE DATABASE IF NOT EXISTS `gestion_football` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `gestion_football`;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `id_Club` int NOT NULL,
  `nom_Club` varchar(50) NOT NULL,
  `id_Commune` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id_Club`, `nom_Club`, `id_Commune`) VALUES
(1, 'Barcelone', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `id_Commune` int NOT NULL,
  `lib_Commune` varchar(100) NOT NULL,
  `id_departement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`id_Commune`, `lib_Commune`, `id_departement`) VALUES
(1, 'joie', 1);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_departement` int NOT NULL,
  `lib_departement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_departement`, `lib_departement`) VALUES
(1, 'Oueme'),
(2, 'Altantique'),
(3, 'Littoral');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id_Joueur` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_Club` int NOT NULL,
  `poste` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_Club`),
  ADD KEY `fk_id_Club_commune_id_Commune` (`id_Commune`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id_Commune`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id_Joueur`),
  ADD KEY `fk_id_Joueur_club_id_Club` (`id_Club`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_Club` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commune`
--
ALTER TABLE `commune`
  MODIFY `id_Commune` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_Joueur` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_id_Club_commune_id_Commune` FOREIGN KEY (`id_Commune`) REFERENCES `commune` (`id_Commune`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `fk_id_Joueur_club_id_Club` FOREIGN KEY (`id_Club`) REFERENCES `club` (`id_Club`);
--
-- Base de données : `Gest_Rapido`
--
CREATE DATABASE IF NOT EXISTS `Gest_Rapido` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `Gest_Rapido`;

-- --------------------------------------------------------

--
-- Structure de la table `chauffeurs`
--

CREATE TABLE `chauffeurs` (
  `chauffeur_id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `disponible` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chauffeurs`
--

INSERT INTO `chauffeurs` (`chauffeur_id`, `nom`, `prenoms`, `telephone`, `sexe`, `disponible`) VALUES
(1, 'D\'ALMEIDA', 'kenneth', '53733705', 'Masculin', 'OUI'),
(2, 'AGUEH', 'Micheline', '94561738', 'Feminin', 'NON');

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `course_id` int NOT NULL,
  `point_depart` varchar(255) NOT NULL,
  `point_arrivee` varchar(255) NOT NULL,
  `date_heure` datetime NOT NULL,
  `chauffeur_id` int NOT NULL,
  `statut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`course_id`, `point_depart`, `point_arrivee`, `date_heure`, `chauffeur_id`, `statut`) VALUES
(3, 'Dantokpa', 'Calavi', '2024-04-18 10:10:00', 2, 'En cours'),
(4, 'cotonou', 'godomey', '2024-04-04 15:00:00', 2, '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  ADD PRIMARY KEY (`chauffeur_id`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_course_id_chauffeurs_chauffeur_id` (`chauffeur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  MODIFY `chauffeur_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_course_id_chauffeurs_chauffeur_id` FOREIGN KEY (`chauffeur_id`) REFERENCES `chauffeurs` (`chauffeur_id`);
--
-- Base de données : `kennerie2528`
--
CREATE DATABASE IF NOT EXISTS `kennerie2528` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `kennerie2528`;

-- --------------------------------------------------------

--
-- Structure de la table `exemple`
--

CREATE TABLE `exemple` (
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `exemple`
--

INSERT INTO `exemple` (`email`, `pwd`, `pic`) VALUES
('example@gmail.com', 'gmailpassword', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exemple`
--
ALTER TABLE `exemple`
  ADD PRIMARY KEY (`email`);
--
-- Base de données : `Kidsparklabs_db`
--
CREATE DATABASE IF NOT EXISTS `Kidsparklabs_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `Kidsparklabs_db`;

-- --------------------------------------------------------

--
-- Structure de la table `consulter`
--

CREATE TABLE `consulter` (
  `id` int NOT NULL,
  `id_eleve_id` int NOT NULL,
  `id_projet_id` int NOT NULL,
  `date_consulter` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creer`
--

CREATE TABLE `creer` (
  `id` int NOT NULL,
  `id_user_id` int DEFAULT NULL,
  `id_quiz_id` int NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('DoctrineMigrations\\Version20240531123949', '2024-05-31 17:24:18', 5081),
('DoctrineMigrations\\Version20240531123950', '2024-05-31 17:24:23', 37249),
('DoctrineMigrations\\Version20240531172211', '2024-05-31 17:25:01', 6479),
('DoctrineMigrations\\Version20240531174859', '2024-05-31 17:49:13', 2100),
('DoctrineMigrations\\Version20240531175817', '2024-05-31 17:58:27', 4203),
('DoctrineMigrations\\Version20240531200020', '2024-05-31 20:00:33', 3307);

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
(8, 'jjk', 'joke', '@jjkjoke1', '2024-06-01', 'M', '$2b$10$CAG2ELd5wjxbNCzsLyzHnOcQ5DGb8tV0XNeAs010iqVCaDlCegmj2', NULL);

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
(2, 'voiture', '70fbff47-200d-4777-a00a-f8f539c8e197-665b24b868922.jpg', 'ggdhtnnnt', '2024-06-01', 3),
(3, 'Ardino', 'a10dbcea-9a35-49d7-b95e-cc8367a4e5d4-665b4775256a4.jpg', 'acvsdvvdbgnfmgm', '2024-06-01', 3);

-- --------------------------------------------------------

--
-- Structure de la table `jouer`
--

CREATE TABLE `jouer` (
  `id` int NOT NULL,
  `id_eleve_id` int NOT NULL,
  `id_quiz_id` int NOT NULL,
  `score` int NOT NULL,
  `date_jeu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_tutoriel_id` int NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `description`, `date_creation`, `id_tutoriel_id`, `image`) VALUES
(3, 'Classe', 'afafs', '2024-06-01', 3, 'cbbcec95-ce84-444e-b0a3-80e13fb086f3-665b2491867ee.jpg'),
(10, 'Maison', 'dsbsb', '2024-06-01', 4, 'WhatsApp-Image-2024-05-05-at-08-26-18-665b46ebcc00f.jpg');

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
(4, 'Quiz sur la physique');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int NOT NULL,
  `id_question_id` int NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_correcte` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `id_question_id`, `contenu`, `est_correcte`) VALUES
(1, 3, '18 g/mol', 1);

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
(4, 'DIODE', 'vdsbfbs', 'Video-Not-Available-665b46ce3b632.mp4', '2024-06-01');

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
(1, 'admin@gmail.com', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '$2y$13$QQTXAvqzY39K426U86QOGuxvdu7A3z4Tafl1esnAhMeugsH8uF/OO', 'D\'ALMEIDA', 'Kenneth');

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
-- Index pour les tables déchargées
--

--
-- Index pour la table `consulter`
--
ALTER TABLE `consulter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_69A83B755AB72B27` (`id_eleve_id`),
  ADD KEY `IDX_69A83B7580F43E55` (`id_projet_id`);

--
-- Index pour la table `creer`
--
ALTER TABLE `creer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_311B14AE79F37AE5` (`id_user_id`),
  ADD KEY `IDX_311B14AE5BA17805` (`id_quiz_id`);

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
  ADD KEY `IDX_825E5AED5AB72B27` (`id_eleve_id`),
  ADD KEY `IDX_825E5AED5BA17805` (`id_quiz_id`);

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
  ADD UNIQUE KEY `UNIQ_50159CA964A4004C` (`id_tutoriel_id`);

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
  ADD KEY `IDX_5FB6DEC76353B48` (`id_question_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `creer`
--
ALTER TABLE `creer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jouer`
--
ALTER TABLE `jouer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tutoriel`
--
ALTER TABLE `tutoriel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utiliser`
--
ALTER TABLE `utiliser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consulter`
--
ALTER TABLE `consulter`
  ADD CONSTRAINT `FK_69A83B755AB72B27` FOREIGN KEY (`id_eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_69A83B7580F43E55` FOREIGN KEY (`id_projet_id`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `creer`
--
ALTER TABLE `creer`
  ADD CONSTRAINT `FK_311B14AE5BA17805` FOREIGN KEY (`id_quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `FK_311B14AE79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `FK_B8B4C6F3C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD CONSTRAINT `FK_825E5AED5AB72B27` FOREIGN KEY (`id_eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_825E5AED5BA17805` FOREIGN KEY (`id_quiz_id`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `FK_50159CA964A4004C` FOREIGN KEY (`id_tutoriel_id`) REFERENCES `tutoriel` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC76353B48` FOREIGN KEY (`id_question_id`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD CONSTRAINT `FK_5C949109A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_5C949109C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`);
--
-- Base de données : `marchesBenin`
--
CREATE DATABASE IF NOT EXISTS `marchesBenin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `marchesBenin`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(3, 'carlos');

-- --------------------------------------------------------

--
-- Structure de la table `Emplacement`
--

CREATE TABLE `Emplacement` (
  `idEmplacement` int NOT NULL,
  `numero` varchar(30) NOT NULL,
  `idType` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Emplacement`
--

INSERT INTO `Emplacement` (`idEmplacement`, `numero`, `idType`) VALUES
(1, 'Numéro 1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Marche`
--

CREATE TABLE `Marche` (
  `idMarche` int NOT NULL,
  `nomMarche` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `capacite` int NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `idVille` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `codeProd` varchar(20) NOT NULL,
  `libeProd` varchar(60) NOT NULL,
  `descript` varchar(255) NOT NULL,
  `quantite` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TypeofEmplacement`
--

CREATE TABLE `TypeofEmplacement` (
  `idType` int NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `TypeofEmplacement`
--

INSERT INTO `TypeofEmplacement` (`idType`, `libelle`) VALUES
(1, 'Type 1');

-- --------------------------------------------------------

--
-- Structure de la table `Ville`
--

CREATE TABLE `Ville` (
  `idVille` int NOT NULL,
  `nomVille` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Ville`
--

INSERT INTO `Ville` (`idVille`, `nomVille`) VALUES
(1, 'Cotonou'),
(2, 'Porto-Novo');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
  ADD PRIMARY KEY (`idEmplacement`),
  ADD KEY `fk_Emplacement_TypeofEmplacement_idType` (`idType`);

--
-- Index pour la table `Marche`
--
ALTER TABLE `Marche`
  ADD PRIMARY KEY (`idMarche`),
  ADD KEY `fk_Ville_Marche` (`idVille`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`codeProd`),
  ADD KEY `fk_produit_categorie_id` (`id`);

--
-- Index pour la table `TypeofEmplacement`
--
ALTER TABLE `TypeofEmplacement`
  ADD PRIMARY KEY (`idType`);

--
-- Index pour la table `Ville`
--
ALTER TABLE `Ville`
  ADD PRIMARY KEY (`idVille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Marche`
--
ALTER TABLE `Marche`
  MODIFY `idMarche` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
  ADD CONSTRAINT `fk_Emplacement_TypeofEmplacement_idType` FOREIGN KEY (`idType`) REFERENCES `TypeofEmplacement` (`idType`);

--
-- Contraintes pour la table `Marche`
--
ALTER TABLE `Marche`
  ADD CONSTRAINT `fk_Ville_Marche` FOREIGN KEY (`idVille`) REFERENCES `Ville` (`idVille`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_produit_categorie_id` FOREIGN KEY (`id`) REFERENCES `categorie` (`id`);
--
-- Base de données : `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Structure de la table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `query` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Structure de la table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_length` text COLLATE utf8mb3_bin,
  `col_collation` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8mb3_bin DEFAULT '',
  `col_default` text COLLATE utf8mb3_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Structure de la table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8mb3_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `settings_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Settings related to Designer';

--
-- Déchargement des données de la table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('kenneth', '{\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\",\"relation_lines\":\"true\",\"full_screen\":\"off\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8mb3_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `template_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Structure de la table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `tables` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Structure de la table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Structure de la table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `page_nr` int UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `tables` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Recently accessed tables';

--
-- Déchargement des données de la table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('kenneth', '[{\"db\":\"Kidsparklabs_db\",\"table\":\"question\"},{\"db\":\"Kidsparklabs_db\",\"table\":\"quiz\"},{\"db\":\"Kidsparklabs_db\",\"table\":\"equipement\"},{\"db\":\"Kidsparklabs_db\",\"table\":\"projet\"},{\"db\":\"Kidsparklabs_db\",\"table\":\"tutoriel\"},{\"db\":\"Kidsparklabs_db\",\"table\":\"user\"},{\"db\":\"kidsparklabs_db\",\"table\":\"eleve\"},{\"db\":\"kidsparklabs_db\",\"table\":\"projet\"},{\"db\":\"kidsparklabs_db\",\"table\":\"equipement\"},{\"db\":\"kidsparklabs_db\",\"table\":\"question\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Structure de la table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `pdf_page_number` int NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8mb3_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `prefs` text COLLATE utf8mb3_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Structure de la table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `version` int UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8mb3_bin NOT NULL,
  `schema_sql` text COLLATE utf8mb3_bin,
  `data_sql` longtext COLLATE utf8mb3_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8mb3_bin DEFAULT NULL,
  `tracking_active` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Déchargement des données de la table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('kenneth', '2024-06-01 16:15:25', '{\"lang\":\"fr\",\"Console\\/Mode\":\"show\",\"NavigationWidth\":253,\"Console\\/Height\":46.002329999999986}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8mb3_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Structure de la table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8mb3_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Users and their assignments to user groups';

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Index pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Index pour la table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Index pour la table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Index pour la table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Index pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Index pour la table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Index pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Index pour la table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Index pour la table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Index pour la table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Index pour la table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Index pour la table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Index pour la table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
