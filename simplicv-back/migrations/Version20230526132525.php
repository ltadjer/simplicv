<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526132525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10346B405D4');
        $this->addSql('DROP INDEX IDX_590C10346B405D4 ON experience');
        $this->addSql('ALTER TABLE experience DROP cvmodel_id');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF46B405D4');
        $this->addSql('DROP INDEX IDX_404021BF46B405D4 ON formation');
        $this->addSql('ALTER TABLE formation DROP cvmodel_id');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B546B405D4');
        $this->addSql('DROP INDEX IDX_D4DB71B546B405D4 ON language');
        $this->addSql('ALTER TABLE language DROP cvmodel_id');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29746B405D4');
        $this->addSql('DROP INDEX IDX_E6D6B29746B405D4 ON profil');
        $this->addSql('ALTER TABLE profil DROP cvmodel_id');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47746B405D4');
        $this->addSql('DROP INDEX IDX_5E3DE47746B405D4 ON skill');
        $this->addSql('ALTER TABLE skill DROP cvmodel_id');
        $this->addSql('ALTER TABLE social_medias DROP FOREIGN KEY FK_C99CD5D46B405D4');
        $this->addSql('DROP INDEX IDX_C99CD5D46B405D4 ON social_medias');
        $this->addSql('ALTER TABLE social_medias DROP cvmodel_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience ADD cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10346B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_590C10346B405D4 ON experience (cvmodel_id)');
        $this->addSql('ALTER TABLE formation ADD cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_404021BF46B405D4 ON formation (cvmodel_id)');
        $this->addSql('ALTER TABLE language ADD cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B546B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_D4DB71B546B405D4 ON language (cvmodel_id)');
        $this->addSql('ALTER TABLE profil ADD cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29746B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_E6D6B29746B405D4 ON profil (cvmodel_id)');
        $this->addSql('ALTER TABLE skill ADD cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47746B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE47746B405D4 ON skill (cvmodel_id)');
        $this->addSql('ALTER TABLE social_medias ADD cvmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_medias ADD CONSTRAINT FK_C99CD5D46B405D4 FOREIGN KEY (cvmodel_id) REFERENCES cvmodel (id)');
        $this->addSql('CREATE INDEX IDX_C99CD5D46B405D4 ON social_medias (cvmodel_id)');
    }
}
