<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614144032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE currency_rates_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE currency_rates (id INT NOT NULL, last_update DATE NOT NULL, gbp NUMERIC(5, 4) NOT NULL, usd NUMERIC(5, 4) NOT NULL, aud NUMERIC(5, 4) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1336A95A1222B7A2 ON currency_rates (last_update)');
        $this->addSql('COMMENT ON COLUMN currency_rates.last_update IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE currency_rates_id_seq CASCADE');
        $this->addSql('DROP TABLE currency_rates');
    }
}
