<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609224755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tutoriel ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tutoriel ADD CONSTRAINT FK_A2073AEDC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_A2073AEDC18272 ON tutoriel (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tutoriel DROP FOREIGN KEY FK_A2073AEDC18272');
        $this->addSql('DROP INDEX IDX_A2073AEDC18272 ON tutoriel');
        $this->addSql('ALTER TABLE tutoriel DROP projet_id');
    }
}
