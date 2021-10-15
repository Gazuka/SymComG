<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430123409 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_zone ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39854E71F0');
        $this->addSql('DROP INDEX IDX_41405E39854E71F0 ON element');
        $this->addSql('ALTER TABLE element DROP elem_zone_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_zone DROP position');
        $this->addSql('ALTER TABLE element ADD elem_zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39854E71F0 FOREIGN KEY (elem_zone_id) REFERENCES elem_zone (id)');
        $this->addSql('CREATE INDEX IDX_41405E39854E71F0 ON element (elem_zone_id)');
    }
}
