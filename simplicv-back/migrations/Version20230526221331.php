<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526221331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cover_letter_model_cover_letter (cover_letter_model_id INT NOT NULL, cover_letter_id INT NOT NULL, INDEX IDX_F85832EC2A877529 (cover_letter_model_id), INDEX IDX_F85832ECB944729C (cover_letter_id), PRIMARY KEY(cover_letter_model_id, cover_letter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cover_letter_model_cover_letter ADD CONSTRAINT FK_F85832EC2A877529 FOREIGN KEY (cover_letter_model_id) REFERENCES cover_letter_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cover_letter_model_cover_letter ADD CONSTRAINT FK_F85832ECB944729C FOREIGN KEY (cover_letter_id) REFERENCES cover_letter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cover_letter_model DROP FOREIGN KEY FK_5621F66EB944729C');
        $this->addSql('DROP INDEX IDX_5621F66EB944729C ON cover_letter_model');
        $this->addSql('ALTER TABLE cover_letter_model DROP cover_letter_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cover_letter_model_cover_letter DROP FOREIGN KEY FK_F85832EC2A877529');
        $this->addSql('ALTER TABLE cover_letter_model_cover_letter DROP FOREIGN KEY FK_F85832ECB944729C');
        $this->addSql('DROP TABLE cover_letter_model_cover_letter');
        $this->addSql('ALTER TABLE cover_letter_model ADD cover_letter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cover_letter_model ADD CONSTRAINT FK_5621F66EB944729C FOREIGN KEY (cover_letter_id) REFERENCES cover_letter_model (id)');
        $this->addSql('CREATE INDEX IDX_5621F66EB944729C ON cover_letter_model (cover_letter_id)');
    }
}
