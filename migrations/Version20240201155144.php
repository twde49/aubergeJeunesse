<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201155144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE profile (id INT NOT NULL, related_to_id INT NOT NULL, nickname TEXT NOT NULL, first_name TEXT NOT NULL, last_name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0F40B4AC4E ON profile (related_to_id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F40B4AC4E FOREIGN KEY (related_to_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE profile_id_seq CASCADE');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0F40B4AC4E');
        $this->addSql('DROP TABLE profile');
    }
}
