<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515082604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs // we need to add a default else it wouldn't work
        $this->addSql("ALTER TABLE product ADD created_at DATETIME NOT NULL DEFAULT '0000-01-01 00:00:00', ADD updtaed_at DATETIME NOT NULL DEFAULT '0000-01-01 00:00:00'");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP path');
        $this->addSql('ALTER TABLE product DROP created_at, DROP updtaed_at');
    }
}
