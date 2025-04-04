<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602214426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED5AB72B27');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED5BA17805');
        $this->addSql('DROP INDEX IDX_825E5AED5BA17805 ON jouer');
        $this->addSql('DROP INDEX IDX_825E5AED5AB72B27 ON jouer');
        $this->addSql('ALTER TABLE jouer DROP id_eleve_id, DROP id_quiz_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jouer ADD id_eleve_id INT NOT NULL, ADD id_quiz_id INT NOT NULL');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT FK_825E5AED5AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES eleve (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT FK_825E5AED5BA17805 FOREIGN KEY (id_quiz_id) REFERENCES quiz (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_825E5AED5BA17805 ON jouer (id_quiz_id)');
        $this->addSql('CREATE INDEX IDX_825E5AED5AB72B27 ON jouer (id_eleve_id)');
    }
}
