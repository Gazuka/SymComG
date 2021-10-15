<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430142301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_x ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE elem_x ADD CONSTRAINT FK_9A3342D1727ACA70 FOREIGN KEY (parent_id) REFERENCES elem_zone (id)');
        $this->addSql('CREATE INDEX IDX_9A3342D1727ACA70 ON elem_x (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_x DROP FOREIGN KEY FK_9A3342D1727ACA70');
        $this->addSql('DROP INDEX IDX_9A3342D1727ACA70 ON elem_x');
        $this->addSql('ALTER TABLE elem_x DROP parent_id');
    }
}
