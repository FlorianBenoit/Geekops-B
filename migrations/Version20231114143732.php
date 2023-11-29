<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114143732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, image LONGTEXT DEFAULT NULL, INDEX IDX_AC74095A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantity (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unity (id INT AUTO_INCREMENT NOT NULL, repetition INT DEFAULT NULL, time INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE exercice ADD activity_id INT NOT NULL, ADD quantity_id INT NOT NULL, ADD unity_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D7E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DF6859C8C FOREIGN KEY (unity_id) REFERENCES unity (id)');
        $this->addSql('CREATE INDEX IDX_E418C74D81C06096 ON exercice (activity_id)');
        $this->addSql('CREATE INDEX IDX_E418C74D7E8B4AFC ON exercice (quantity_id)');
        $this->addSql('CREATE INDEX IDX_E418C74DF6859C8C ON exercice (unity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D81C06096');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D7E8B4AFC');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DF6859C8C');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('DROP TABLE unity');
        $this->addSql('DROP INDEX IDX_E418C74D81C06096 ON exercice');
        $this->addSql('DROP INDEX IDX_E418C74D7E8B4AFC ON exercice');
        $this->addSql('DROP INDEX IDX_E418C74DF6859C8C ON exercice');
        $this->addSql('ALTER TABLE exercice DROP activity_id, DROP quantity_id, DROP unity_id');
    }
}
