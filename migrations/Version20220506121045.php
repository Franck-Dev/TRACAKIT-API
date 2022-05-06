<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506121045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE molding DROP FOREIGN KEY FK_987F7B11714266E');
        $this->addSql('DROP INDEX IDX_987F7B11714266E ON molding');
        $this->addSql('ALTER TABLE molding ADD outillage VARCHAR(255) NOT NULL, DROP outillage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE datas_kits CHANGE id_mm id_mm VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE designation_sap designation_sap VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE molding ADD outillage_id INT DEFAULT NULL, DROP outillage, CHANGE created_by created_by VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE modified_by modified_by VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE molding ADD CONSTRAINT FK_987F7B11714266E FOREIGN KEY (outillage_id) REFERENCES molding_tool (id)');
        $this->addSql('CREATE INDEX IDX_987F7B11714266E ON molding (outillage_id)');
        $this->addSql('ALTER TABLE molding_tool CHANGE designation designation VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identification identification VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
