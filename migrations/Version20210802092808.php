<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802092808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE elem_organisme (id INT AUTO_INCREMENT NOT NULL, elem_x_id INT NOT NULL, organisme_id INT NOT NULL, UNIQUE INDEX UNIQ_1524B7599795D63C (elem_x_id), UNIQUE INDEX UNIQ_1524B7595DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE elem_organisme ADD CONSTRAINT FK_1524B7599795D63C FOREIGN KEY (elem_x_id) REFERENCES elem_x (id)');
        $this->addSql('ALTER TABLE elem_organisme ADD CONSTRAINT FK_1524B7595DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE elem_organisme');
    }
}
