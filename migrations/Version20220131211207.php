<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131211207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE datas_kits ADD reference_sap INT NOT NULL, ADD dsignation_sap VARCHAR(255) DEFAULT NULL, ADD tack_life DOUBLE PRECISION NOT NULL, ADD time_out DOUBLE PRECISION NOT NULL, ADD lot_sap INT DEFAULT NULL, ADD peremption_moins18 DATETIME NOT NULL, ADD adrap_av DATETIME NOT NULL, ADD acuir_av DATETIME NOT NULL, ADD decongel DATETIME NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD status TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BCEBA0C62F4E3F7 ON datas_kits (id_mm)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_6BCEBA0C62F4E3F7 ON datas_kits');
        $this->addSql('ALTER TABLE datas_kits DROP reference_sap, DROP dsignation_sap, DROP tack_life, DROP time_out, DROP lot_sap, DROP peremption_moins18, DROP adrap_av, DROP acuir_av, DROP decongel, DROP created_at, DROP update_at, DROP status, CHANGE id_mm id_mm VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
