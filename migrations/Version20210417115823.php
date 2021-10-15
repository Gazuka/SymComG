<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210417115823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_format_pdf__arrete_municipal (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, date DATE NOT NULL, datefin DATE DEFAULT NULL, titre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EDDDD083315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_format_pdf__arrete_municipal ADD CONSTRAINT FK_EDDDD083315B405 FOREIGN KEY (support_id) REFERENCES media_support__pdf (id)');
        $this->addSql('DROP TABLE arrete_municipal');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arrete_municipal (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, date DATE NOT NULL, datefin DATE DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_CA044513315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE arrete_municipal ADD CONSTRAINT FK_CA044513315B405 FOREIGN KEY (support_id) REFERENCES media_support__pdf (id)');
        $this->addSql('DROP TABLE media_format_pdf__arrete_municipal');
    }
}
