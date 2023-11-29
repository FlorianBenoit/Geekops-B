<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102140012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_repetition ADD wod_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercice_repetition ADD CONSTRAINT FK_69CFD7E891C30030 FOREIGN KEY (wod_id) REFERENCES wod (id)');
        $this->addSql('CREATE INDEX IDX_69CFD7E891C30030 ON exercice_repetition (wod_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_repetition DROP FOREIGN KEY FK_69CFD7E891C30030');
        $this->addSql('DROP INDEX IDX_69CFD7E891C30030 ON exercice_repetition');
        $this->addSql('ALTER TABLE exercice_repetition DROP wod_id');
    }
}
