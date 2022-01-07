<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106085959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stats_log (id INT AUTO_INCREMENT NOT NULL, route_id INT NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_E72D486E34ECB4E6 (route_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_log_stats_param (stats_log_id INT NOT NULL, stats_param_id INT NOT NULL, INDEX IDX_C5C6C0715977BA85 (stats_log_id), INDEX IDX_C5C6C07143045F6B (stats_param_id), PRIMARY KEY(stats_log_id, stats_param_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stats_log ADD CONSTRAINT FK_E72D486E34ECB4E6 FOREIGN KEY (route_id) REFERENCES stats_route (id)');
        $this->addSql('ALTER TABLE stats_log_stats_param ADD CONSTRAINT FK_C5C6C0715977BA85 FOREIGN KEY (stats_log_id) REFERENCES stats_log (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stats_log_stats_param ADD CONSTRAINT FK_C5C6C07143045F6B FOREIGN KEY (stats_param_id) REFERENCES stats_param (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stats_log_stats_param DROP FOREIGN KEY FK_C5C6C0715977BA85');
        $this->addSql('DROP TABLE stats_log');
        $this->addSql('DROP TABLE stats_log_stats_param');
    }
}
