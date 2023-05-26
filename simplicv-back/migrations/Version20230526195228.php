<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526195228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cover_letter (id INT AUTO_INCREMENT NOT NULL, firstname_sender VARCHAR(255) NOT NULL, lastname_sender VARCHAR(255) NOT NULL, mail_address_sender VARCHAR(255) NOT NULL, phone_number_sender INT NOT NULL, postal_address_receiver VARCHAR(255) NOT NULL, zip_code_receiver INT NOT NULL, city_receiver VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, date_of_creation DATE NOT NULL, place_of_creation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cover_letter_model (id INT AUTO_INCREMENT NOT NULL, cover_letter_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, text_font VARCHAR(255) NOT NULL, title_font VARCHAR(255) NOT NULL, bg_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, title_color VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_5621F66EB944729C (cover_letter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, bg_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, text_font VARCHAR(255) NOT NULL, title_font VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_profil (cvmodel_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_85F2200B46B405D4 (cvmodel_id), INDEX IDX_85F2200B275ED078 (profil_id), PRIMARY KEY(cvmodel_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_formation (cvmodel_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_CB3D6C0146B405D4 (cvmodel_id), INDEX IDX_CB3D6C015200282E (formation_id), PRIMARY KEY(cvmodel_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_experience (cvmodel_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_29C222C546B405D4 (cvmodel_id), INDEX IDX_29C222C546E90E27 (experience_id), PRIMARY KEY(cvmodel_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_skill (cvmodel_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_7CC3A16A46B405D4 (cvmodel_id), INDEX IDX_7CC3A16A5585C142 (skill_id), PRIMARY KEY(cvmodel_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_language (cvmodel_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_172E25EF46B405D4 (cvmodel_id), INDEX IDX_172E25EF82F1BAF4 (language_id), PRIMARY KEY(cvmodel_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_social_medias (cvmodel_id INT NOT NULL, social_medias_id INT NOT NULL, INDEX IDX_698DB77446B405D4 (cvmodel_id), INDEX IDX_698DB774F5A2FA3C (social_medias_id), PRIMARY KEY(cvmodel_id, social_medias_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, job_title VARCHAR(255) NOT NULL, employer VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, contrat_type LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', start_date DATE NOT NULL, end_date DATE NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, degree VARCHAR(255) NOT NULL, name_school VARCHAR(255) NOT NULL, location_school VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, date_of_birth DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', phone_number INT NOT NULL, postal_address VARCHAR(255) NOT NULL, zip_code INT NOT NULL, city VARCHAR(255) NOT NULL, driving_licence VARCHAR(255) DEFAULT NULL, mail_address VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_medias (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cover_letter_model ADD CONSTRAINT FK_5621F66EB944729C FOREIGN KEY (cover_letter_id) REFERENCES cover_letter_model (id)');
        $this->addSql('ALTER TABLE cvmodel_profil ADD CONSTRAINT FK_85F2200B46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_profil ADD CONSTRAINT FK_85F2200B275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_formation ADD CONSTRAINT FK_CB3D6C0146B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_formation ADD CONSTRAINT FK_CB3D6C015200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_experience ADD CONSTRAINT FK_29C222C546B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_experience ADD CONSTRAINT FK_29C222C546E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_skill ADD CONSTRAINT FK_7CC3A16A46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_skill ADD CONSTRAINT FK_7CC3A16A5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_language ADD CONSTRAINT FK_172E25EF46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_language ADD CONSTRAINT FK_172E25EF82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_social_medias ADD CONSTRAINT FK_698DB77446B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cvmodel_social_medias ADD CONSTRAINT FK_698DB774F5A2FA3C FOREIGN KEY (social_medias_id) REFERENCES social_medias (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cover_letter_model DROP FOREIGN KEY FK_5621F66EB944729C');
        $this->addSql('ALTER TABLE cvmodel_profil DROP FOREIGN KEY FK_85F2200B46B405D4');
        $this->addSql('ALTER TABLE cvmodel_profil DROP FOREIGN KEY FK_85F2200B275ED078');
        $this->addSql('ALTER TABLE cvmodel_formation DROP FOREIGN KEY FK_CB3D6C0146B405D4');
        $this->addSql('ALTER TABLE cvmodel_formation DROP FOREIGN KEY FK_CB3D6C015200282E');
        $this->addSql('ALTER TABLE cvmodel_experience DROP FOREIGN KEY FK_29C222C546B405D4');
        $this->addSql('ALTER TABLE cvmodel_experience DROP FOREIGN KEY FK_29C222C546E90E27');
        $this->addSql('ALTER TABLE cvmodel_skill DROP FOREIGN KEY FK_7CC3A16A46B405D4');
        $this->addSql('ALTER TABLE cvmodel_skill DROP FOREIGN KEY FK_7CC3A16A5585C142');
        $this->addSql('ALTER TABLE cvmodel_language DROP FOREIGN KEY FK_172E25EF46B405D4');
        $this->addSql('ALTER TABLE cvmodel_language DROP FOREIGN KEY FK_172E25EF82F1BAF4');
        $this->addSql('ALTER TABLE cvmodel_social_medias DROP FOREIGN KEY FK_698DB77446B405D4');
        $this->addSql('ALTER TABLE cvmodel_social_medias DROP FOREIGN KEY FK_698DB774F5A2FA3C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE cover_letter');
        $this->addSql('DROP TABLE cover_letter_model');
        $this->addSql('DROP TABLE cvmodel');
        $this->addSql('DROP TABLE cvmodel_profil');
        $this->addSql('DROP TABLE cvmodel_formation');
        $this->addSql('DROP TABLE cvmodel_experience');
        $this->addSql('DROP TABLE cvmodel_skill');
        $this->addSql('DROP TABLE cvmodel_language');
        $this->addSql('DROP TABLE cvmodel_social_medias');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE social_medias');
        $this->addSql('DROP TABLE user');
    }
}
