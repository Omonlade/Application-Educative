<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609220806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B75A6CC7B2');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B75C18272');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B75A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B75C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA97CB6CDBB');
        $this->addSql('ALTER TABLE projet CHANGE tutoriel_id tutoriel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA97CB6CDBB FOREIGN KEY (tutoriel_id) REFERENCES tutoriel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109A6CC7B2');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109C18272');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109C18272');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C949109A6CC7B2');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C949109A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA97CB6CDBB');
        $this->addSql('ALTER TABLE projet CHANGE tutoriel_id tutoriel_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA97CB6CDBB FOREIGN KEY (tutoriel_id) REFERENCES tutoriel (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B75A6CC7B2');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B75C18272');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B75A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B75C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
