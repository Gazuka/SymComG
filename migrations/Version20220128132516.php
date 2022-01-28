<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128132516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_format_pdf__marche_public (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, titre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A49D8D1315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_format_pdf__marche_public ADD CONSTRAINT FK_A49D8D1315B405 FOREIGN KEY (support_id) REFERENCES media_support__pdf (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE media_format_pdf__marche_public');
    }
}
