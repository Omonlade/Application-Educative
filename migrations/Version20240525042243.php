<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525042243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consulter (id INT AUTO_INCREMENT NOT NULL, id_eleve_id INT NOT NULL, id_projet_id INT NOT NULL, INDEX IDX_69A83B755AB72B27 (id_eleve_id), INDEX IDX_69A83B7580F43E55 (id_projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creer (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_quiz_id INT NOT NULL, date_creation DATE NOT NULL, INDEX IDX_311B14AE79F37AE5 (id_user_id), INDEX IDX_311B14AE5BA17805 (id_quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jouer (id INT AUTO_INCREMENT NOT NULL, id_eleve_id INT NOT NULL, id_quiz_id INT NOT NULL, score INT NOT NULL, date_jeu DATE NOT NULL, INDEX IDX_825E5AED5AB72B27 (id_eleve_id), INDEX IDX_825E5AED5BA17805 (id_quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, id_tutoriel_id INT NOT NULL, id_equipement_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_creation DATE NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_50159CA964A4004C (id_tutoriel_id), INDEX IDX_50159CA93E47DE39 (id_equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, questionnaire LONGTEXT NOT NULL, INDEX IDX_B6F7494E853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_question_id INT NOT NULL, contenu LONGTEXT NOT NULL, est_correcte TINYINT(1) NOT NULL, INDEX IDX_5FB6DEC76353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutoriel (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, video LONGTEXT NOT NULL, date_ajout DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utiliser (id INT AUTO_INCREMENT NOT NULL, id_projet_id INT NOT NULL, id_equipement_id INT NOT NULL, INDEX IDX_5C94910980F43E55 (id_projet_id), INDEX IDX_5C9491093E47DE39 (id_equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B755AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B7580F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE creer ADD CONSTRAINT FK_311B14AE79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE creer ADD CONSTRAINT FK_311B14AE5BA17805 FOREIGN KEY (id_quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT FK_825E5AED5AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT FK_825E5AED5BA17805 FOREIGN KEY (id_quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA964A4004C FOREIGN KEY (id_tutoriel_id) REFERENCES tutoriel (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA93E47DE39 FOREIGN KEY (id_equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C94910980F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491093E47DE39 FOREIGN KEY (id_equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE utilisation DROP FOREIGN KEY FK_B02A3C43597A6CB7');
        $this->addSql('ALTER TABLE utilisation DROP FOREIGN KEY FK_B02A3C43806F0F5C');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D07597A6CB7');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D07A6CC7B2');
        $this->addSql('DROP TABLE visiteur');
        $this->addSql('DROP TABLE utilisation');
        $this->addSql('DROP TABLE tutoriels');
        $this->addSql('DROP TABLE realiser');
        $this->addSql('DROP TABLE projets');
        $this->addSql('ALTER TABLE eleve ADD mot_de_passe VARCHAR(255) NOT NULL, DROP password, DROP classe, DROP niveau, CHANGE datenaissance date_naissance DATE NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD image LONGTEXT NOT NULL, DROP statut');
        $this->addSql('ALTER TABLE user DROP sexe');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sexe VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, visite_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisation (id INT AUTO_INCREMENT NOT NULL, equipement_id INT NOT NULL, projets_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_B02A3C43806F0F5C (equipement_id), INDEX IDX_B02A3C43597A6CB7 (projets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tutoriels (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lien_youtube VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE realiser (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, projets_id INT NOT NULL, pourcentage NUMERIC(5, 2) NOT NULL, INDEX IDX_7BAB8D07A6CC7B2 (eleve_id), INDEX IDX_7BAB8D07597A6CB7 (projets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE projets (id INT AUTO_INCREMENT NOT NULL, nom_pro VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description_pro LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_debut DATE NOT NULL, date_fin DATE NOT NULL, statut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisation ADD CONSTRAINT FK_B02A3C43597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE utilisation ADD CONSTRAINT FK_B02A3C43806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D07597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D07A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B755AB72B27');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B7580F43E55');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE79F37AE5');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE5BA17805');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED5AB72B27');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED5BA17805');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA964A4004C');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA93E47DE39');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E853CD175');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C94910980F43E55');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491093E47DE39');
        $this->addSql('DROP TABLE consulter');
        $this->addSql('DROP TABLE creer');
        $this->addSql('DROP TABLE jouer');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE tutoriel');
        $this->addSql('DROP TABLE utiliser');
        $this->addSql('ALTER TABLE eleve ADD classe VARCHAR(255) NOT NULL, ADD niveau VARCHAR(255) NOT NULL, CHANGE mot_de_passe password VARCHAR(255) NOT NULL, CHANGE date_naissance datenaissance DATE NOT NULL');
        $this->addSql('ALTER TABLE user ADD sexe VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD statut VARCHAR(255) NOT NULL, DROP image');
    }
}
