<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430082857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visuel ADD elem_zone_id INT NOT NULL');
        $this->addSql('ALTER TABLE visuel ADD CONSTRAINT FK_8FA54D1B854E71F0 FOREIGN KEY (elem_zone_id) REFERENCES elem_zone (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8FA54D1B854E71F0 ON visuel (elem_zone_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visuel DROP FOREIGN KEY FK_8FA54D1B854E71F0');
        $this->addSql('DROP INDEX UNIQ_8FA54D1B854E71F0 ON visuel');
        $this->addSql('ALTER TABLE visuel DROP elem_zone_id');
    }
}
