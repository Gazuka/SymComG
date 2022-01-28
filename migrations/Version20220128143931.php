<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128143931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_format_pdf__marche_public ADD support_id INT NOT NULL');
        $this->addSql('ALTER TABLE media_format_pdf__marche_public ADD CONSTRAINT FK_A49D8D1315B405 FOREIGN KEY (support_id) REFERENCES media_support__pdf (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A49D8D1315B405 ON media_format_pdf__marche_public (support_id)');
        $this->addSql('ALTER TABLE media_support__pdf DROP FOREIGN KEY FK_F27CFEA98B32B98E');
        $this->addSql('DROP INDEX UNIQ_F27CFEA98B32B98E ON media_support__pdf');
        $this->addSql('ALTER TABLE media_support__pdf DROP marche_public_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_format_pdf__marche_public DROP FOREIGN KEY FK_A49D8D1315B405');
        $this->addSql('DROP INDEX UNIQ_A49D8D1315B405 ON media_format_pdf__marche_public');
        $this->addSql('ALTER TABLE media_format_pdf__marche_public DROP support_id');
        $this->addSql('ALTER TABLE media_support__pdf ADD marche_public_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media_support__pdf ADD CONSTRAINT FK_F27CFEA98B32B98E FOREIGN KEY (marche_public_id) REFERENCES media_format_pdf__marche_public (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F27CFEA98B32B98E ON media_support__pdf (marche_public_id)');
    }
}
