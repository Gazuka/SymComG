<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012141759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, organisme_id INT DEFAULT NULL, carte_visite_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2F577D59727ACA70 (parent_id), UNIQUE INDEX UNIQ_2F577D595DDD38F5 (organisme_id), UNIQUE INDEX UNIQ_2F577D5926F61E2E (carte_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59727ACA70 FOREIGN KEY (parent_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D595DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D5926F61E2E FOREIGN KEY (carte_visite_id) REFERENCES carte_visite__carte_visite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59727ACA70');
        $this->addSql('DROP TABLE lieu');
    }
}
