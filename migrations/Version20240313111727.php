<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313111727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country_code VARCHAR(2) NOT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');

        $this->addSql("INSERT INTO location(name, country_code, latitude, longitude ) VALUES ('Barcelona', 'ES', 41.390205, 2.154007  ) ");
        $this->addSql("INSERT INTO location(name, country_code, latitude, longitude ) VALUES ('Berlin', 'DE', 52.52, 13.405  ) ");
        $this->addSql("INSERT INTO location(name, country_code, latitude, longitude ) VALUES ('Paris', 'FR', 48.8566, 2.3522  ) ");
        $this->addSql("INSERT INTO location(name, country_code, latitude, longitude ) VALUES ('Warsaw', 'PL', 52.2297, 21.0122  ) ");
        $this->addSql("INSERT INTO location(name, country_code, latitude, longitude ) VALUES ('Delhi', 'IN', 28.7041, 77.1025 ) ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
