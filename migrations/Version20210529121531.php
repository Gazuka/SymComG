<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529121531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chemin (id INT AUTO_INCREMENT NOT NULL, route VARCHAR(255) NOT NULL, params LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, chemin LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme_lien (organisme_id INT NOT NULL, lien_id INT NOT NULL, INDEX IDX_8D9652985DDD38F5 (organisme_id), INDEX IDX_8D965298EDAAC352 (lien_id), PRIMARY KEY(organisme_id, lien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organisme_lien ADD CONSTRAINT FK_8D9652985DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisme_lien ADD CONSTRAINT FK_8D965298EDAAC352 FOREIGN KEY (lien_id) REFERENCES lien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme_lien DROP FOREIGN KEY FK_8D965298EDAAC352');
        $this->addSql('DROP TABLE chemin');
        $this->addSql('DROP TABLE lien');
        $this->addSql('DROP TABLE organisme_lien');
    }
}
