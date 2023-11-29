<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027153426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wod ADD repetition_id INT NOT NULL');
        $this->addSql('ALTER TABLE wod ADD CONSTRAINT FK_64575EEA06DF6FF FOREIGN KEY (repetition_id) REFERENCES wod_repetition (id)');
        $this->addSql('CREATE INDEX IDX_64575EEA06DF6FF ON wod (repetition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wod DROP FOREIGN KEY FK_64575EEA06DF6FF');
        $this->addSql('DROP INDEX IDX_64575EEA06DF6FF ON wod');
        $this->addSql('ALTER TABLE wod DROP repetition_id');
    }
}
