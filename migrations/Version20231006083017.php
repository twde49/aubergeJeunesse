<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006083017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE bed ADD dorm_id INT NOT NULL');
        $this->addSql('ALTER TABLE bed DROP better_blanket');
        $this->addSql('ALTER TABLE bed DROP better_pillow');
        $this->addSql('ALTER TABLE bed ADD CONSTRAINT FK_E647FCFFC8698A54 FOREIGN KEY (dorm_id) REFERENCES dorm (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E647FCFFC8698A54 ON bed (dorm_id)');
        $this->addSql('ALTER TABLE booking ADD of_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD better_pillow BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE booking ADD better_blanket BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE booking DROP price_per_night');
        $this->addSql('ALTER TABLE booking ALTER arrived_date TYPE DATE');
        $this->addSql('ALTER TABLE booking ALTER leaving_date TYPE DATE');
        $this->addSql('COMMENT ON COLUMN booking.arrived_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN booking.leaving_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE5A1B2224 FOREIGN KEY (of_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E00CEDDE5A1B2224 ON booking (of_user_id)');
        $this->addSql('ALTER INDEX idx_e00cedde84195be0 RENAME TO IDX_E00CEDDEC8698A54');
        $this->addSql('ALTER TABLE dorm ADD price_per_night DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER INDEX idx_4359e5ae4e8349ea RENAME TO IDX_F88135C44E8349EA');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE5A1B2224');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE dorm DROP price_per_night');
        $this->addSql('ALTER INDEX idx_f88135c44e8349ea RENAME TO idx_4359e5ae4e8349ea');
        $this->addSql('ALTER TABLE bed DROP CONSTRAINT FK_E647FCFFC8698A54');
        $this->addSql('DROP INDEX IDX_E647FCFFC8698A54');
        $this->addSql('ALTER TABLE bed ADD better_blanket BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE bed ADD better_pillow BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE bed DROP dorm_id');
        $this->addSql('DROP INDEX IDX_E00CEDDE5A1B2224');
        $this->addSql('ALTER TABLE booking ADD price_per_night DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE booking DROP of_user_id');
        $this->addSql('ALTER TABLE booking DROP better_pillow');
        $this->addSql('ALTER TABLE booking DROP better_blanket');
        $this->addSql('ALTER TABLE booking ALTER arrived_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE booking ALTER leaving_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN booking.arrived_date IS NULL');
        $this->addSql('COMMENT ON COLUMN booking.leaving_date IS NULL');
        $this->addSql('ALTER INDEX idx_e00ceddec8698a54 RENAME TO idx_e00cedde84195be0');
    }
}
