<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210804133255 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme__organisme ADD visuel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE organisme__organisme ADD CONSTRAINT FK_786259B39559EF01 FOREIGN KEY (visuel_id) REFERENCES visuel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_786259B39559EF01 ON organisme__organisme (visuel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme__organisme DROP FOREIGN KEY FK_786259B39559EF01');
        $this->addSql('DROP INDEX UNIQ_786259B39559EF01 ON organisme__organisme');
        $this->addSql('ALTER TABLE organisme__organisme DROP visuel_id');
    }
}
