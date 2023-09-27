<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927144336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT fk_e00cedde84195be0');
        $this->addSql('DROP SEQUENCE chamber_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE dorm_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dorm (id INT NOT NULL, public_house_id INT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F88135C44E8349EA ON dorm (public_house_id)');
        $this->addSql('ALTER TABLE dorm ADD CONSTRAINT FK_F88135C44E8349EA FOREIGN KEY (public_house_id) REFERENCES public_house (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chamber DROP CONSTRAINT fk_4359e5ae4e8349ea');
        $this->addSql('DROP TABLE chamber');
        $this->addSql('ALTER TABLE bed ADD dorm_id INT NOT NULL');
        $this->addSql('ALTER TABLE bed ADD CONSTRAINT FK_E647FCFFC8698A54 FOREIGN KEY (dorm_id) REFERENCES dorm (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E647FCFFC8698A54 ON bed (dorm_id)');
        $this->addSql('DROP INDEX idx_e00cedde84195be0');
        $this->addSql('ALTER TABLE booking RENAME COLUMN chamber_id TO dorm_id');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEC8698A54 FOREIGN KEY (dorm_id) REFERENCES dorm (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E00CEDDEC8698A54 ON booking (dorm_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bed DROP CONSTRAINT FK_E647FCFFC8698A54');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDEC8698A54');
        $this->addSql('DROP SEQUENCE dorm_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE chamber_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chamber (id INT NOT NULL, public_house_id INT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4359e5ae4e8349ea ON chamber (public_house_id)');
        $this->addSql('ALTER TABLE chamber ADD CONSTRAINT fk_4359e5ae4e8349ea FOREIGN KEY (public_house_id) REFERENCES public_house (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dorm DROP CONSTRAINT FK_F88135C44E8349EA');
        $this->addSql('DROP TABLE dorm');
        $this->addSql('DROP INDEX IDX_E647FCFFC8698A54');
        $this->addSql('ALTER TABLE bed DROP dorm_id');
        $this->addSql('DROP INDEX IDX_E00CEDDEC8698A54');
        $this->addSql('ALTER TABLE booking RENAME COLUMN dorm_id TO chamber_id');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT fk_e00cedde84195be0 FOREIGN KEY (chamber_id) REFERENCES chamber (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e00cedde84195be0 ON booking (chamber_id)');
    }
}
