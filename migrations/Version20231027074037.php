<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027074037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wod_exercice (wod_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_1CF6FE6391C30030 (wod_id), INDEX IDX_1CF6FE6389D40298 (exercice_id), PRIMARY KEY(wod_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wod_exercice ADD CONSTRAINT FK_1CF6FE6391C30030 FOREIGN KEY (wod_id) REFERENCES wod (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wod_exercice ADD CONSTRAINT FK_1CF6FE6389D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wod_exercice DROP FOREIGN KEY FK_1CF6FE6391C30030');
        $this->addSql('ALTER TABLE wod_exercice DROP FOREIGN KEY FK_1CF6FE6389D40298');
        $this->addSql('DROP TABLE wod_exercice');
    }
}
