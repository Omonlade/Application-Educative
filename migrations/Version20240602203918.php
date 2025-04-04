<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602203918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD tutoriel_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA97CB6CDBB FOREIGN KEY (tutoriel_id) REFERENCES tutoriel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50159CA97CB6CDBB ON projet (tutoriel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA97CB6CDBB');
        $this->addSql('DROP INDEX UNIQ_50159CA97CB6CDBB ON projet');
        $this->addSql('ALTER TABLE projet DROP tutoriel_id');
    }
}
