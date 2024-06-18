<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618194404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create users, message_contexts and messages table';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\SQLitePlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\SQLitePlatform'."
        );

        $this->addSql('CREATE TABLE message_contexts (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_A5770AA4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A5770AA4A76ED395 ON message_contexts (user_id)');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\SQLitePlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\SQLitePlatform'."
        );

        $this->addSql('CREATE TABLE messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(255) NOT NULL COLLATE "BINARY", content VARCHAR(255) NOT NULL COLLATE "BINARY", created_at DATETIME NOT NULL, message_context_id INTEGER NOT NULL, CONSTRAINT FK_DB021E96A4D0ED50 FOREIGN KEY (message_context_id) REFERENCES message_contexts (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DB021E96A4D0ED50 ON messages (message_context_id)');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\SQLitePlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\SQLitePlatform'."
        );

        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nickname VARCHAR(255) NOT NULL COLLATE "BINARY", registered_at DATETIME NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\SQLitePlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\SQLitePlatform'."
        );

        $this->addSql('DROP TABLE message_contexts');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\SQLitePlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\SQLitePlatform'."
        );

        $this->addSql('DROP TABLE messages');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\SQLitePlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\SQLitePlatform'."
        );

        $this->addSql('DROP TABLE users');
    }
}
