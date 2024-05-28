-- Table Administrateur GERER PAR SYMFONY lors du [ make:user ] et du [ make:auth ] PAR LA TABLE User
CREATE TABLE User (
    id_admin INT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    roles json NOT NULL,
    password VARCHAR(255) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
);
-- Table Administrateur GERER PAR SYMFONY lors du [ make:user ] et du [ make:auth ] PAR LA TABLE User





-- Table Eleve
CREATE TABLE Eleve (
    id_eleve INT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    pseudo VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    sexe CHAR(1) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);

-- Table Equipement
CREATE TABLE Equipement (
    id_equipement INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    date_ajout DATE NOT NULL
);

-- Table Tutoriel
CREATE TABLE Tutoriel (
    id_tutoriel INT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    video VARCHAR(255),
    date_ajout DATE NOT NULL
);

-- Table Quiz
CREATE TABLE Quiz (
    id_quiz INT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);



-- Table Question
CREATE TABLE Question (
    id_question INT PRIMARY KEY,
    questionnaire TEXT NOT NULL,
    id_quiz INT,
    FOREIGN KEY (id_quiz) REFERENCES Quiz(id_quiz)
);



-- Table Projets
CREATE TABLE Projet (
    id_projet INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    date_creation DATE NOT NULL,
    id_tutoriel INT,
    id_equipement INT,
    FOREIGN KEY (id_tutoriel) REFERENCES Tutoriel(id_tutoriel),
    FOREIGN KEY (id_equipement) REFERENCES Equipement(id_equipement)
);


-- Table Consulter
CREATE TABLE Consulter (
    id_eleve INT,
    id_projet INT,
    date_consulter DATE,
    PRIMARY KEY (id_eleve, id_projet),
    FOREIGN KEY (id_eleve) REFERENCES Eleve(id_eleve),
    FOREIGN KEY (id_projet) REFERENCES Projet(id_projet)
);


-- Table Utiliser
CREATE TABLE Utiliser (
    id_projet INT,
    id_eleve INT,
    date_utiliser DATE,
    PRIMARY KEY (id_projet, id_eleve),
    FOREIGN KEY (id_projet) REFERENCES Projet(id_projet),
    FOREIGN KEY (id_eleve) REFERENCES Equipement(id_eleve)
);


-- Table Reponse
CREATE TABLE Reponse (
    id_reponse INT PRIMARY KEY,
    contenu TEXT NOT NULL,
    id_question INT,
    est_correcte BOOLEAN NOT NULL,
    FOREIGN KEY (id_question) REFERENCES Question(id_question)
);

-- Table Creer
CREATE TABLE Creer (
    id_admin INT,
    id_quiz INT,
    date_creation DATE NOT NULL,
    PRIMARY KEY (id_admin, id_quiz),
    FOREIGN KEY (id_admin) REFERENCES Administrateur(id_admin),
    FOREIGN KEY (id_quiz) REFERENCES Quiz(id_quiz)
);

-- Table Jouer
CREATE TABLE Jouer (
    id_eleve INT,
    id_quiz INT,
    score INT,
    date_jeu DATE,
    PRIMARY KEY (id_eleve, id_quiz),
    FOREIGN KEY (id_eleve) REFERENCES Eleve(id_eleve),
    FOREIGN KEY (id_quiz) REFERENCES Quiz(id_quiz)
);
