<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927143305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bed (id INT NOT NULL, booked BOOLEAN NOT NULL, better_blanket BOOLEAN NOT NULL, better_pillow BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE dorm DROP remaining_beds');
        $this->addSql('ALTER TABLE dorm DROP occupied_beds');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bed_id_seq CASCADE');
        $this->addSql('DROP TABLE bed');
        $this->addSql('ALTER TABLE dorm ADD remaining_beds INT NOT NULL');
        $this->addSql('ALTER TABLE dorm ADD occupied_beds INT NOT NULL');
    }
}
