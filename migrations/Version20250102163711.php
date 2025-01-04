<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250102163711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create refresh token table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE refresh_tokens (id SERIAL NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_refresh_token ON refresh_tokens (refresh_token)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE refresh_tokens');
    }
}
