<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602215657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B755AB72B27');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B7580F43E55');
        $this->addSql('DROP INDEX IDX_69A83B7580F43E55 ON consulter');
        $this->addSql('DROP INDEX IDX_69A83B755AB72B27 ON consulter');
        $this->addSql('ALTER TABLE consulter ADD eleve_id INT NOT NULL, ADD projet_id INT NOT NULL, DROP id_eleve_id, DROP id_projet_id');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B75A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B75C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_69A83B75A6CC7B2 ON consulter (eleve_id)');
        $this->addSql('CREATE INDEX IDX_69A83B75C18272 ON consulter (projet_id)');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE5BA17805');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE79F37AE5');
        $this->addSql('DROP INDEX IDX_311B14AE79F37AE5 ON creer');
        $this->addSql('DROP INDEX IDX_311B14AE5BA17805 ON creer');
        $this->addSql('ALTER TABLE creer ADD quiz_id INT NOT NULL, DROP id_user_id, CHANGE id_quiz_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE creer ADD CONSTRAINT FK_311B14AEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE creer ADD CONSTRAINT FK_311B14AE853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_311B14AEA76ED395 ON creer (user_id)');
        $this->addSql('CREATE INDEX IDX_311B14AE853CD175 ON creer (quiz_id)');
        $this->addSql('ALTER TABLE jouer ADD quiz_id INT NOT NULL, ADD eleve_id INT NOT NULL');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT FK_825E5AED853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT FK_825E5AEDA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_825E5AED853CD175 ON jouer (quiz_id)');
        $this->addSql('CREATE INDEX IDX_825E5AEDA6CC7B2 ON jouer (eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AED853CD175');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY FK_825E5AEDA6CC7B2');
        $this->addSql('DROP INDEX IDX_825E5AED853CD175 ON jouer');
        $this->addSql('DROP INDEX IDX_825E5AEDA6CC7B2 ON jouer');
        $this->addSql('ALTER TABLE jouer DROP quiz_id, DROP eleve_id');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B75A6CC7B2');
        $this->addSql('ALTER TABLE consulter DROP FOREIGN KEY FK_69A83B75C18272');
        $this->addSql('DROP INDEX IDX_69A83B75A6CC7B2 ON consulter');
        $this->addSql('DROP INDEX IDX_69A83B75C18272 ON consulter');
        $this->addSql('ALTER TABLE consulter ADD id_eleve_id INT NOT NULL, ADD id_projet_id INT NOT NULL, DROP eleve_id, DROP projet_id');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B755AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES eleve (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE consulter ADD CONSTRAINT FK_69A83B7580F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_69A83B7580F43E55 ON consulter (id_projet_id)');
        $this->addSql('CREATE INDEX IDX_69A83B755AB72B27 ON consulter (id_eleve_id)');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AEA76ED395');
        $this->addSql('ALTER TABLE creer DROP FOREIGN KEY FK_311B14AE853CD175');
        $this->addSql('DROP INDEX IDX_311B14AEA76ED395 ON creer');
        $this->addSql('DROP INDEX IDX_311B14AE853CD175 ON creer');
        $this->addSql('ALTER TABLE creer ADD id_user_id INT DEFAULT NULL, ADD id_quiz_id INT NOT NULL, DROP user_id, DROP quiz_id');
        $this->addSql('ALTER TABLE creer ADD CONSTRAINT FK_311B14AE5BA17805 FOREIGN KEY (id_quiz_id) REFERENCES quiz (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE creer ADD CONSTRAINT FK_311B14AE79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_311B14AE79F37AE5 ON creer (id_user_id)');
        $this->addSql('CREATE INDEX IDX_311B14AE5BA17805 ON creer (id_quiz_id)');
    }
}
