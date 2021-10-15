<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518072121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE elem_diapo (id INT AUTO_INCREMENT NOT NULL, elem_x_id INT NOT NULL, classeur_id INT NOT NULL, UNIQUE INDEX UNIQ_701A21069795D63C (elem_x_id), UNIQUE INDEX UNIQ_701A2106EC10E96A (classeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE elem_diapo ADD CONSTRAINT FK_701A21069795D63C FOREIGN KEY (elem_x_id) REFERENCES elem_x (id)');
        $this->addSql('ALTER TABLE elem_diapo ADD CONSTRAINT FK_701A2106EC10E96A FOREIGN KEY (classeur_id) REFERENCES classeur__classeur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE elem_diapo');
    }
}
