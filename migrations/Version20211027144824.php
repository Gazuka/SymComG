<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027144824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_article (evenement_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_13F19BAFD02F13 (evenement_id), INDEX IDX_13F19BA7294869C (article_id), PRIMARY KEY(evenement_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_article ADD CONSTRAINT FK_13F19BAFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_article ADD CONSTRAINT FK_13F19BA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement ADD article_principal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9404077F FOREIGN KEY (article_principal_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_B26681E9404077F ON evenement (article_principal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evenement_article');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9404077F');
        $this->addSql('DROP INDEX IDX_B26681E9404077F ON evenement');
        $this->addSql('ALTER TABLE evenement DROP article_principal_id');
    }
}
