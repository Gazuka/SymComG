<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210417094955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_visite__carte_visite (id INT AUTO_INCREMENT NOT NULL, organisme_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D9A3AC75DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_visite_contact__adresse (id INT AUTO_INCREMENT NOT NULL, carte_visite_id INT NOT NULL, numero VARCHAR(255) DEFAULT NULL, rue1 VARCHAR(255) DEFAULT NULL, rue2 VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, prive TINYINT(1) NOT NULL, INDEX IDX_B1CD6DE526F61E2E (carte_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_visite_contact__mail (id INT AUTO_INCREMENT NOT NULL, carte_visite_id INT NOT NULL, courriel VARCHAR(255) NOT NULL, prive TINYINT(1) NOT NULL, INDEX IDX_D09078B826F61E2E (carte_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_visite_contact__telephone (id INT AUTO_INCREMENT NOT NULL, carte_visite_id INT NOT NULL, numero VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prive TINYINT(1) NOT NULL, INDEX IDX_4746A52B26F61E2E (carte_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classeur__classeur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classeur_document (classeur_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_C09ED013EC10E96A (classeur_id), INDEX IDX_C09ED013C33F7837 (document_id), PRIMARY KEY(classeur_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classeur_organisme (classeur_id INT NOT NULL, organisme_id INT NOT NULL, INDEX IDX_E0CF27BEEC10E96A (classeur_id), INDEX IDX_E0CF27BE5DDD38F5 (organisme_id), PRIMARY KEY(classeur_id, organisme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classeur__document (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, modele_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_EC8486C9AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_caracteristique (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, modele_id INT NOT NULL, titre VARCHAR(255) NOT NULL, obligatoire TINYINT(1) NOT NULL, INDEX IDX_C1ED4EB54296D31F (genre_id), INDEX IDX_C1ED4EB5AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_genre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_modele (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, twig VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_valeur (id INT AUTO_INCREMENT NOT NULL, composant_id INT NOT NULL, titre VARCHAR(255) NOT NULL, var_string VARCHAR(255) DEFAULT NULL, var_text LONGTEXT DEFAULT NULL, var_boolean TINYINT(1) DEFAULT NULL, var_integer INT DEFAULT NULL, var_float DOUBLE PRECISION DEFAULT NULL, var_array LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', var_object LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', var_datetime DATETIME DEFAULT NULL, var_date DATE DEFAULT NULL, var_time TIME DEFAULT NULL, var_dateinterval VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\', INDEX IDX_ABD4EF9D7F3310E7 (composant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenu (id INT AUTO_INCREMENT NOT NULL, page_id INT NOT NULL, position INT DEFAULT NULL, INDEX IDX_89C2003FC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element_paragraphe (id INT AUTO_INCREMENT NOT NULL, texte LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__dossier (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, descriptif LONGTEXT DEFAULT NULL, INDEX IDX_46612FF8727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__fichier (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, media_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_E05F9AD0611C0C56 (dossier_id), UNIQUE INDEX UNIQ_E05F9AD0EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__media (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_5C6DD74EC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_format_image__affiche (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, date DATE DEFAULT NULL, datefin DATE DEFAULT NULL, UNIQUE INDEX UNIQ_22B8F2A7315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_format_image__photo (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_159F664A315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_format_pdf__bulletin_municipal (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, date DATE NOT NULL, titre VARCHAR(255) NOT NULL, periode VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B9A6CDE9315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_support__image (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, alt LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_66CAFC73EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_support__pdf (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, UNIQUE INDEX UNIQ_F27CFEA9EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, element_paragraphe_id INT DEFAULT NULL, INDEX IDX_C2426282C2B3856 (element_paragraphe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__association (id INT AUTO_INCREMENT NOT NULL, organisme_id INT NOT NULL, sigle VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, presentation LONGTEXT DEFAULT NULL, local TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D20740A55DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_enum_association_type (association_id INT NOT NULL, enum_association_type_id INT NOT NULL, INDEX IDX_A3569F62EFB9C8A5 (association_id), INDEX IDX_A3569F626A5455D8 (enum_association_type_id), PRIMARY KEY(association_id, enum_association_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__association_groupe (id INT AUTO_INCREMENT NOT NULL, association_id INT NOT NULL, nom VARCHAR(255) NOT NULL, presentation LONGTEXT DEFAULT NULL, INDEX IDX_D93C3005EFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_groupe_enum_association_type (association_groupe_id INT NOT NULL, enum_association_type_id INT NOT NULL, INDEX IDX_8CD5A4FDDEA23CF9 (association_groupe_id), INDEX IDX_8CD5A4FD6A5455D8 (enum_association_type_id), PRIMARY KEY(association_groupe_id, enum_association_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__entreprise (id INT AUTO_INCREMENT NOT NULL, organisme_id INT NOT NULL, nom VARCHAR(255) NOT NULL, presentation LONGTEXT DEFAULT NULL, local TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E004145C5DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_enum_entreprise_type (entreprise_id INT NOT NULL, enum_entreprise_type_id INT NOT NULL, INDEX IDX_3D2CEE2BA4AEAFEA (entreprise_id), INDEX IDX_3D2CEE2B5C1E0DFE (enum_entreprise_type_id), PRIMARY KEY(entreprise_id, enum_entreprise_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__enum_association_type (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_4685E364727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__enum_entreprise_type (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2BBA01C3727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__organisme (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme__service (id INT AUTO_INCREMENT NOT NULL, organisme_id INT NOT NULL, nom VARCHAR(255) NOT NULL, presentation LONGTEXT DEFAULT NULL, local TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_953C71495DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, titre VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_utilisateur (role_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_2F4B3B3AD60322AC (role_id), INDEX IDX_2F4B3B3AFB88E14F (utilisateur_id), PRIMARY KEY(role_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte_visite__carte_visite ADD CONSTRAINT FK_D9A3AC75DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
        $this->addSql('ALTER TABLE carte_visite_contact__adresse ADD CONSTRAINT FK_B1CD6DE526F61E2E FOREIGN KEY (carte_visite_id) REFERENCES carte_visite__carte_visite (id)');
        $this->addSql('ALTER TABLE carte_visite_contact__mail ADD CONSTRAINT FK_D09078B826F61E2E FOREIGN KEY (carte_visite_id) REFERENCES carte_visite__carte_visite (id)');
        $this->addSql('ALTER TABLE carte_visite_contact__telephone ADD CONSTRAINT FK_4746A52B26F61E2E FOREIGN KEY (carte_visite_id) REFERENCES carte_visite__carte_visite (id)');
        $this->addSql('ALTER TABLE classeur_document ADD CONSTRAINT FK_C09ED013EC10E96A FOREIGN KEY (classeur_id) REFERENCES classeur__classeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classeur_document ADD CONSTRAINT FK_C09ED013C33F7837 FOREIGN KEY (document_id) REFERENCES classeur__document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classeur_organisme ADD CONSTRAINT FK_E0CF27BEEC10E96A FOREIGN KEY (classeur_id) REFERENCES classeur__classeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classeur_organisme ADD CONSTRAINT FK_E0CF27BE5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C9AC14B70A FOREIGN KEY (modele_id) REFERENCES composant_modele (id)');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB54296D31F FOREIGN KEY (genre_id) REFERENCES composant_genre (id)');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB5AC14B70A FOREIGN KEY (modele_id) REFERENCES composant_modele (id)');
        $this->addSql('ALTER TABLE composant_valeur ADD CONSTRAINT FK_ABD4EF9D7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003FC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE media__dossier ADD CONSTRAINT FK_46612FF8727ACA70 FOREIGN KEY (parent_id) REFERENCES media__dossier (id)');
        $this->addSql('ALTER TABLE media__fichier ADD CONSTRAINT FK_E05F9AD0611C0C56 FOREIGN KEY (dossier_id) REFERENCES media__dossier (id)');
        $this->addSql('ALTER TABLE media__fichier ADD CONSTRAINT FK_E05F9AD0EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE media__media ADD CONSTRAINT FK_5C6DD74EC33F7837 FOREIGN KEY (document_id) REFERENCES classeur__document (id)');
        $this->addSql('ALTER TABLE media_format_image__affiche ADD CONSTRAINT FK_22B8F2A7315B405 FOREIGN KEY (support_id) REFERENCES media_support__image (id)');
        $this->addSql('ALTER TABLE media_format_image__photo ADD CONSTRAINT FK_159F664A315B405 FOREIGN KEY (support_id) REFERENCES media_support__image (id)');
        $this->addSql('ALTER TABLE media_format_pdf__bulletin_municipal ADD CONSTRAINT FK_B9A6CDE9315B405 FOREIGN KEY (support_id) REFERENCES media_support__pdf (id)');
        $this->addSql('ALTER TABLE media_support__image ADD CONSTRAINT FK_66CAFC73EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE media_support__pdf ADD CONSTRAINT FK_F27CFEA9EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426282C2B3856 FOREIGN KEY (element_paragraphe_id) REFERENCES element_paragraphe (id)');
        $this->addSql('ALTER TABLE organisme__association ADD CONSTRAINT FK_D20740A55DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
        $this->addSql('ALTER TABLE association_enum_association_type ADD CONSTRAINT FK_A3569F62EFB9C8A5 FOREIGN KEY (association_id) REFERENCES organisme__association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_enum_association_type ADD CONSTRAINT FK_A3569F626A5455D8 FOREIGN KEY (enum_association_type_id) REFERENCES organisme__enum_association_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisme__association_groupe ADD CONSTRAINT FK_D93C3005EFB9C8A5 FOREIGN KEY (association_id) REFERENCES organisme__association (id)');
        $this->addSql('ALTER TABLE association_groupe_enum_association_type ADD CONSTRAINT FK_8CD5A4FDDEA23CF9 FOREIGN KEY (association_groupe_id) REFERENCES organisme__association_groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_groupe_enum_association_type ADD CONSTRAINT FK_8CD5A4FD6A5455D8 FOREIGN KEY (enum_association_type_id) REFERENCES organisme__enum_association_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisme__entreprise ADD CONSTRAINT FK_E004145C5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
        $this->addSql('ALTER TABLE entreprise_enum_entreprise_type ADD CONSTRAINT FK_3D2CEE2BA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES organisme__entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_enum_entreprise_type ADD CONSTRAINT FK_3D2CEE2B5C1E0DFE FOREIGN KEY (enum_entreprise_type_id) REFERENCES organisme__enum_entreprise_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisme__enum_association_type ADD CONSTRAINT FK_4685E364727ACA70 FOREIGN KEY (parent_id) REFERENCES organisme__enum_association_type (id)');
        $this->addSql('ALTER TABLE organisme__enum_entreprise_type ADD CONSTRAINT FK_2BBA01C3727ACA70 FOREIGN KEY (parent_id) REFERENCES organisme__enum_entreprise_type (id)');
        $this->addSql('ALTER TABLE organisme__service ADD CONSTRAINT FK_953C71495DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme__organisme (id)');
        $this->addSql('ALTER TABLE role_utilisateur ADD CONSTRAINT FK_2F4B3B3AD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_utilisateur ADD CONSTRAINT FK_2F4B3B3AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_visite_contact__adresse DROP FOREIGN KEY FK_B1CD6DE526F61E2E');
        $this->addSql('ALTER TABLE carte_visite_contact__mail DROP FOREIGN KEY FK_D09078B826F61E2E');
        $this->addSql('ALTER TABLE carte_visite_contact__telephone DROP FOREIGN KEY FK_4746A52B26F61E2E');
        $this->addSql('ALTER TABLE classeur_document DROP FOREIGN KEY FK_C09ED013EC10E96A');
        $this->addSql('ALTER TABLE classeur_organisme DROP FOREIGN KEY FK_E0CF27BEEC10E96A');
        $this->addSql('ALTER TABLE classeur_document DROP FOREIGN KEY FK_C09ED013C33F7837');
        $this->addSql('ALTER TABLE media__media DROP FOREIGN KEY FK_5C6DD74EC33F7837');
        $this->addSql('ALTER TABLE composant_valeur DROP FOREIGN KEY FK_ABD4EF9D7F3310E7');
        $this->addSql('ALTER TABLE composant_caracteristique DROP FOREIGN KEY FK_C1ED4EB54296D31F');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C9AC14B70A');
        $this->addSql('ALTER TABLE composant_caracteristique DROP FOREIGN KEY FK_C1ED4EB5AC14B70A');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426282C2B3856');
        $this->addSql('ALTER TABLE media__dossier DROP FOREIGN KEY FK_46612FF8727ACA70');
        $this->addSql('ALTER TABLE media__fichier DROP FOREIGN KEY FK_E05F9AD0611C0C56');
        $this->addSql('ALTER TABLE media__fichier DROP FOREIGN KEY FK_E05F9AD0EA9FDD75');
        $this->addSql('ALTER TABLE media_support__image DROP FOREIGN KEY FK_66CAFC73EA9FDD75');
        $this->addSql('ALTER TABLE media_support__pdf DROP FOREIGN KEY FK_F27CFEA9EA9FDD75');
        $this->addSql('ALTER TABLE media_format_image__affiche DROP FOREIGN KEY FK_22B8F2A7315B405');
        $this->addSql('ALTER TABLE media_format_image__photo DROP FOREIGN KEY FK_159F664A315B405');
        $this->addSql('ALTER TABLE media_format_pdf__bulletin_municipal DROP FOREIGN KEY FK_B9A6CDE9315B405');
        $this->addSql('ALTER TABLE association_enum_association_type DROP FOREIGN KEY FK_A3569F62EFB9C8A5');
        $this->addSql('ALTER TABLE organisme__association_groupe DROP FOREIGN KEY FK_D93C3005EFB9C8A5');
        $this->addSql('ALTER TABLE association_groupe_enum_association_type DROP FOREIGN KEY FK_8CD5A4FDDEA23CF9');
        $this->addSql('ALTER TABLE entreprise_enum_entreprise_type DROP FOREIGN KEY FK_3D2CEE2BA4AEAFEA');
        $this->addSql('ALTER TABLE association_enum_association_type DROP FOREIGN KEY FK_A3569F626A5455D8');
        $this->addSql('ALTER TABLE association_groupe_enum_association_type DROP FOREIGN KEY FK_8CD5A4FD6A5455D8');
        $this->addSql('ALTER TABLE organisme__enum_association_type DROP FOREIGN KEY FK_4685E364727ACA70');
        $this->addSql('ALTER TABLE entreprise_enum_entreprise_type DROP FOREIGN KEY FK_3D2CEE2B5C1E0DFE');
        $this->addSql('ALTER TABLE organisme__enum_entreprise_type DROP FOREIGN KEY FK_2BBA01C3727ACA70');
        $this->addSql('ALTER TABLE carte_visite__carte_visite DROP FOREIGN KEY FK_D9A3AC75DDD38F5');
        $this->addSql('ALTER TABLE classeur_organisme DROP FOREIGN KEY FK_E0CF27BE5DDD38F5');
        $this->addSql('ALTER TABLE organisme__association DROP FOREIGN KEY FK_D20740A55DDD38F5');
        $this->addSql('ALTER TABLE organisme__entreprise DROP FOREIGN KEY FK_E004145C5DDD38F5');
        $this->addSql('ALTER TABLE organisme__service DROP FOREIGN KEY FK_953C71495DDD38F5');
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003FC4663E4');
        $this->addSql('ALTER TABLE role_utilisateur DROP FOREIGN KEY FK_2F4B3B3AD60322AC');
        $this->addSql('ALTER TABLE role_utilisateur DROP FOREIGN KEY FK_2F4B3B3AFB88E14F');
        $this->addSql('DROP TABLE carte_visite__carte_visite');
        $this->addSql('DROP TABLE carte_visite_contact__adresse');
        $this->addSql('DROP TABLE carte_visite_contact__mail');
        $this->addSql('DROP TABLE carte_visite_contact__telephone');
        $this->addSql('DROP TABLE classeur__classeur');
        $this->addSql('DROP TABLE classeur_document');
        $this->addSql('DROP TABLE classeur_organisme');
        $this->addSql('DROP TABLE classeur__document');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE composant_caracteristique');
        $this->addSql('DROP TABLE composant_genre');
        $this->addSql('DROP TABLE composant_modele');
        $this->addSql('DROP TABLE composant_valeur');
        $this->addSql('DROP TABLE contenu');
        $this->addSql('DROP TABLE element_paragraphe');
        $this->addSql('DROP TABLE media__dossier');
        $this->addSql('DROP TABLE media__fichier');
        $this->addSql('DROP TABLE media__media');
        $this->addSql('DROP TABLE media_format_image__affiche');
        $this->addSql('DROP TABLE media_format_image__photo');
        $this->addSql('DROP TABLE media_format_pdf__bulletin_municipal');
        $this->addSql('DROP TABLE media_support__image');
        $this->addSql('DROP TABLE media_support__pdf');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE organisme__association');
        $this->addSql('DROP TABLE association_enum_association_type');
        $this->addSql('DROP TABLE organisme__association_groupe');
        $this->addSql('DROP TABLE association_groupe_enum_association_type');
        $this->addSql('DROP TABLE organisme__entreprise');
        $this->addSql('DROP TABLE entreprise_enum_entreprise_type');
        $this->addSql('DROP TABLE organisme__enum_association_type');
        $this->addSql('DROP TABLE organisme__enum_entreprise_type');
        $this->addSql('DROP TABLE organisme__organisme');
        $this->addSql('DROP TABLE organisme__service');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
