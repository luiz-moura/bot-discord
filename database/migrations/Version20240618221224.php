<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618221224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users ADD COLUMN discord_id INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TEMPORARY TABLE __temp__users AS SELECT id, nickname, registered_at FROM users');
        $this->addSql('DROP TABLE users');
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nickname VARCHAR(255) NOT NULL, registered_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO users (id, nickname, registered_at) SELECT id, nickname, registered_at FROM __temp__users');
        $this->addSql('DROP TABLE __temp__users');
    }
}
