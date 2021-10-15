<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805095954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_diapo DROP position');
        $this->addSql('ALTER TABLE elem_organisme DROP position');
        $this->addSql('ALTER TABLE elem_texte DROP position');
        $this->addSql('ALTER TABLE elem_titre DROP position');
        $this->addSql('ALTER TABLE elem_x ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE elem_zone DROP position');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elem_diapo ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE elem_organisme ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE elem_texte ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE elem_titre ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE elem_x DROP position');
        $this->addSql('ALTER TABLE elem_zone ADD position INT NOT NULL');
    }
}
