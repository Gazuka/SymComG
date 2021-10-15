<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428124131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poste DROP INDEX IDX_7C890FAB26F61E2E, ADD UNIQUE INDEX UNIQ_7C890FAB26F61E2E (carte_visite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poste DROP INDEX UNIQ_7C890FAB26F61E2E, ADD INDEX IDX_7C890FAB26F61E2E (carte_visite_id)');
    }
}
