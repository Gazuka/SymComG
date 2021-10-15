<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423142940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE humain (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, carte_visite_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_E6D6B29726F61E2E (carte_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_poste (profil_id INT NOT NULL, poste_id INT NOT NULL, INDEX IDX_3285D4EF275ED078 (profil_id), INDEX IDX_3285D4EFA0905086 (poste_id), PRIMARY KEY(profil_id, poste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_classeur (profil_id INT NOT NULL, classeur_id INT NOT NULL, INDEX IDX_CDB6F6F7275ED078 (profil_id), INDEX IDX_CDB6F6F7EC10E96A (classeur_id), PRIMARY KEY(profil_id, classeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29726F61E2E FOREIGN KEY (carte_visite_id) REFERENCES carte_visite__carte_visite (id)');
        $this->addSql('ALTER TABLE profil_poste ADD CONSTRAINT FK_3285D4EF275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_poste ADD CONSTRAINT FK_3285D4EFA0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_classeur ADD CONSTRAINT FK_CDB6F6F7275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_classeur ADD CONSTRAINT FK_CDB6F6F7EC10E96A FOREIGN KEY (classeur_id) REFERENCES classeur__classeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_poste DROP FOREIGN KEY FK_3285D4EF275ED078');
        $this->addSql('ALTER TABLE profil_classeur DROP FOREIGN KEY FK_CDB6F6F7275ED078');
        $this->addSql('DROP TABLE humain');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE profil_poste');
        $this->addSql('DROP TABLE profil_classeur');
    }
}
