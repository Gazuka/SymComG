<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210424144500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE poste_profil (poste_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_3600AD92A0905086 (poste_id), INDEX IDX_3600AD92275ED078 (profil_id), PRIMARY KEY(poste_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poste_profil ADD CONSTRAINT FK_3600AD92A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poste_profil ADD CONSTRAINT FK_3600AD92275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE profil_poste');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_poste (profil_id INT NOT NULL, poste_id INT NOT NULL, INDEX IDX_3285D4EFA0905086 (poste_id), INDEX IDX_3285D4EF275ED078 (profil_id), PRIMARY KEY(profil_id, poste_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE profil_poste ADD CONSTRAINT FK_3285D4EF275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_poste ADD CONSTRAINT FK_3285D4EFA0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE poste_profil');
    }
}
