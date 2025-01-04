<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103192323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create work entry table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE work_entry (id UUID NOT NULL, user_id UUID NOT NULL, start_date TIMESTAMP WITH TIME ZONE NOT NULL, end_date TIMESTAMP WITH TIME ZONE, created_at TIMESTAMP WITH TIME ZONE NOT NULL, updated_at TIMESTAMP WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP WITH TIME ZONE, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX work_entry_user_id ON work_entry (user_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE work_entry');
    }
}
