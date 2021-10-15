<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729144601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD annexe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66B79A2A8C FOREIGN KEY (annexe_id) REFERENCES visuel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66B79A2A8C ON article (annexe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66B79A2A8C');
        $this->addSql('DROP INDEX UNIQ_23A0E66B79A2A8C ON article');
        $this->addSql('ALTER TABLE article DROP annexe_id');
    }
}
