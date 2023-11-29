<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102153755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repetition (id INT AUTO_INCREMENT NOT NULL, repetition INT DEFAULT NULL, time INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repetition_exercice (repetition_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_B321166EA06DF6FF (repetition_id), INDEX IDX_B321166E89D40298 (exercice_id), PRIMARY KEY(repetition_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repetition_exercice ADD CONSTRAINT FK_B321166EA06DF6FF FOREIGN KEY (repetition_id) REFERENCES repetition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repetition_exercice ADD CONSTRAINT FK_B321166E89D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE exercice_repetition');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_repetition (id INT AUTO_INCREMENT NOT NULL, repetition INT DEFAULT NULL, time INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE repetition_exercice DROP FOREIGN KEY FK_B321166EA06DF6FF');
        $this->addSql('ALTER TABLE repetition_exercice DROP FOREIGN KEY FK_B321166E89D40298');
        $this->addSql('DROP TABLE repetition');
        $this->addSql('DROP TABLE repetition_exercice');
    }
}
