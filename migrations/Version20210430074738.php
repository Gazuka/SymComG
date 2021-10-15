<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430074738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD visuel_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E669559EF01 FOREIGN KEY (visuel_id) REFERENCES visuel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E669559EF01 ON article (visuel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E669559EF01');
        $this->addSql('DROP INDEX UNIQ_23A0E669559EF01 ON article');
        $this->addSql('ALTER TABLE article DROP visuel_id');
    }
}
