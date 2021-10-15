<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529121909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lien ADD chemin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lien ADD CONSTRAINT FK_A532B4B53BD6E429 FOREIGN KEY (chemin_id) REFERENCES chemin (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A532B4B53BD6E429 ON lien (chemin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lien DROP FOREIGN KEY FK_A532B4B53BD6E429');
        $this->addSql('DROP INDEX UNIQ_A532B4B53BD6E429 ON lien');
        $this->addSql('ALTER TABLE lien DROP chemin_id');
    }
}
