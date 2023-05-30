<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526132852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cvmodel_profil (cvmodel_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_85F2200B46B405D4 (cvmodel_id), INDEX IDX_85F2200B275ED078 (profil_id), PRIMARY KEY(cvmodel_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_formation (cvmodel_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_CB3D6C0146B405D4 (cvmodel_id), INDEX IDX_CB3D6C015200282E (formation_id), PRIMARY KEY(cvmodel_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_experience (cvmodel_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_29C222C546B405D4 (cvmodel_id), INDEX IDX_29C222C546E90E27 (experience_id), PRIMARY KEY(cvmodel_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_skill (cvmodel_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_7CC3A16A46B405D4 (cvmodel_id), INDEX IDX_7CC3A16A5585C142 (skill_id), PRIMARY KEY(cvmodel_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_language (cvmodel_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_172E25EF46B405D4 (cvmodel_id), INDEX IDX_172E25EF82F1BAF4 (language_id), PRIMARY KEY(cvmodel_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvmodel_social_medias (cvmodel_id INT NOT NULL, social_medias_id INT NOT NULL, INDEX IDX_698DB77446B405D4 (cvmodel_id), INDEX IDX_698DB774F5A2FA3C (social_medias_id), PRIMARY KEY(cvmodel_id, social_medias_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
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
        $this->addSql('DROP TABLE cvmodel_profil');
        $this->addSql('DROP TABLE cvmodel_formation');
        $this->addSql('DROP TABLE cvmodel_experience');
        $this->addSql('DROP TABLE cvmodel_skill');
        $this->addSql('DROP TABLE cvmodel_language');
        $this->addSql('DROP TABLE cvmodel_social_medias');
    }
}
