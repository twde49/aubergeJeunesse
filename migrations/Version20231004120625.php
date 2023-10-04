<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004120625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD of_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ALTER arrived_date TYPE DATE');
        $this->addSql('ALTER TABLE booking ALTER leaving_date TYPE DATE');
        $this->addSql('COMMENT ON COLUMN booking.arrived_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN booking.leaving_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE5A1B2224 FOREIGN KEY (of_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E00CEDDE5A1B2224 ON booking (of_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE5A1B2224');
        $this->addSql('DROP INDEX IDX_E00CEDDE5A1B2224');
        $this->addSql('ALTER TABLE booking DROP of_user_id');
        $this->addSql('ALTER TABLE booking ALTER arrived_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE booking ALTER leaving_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN booking.arrived_date IS NULL');
        $this->addSql('COMMENT ON COLUMN booking.leaving_date IS NULL');
    }
}
