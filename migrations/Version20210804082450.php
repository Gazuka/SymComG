<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210804082450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_organisme DROP INDEX UNIQ_1524B7595DDD38F5, ADD INDEX IDX_1524B7595DDD38F5 (organisme_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_organisme DROP INDEX IDX_1524B7595DDD38F5, ADD UNIQUE INDEX UNIQ_1524B7595DDD38F5 (organisme_id)');
    }
}
