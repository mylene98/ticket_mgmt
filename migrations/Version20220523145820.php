<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523145820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ticket (id INT NOT NULL, category_id INT NOT NULL, demandeur_id INT NOT NULL, assigned_to_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, affected_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, priority VARCHAR(255) NOT NULL, solution TEXT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97A0ADA312469DE2 ON ticket (category_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA395A6EE59 ON ticket (demandeur_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3F4BD7827 ON ticket (assigned_to_id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA395A6EE59 FOREIGN KEY (demandeur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F4BD7827 FOREIGN KEY (assigned_to_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ticket_id_seq CASCADE');
        $this->addSql('DROP TABLE ticket');
    }
}
