<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528124927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, sexe VARCHAR(1) NOT NULL, password VARCHAR(255) NOT NULL, image LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image LONGTEXT NOT NULL, description LONGTEXT NOT NULL, date_ajout DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consulter ADD date_consulter DATE NOT NULL');
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
        $this->addSql('DROP INDEX IDX_5C94910980F43E55 ON utiliser');
        $this->addSql('DROP INDEX IDX_5C9491093E47DE39 ON utiliser');
        $this->addSql('ALTER TABLE utiliser ADD projet_id INT NOT NULL, ADD eleve_id INT NOT NULL, ADD date_utiliser DATE NOT NULL, DROP id_projet_id, DROP id_equipement_id');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_5C949109C18272 ON utiliser (projet_id)');
        $this->addSql('CREATE INDEX IDX_5C949109A6CC7B2 ON utiliser (eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B755AB72B27');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED5AB72B27');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109A6CC7B2');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA93E47DE39');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE79F37AE5');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109C18272');
        $this->addSql('DROP INDEX IDX_5C949109C18272 ON utiliser');
        $this->addSql('DROP INDEX IDX_5C949109A6CC7B2 ON utiliser');
        $this->addSql('ALTER TABLE utiliser ADD id_projet_id INT NOT NULL, ADD id_equipement_id INT NOT NULL, DROP projet_id, DROP eleve_id, DROP date_utiliser');
        $this->addSql('CREATE INDEX IDX_5C94910980F43E55 ON utiliser (id_projet_id)');
        $this->addSql('CREATE INDEX IDX_5C9491093E47DE39 ON utiliser (id_equipement_id)');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE5BA17805');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED5BA17805');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E853CD175');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B7580F43E55');
        $this->addSql('ALTER TABLE consulter DROP date_consulter');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA964A4004C');
    }
}
