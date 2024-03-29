<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304175947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE test_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE weather_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE test_data (id INT NOT NULL, station_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE weather_data (id INT NOT NULL, station_id VARCHAR(255) NOT NULL, observed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, parameter_id VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, coordinates VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE test_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE weather_data_id_seq CASCADE');
        $this->addSql('DROP TABLE test_data');
        $this->addSql('DROP TABLE weather_data');
    }
}
