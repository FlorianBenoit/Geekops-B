<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114141356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_repetition DROP FOREIGN KEY FK_69CFD7E8A06DF6FF');
        $this->addSql('ALTER TABLE exercice_repetition DROP FOREIGN KEY FK_69CFD7E889D40298');
        $this->addSql('DROP TABLE repetition');
        $this->addSql('DROP TABLE exercice_repetition');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repetition (id INT AUTO_INCREMENT NOT NULL, repetition INT DEFAULT NULL, time INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exercice_repetition (exercice_id INT NOT NULL, repetition_id INT NOT NULL, INDEX IDX_69CFD7E8A06DF6FF (repetition_id), INDEX IDX_69CFD7E889D40298 (exercice_id), PRIMARY KEY(exercice_id, repetition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exercice_repetition ADD CONSTRAINT FK_69CFD7E8A06DF6FF FOREIGN KEY (repetition_id) REFERENCES repetition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_repetition ADD CONSTRAINT FK_69CFD7E889D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
    }
}
