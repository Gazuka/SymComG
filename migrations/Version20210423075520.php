<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423075520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, titre_feminin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, fonction_id INT NOT NULL, secteur_id INT DEFAULT NULL, carte_visite_id INT DEFAULT NULL, organisme_id INT NOT NULL, statut_id INT NOT NULL, INDEX IDX_7C890FAB57889920 (fonction_id), INDEX IDX_7C890FAB9F7E4405 (secteur_id), INDEX IDX_7C890FAB26F61E2E (carte_visite_id), INDEX IDX_7C890FAB5DDD38F5 (organisme_id), INDEX IDX_7C890FABF6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB57889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB26F61E2E FOREIGN KEY (carte_visite_id) REFERENCES carte_visite__carte_visite (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FABF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB57889920');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB9F7E4405');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FABF6203804');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE statut');
    }
}
