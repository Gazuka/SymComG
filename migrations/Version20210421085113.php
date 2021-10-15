<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421085113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enum_classeur_type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classeur__classeur ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classeur__classeur ADD CONSTRAINT FK_C25FA4B7C54C8C93 FOREIGN KEY (type_id) REFERENCES enum_classeur_type (id)');
        $this->addSql('CREATE INDEX IDX_C25FA4B7C54C8C93 ON classeur__classeur (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classeur__classeur DROP FOREIGN KEY FK_C25FA4B7C54C8C93');
        $this->addSql('DROP TABLE enum_classeur_type');
        $this->addSql('DROP INDEX IDX_C25FA4B7C54C8C93 ON classeur__classeur');
        $this->addSql('ALTER TABLE classeur__classeur DROP type_id');
    }
}
