<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505085358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE elem_texte (id INT AUTO_INCREMENT NOT NULL, elem_x_id INT NOT NULL, html LONGTEXT DEFAULT NULL, position INT NOT NULL, UNIQUE INDEX UNIQ_CD62BDD99795D63C (elem_x_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE elem_texte ADD CONSTRAINT FK_CD62BDD99795D63C FOREIGN KEY (elem_x_id) REFERENCES elem_x (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE elem_texte');
    }
}
