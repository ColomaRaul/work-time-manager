<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250102074834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Configure authorization user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE auth_user (id UUID NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role varchar(255) NOT NULL, created_at TIMESTAMP WITH TIME ZONE NOT NULL, updated_at TIMESTAMP WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP WITH TIME ZONE, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_auth_user_email ON auth_user (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE auth_user');
    }
}
