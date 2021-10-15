<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831072354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, visuel_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_BBC83DB69559EF01 (visuel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE horaire ADD CONSTRAINT FK_BBC83DB69559EF01 FOREIGN KEY (visuel_id) REFERENCES visuel (id)');
        $this->addSql('ALTER TABLE organisme__organisme ADD horaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE organisme__organisme ADD CONSTRAINT FK_786259B358C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_786259B358C54515 ON organisme__organisme (horaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme__organisme DROP FOREIGN KEY FK_786259B358C54515');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP INDEX UNIQ_786259B358C54515 ON organisme__organisme');
        $this->addSql('ALTER TABLE organisme__organisme DROP horaire_id');
    }
}
