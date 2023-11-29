<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027082537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE save ADD wod_id INT NOT NULL');
        $this->addSql('ALTER TABLE save ADD CONSTRAINT FK_55663ADE91C30030 FOREIGN KEY (wod_id) REFERENCES wod (id)');
        $this->addSql('CREATE INDEX IDX_55663ADE91C30030 ON save (wod_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE save DROP FOREIGN KEY FK_55663ADE91C30030');
        $this->addSql('DROP INDEX IDX_55663ADE91C30030 ON save');
        $this->addSql('ALTER TABLE save DROP wod_id');
    }
}
