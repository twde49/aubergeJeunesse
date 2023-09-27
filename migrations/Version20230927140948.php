<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927140948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE district_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE district (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE public_house ADD district_id INT NOT NULL');
        $this->addSql('ALTER TABLE public_house ADD CONSTRAINT FK_967A869DB08FA272 FOREIGN KEY (district_id) REFERENCES district (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_967A869DB08FA272 ON public_house (district_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE public_house DROP CONSTRAINT FK_967A869DB08FA272');
        $this->addSql('DROP SEQUENCE district_id_seq CASCADE');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP INDEX IDX_967A869DB08FA272');
        $this->addSql('ALTER TABLE public_house DROP district_id');
    }
}
