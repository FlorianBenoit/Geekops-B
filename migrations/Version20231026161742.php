<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026161742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wod ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE wod ADD CONSTRAINT FK_64575EEC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_64575EEC54C8C93 ON wod (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wod DROP FOREIGN KEY FK_64575EEC54C8C93');
        $this->addSql('DROP INDEX IDX_64575EEC54C8C93 ON wod');
        $this->addSql('ALTER TABLE wod DROP type_id');
    }
}
