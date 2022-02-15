<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214141832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE molding ADD outillage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE molding ADD CONSTRAINT FK_987F7B11714266E FOREIGN KEY (outillage_id) REFERENCES molding_tool (id)');
        $this->addSql('CREATE INDEX IDX_987F7B11714266E ON molding (outillage_id)');
        $this->addSql('ALTER TABLE molding_datas_kits DROP INDEX IDX_A51DEC7B1D2CED44, ADD INDEX IDX_796B0A7ADAD95BA (datas_kits_id)');
        $this->addSql('ALTER TABLE molding_datas_kits DROP FOREIGN KEY FK_A51DEC7B8AFC30E7');
        $this->addSql('DROP INDEX idx_a51dec7b8afc30e7 ON molding_datas_kits');
        $this->addSql('CREATE INDEX IDX_796B0A7A8AFC30E7 ON molding_datas_kits (molding_id)');
        $this->addSql('ALTER TABLE molding_datas_kits ADD CONSTRAINT FK_A51DEC7B8AFC30E7 FOREIGN KEY (molding_id) REFERENCES molding (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E78F73CBD7DC630 ON molding_tool (sap_tool_number)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E78F73C49E7720D ON molding_tool (identification)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE datas_kits CHANGE id_mm id_mm VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE designation_sap designation_sap VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE molding DROP FOREIGN KEY FK_987F7B11714266E');
        $this->addSql('DROP INDEX IDX_987F7B11714266E ON molding');
        $this->addSql('ALTER TABLE molding DROP outillage_id');
        $this->addSql('ALTER TABLE molding_datas_kits DROP INDEX IDX_796B0A7ADAD95BA, ADD UNIQUE INDEX IDX_A51DEC7B1D2CED44 (datas_kits_id)');
        $this->addSql('ALTER TABLE molding_datas_kits DROP FOREIGN KEY FK_796B0A7A8AFC30E7');
        $this->addSql('DROP INDEX idx_796b0a7a8afc30e7 ON molding_datas_kits');
        $this->addSql('CREATE INDEX IDX_A51DEC7B8AFC30E7 ON molding_datas_kits (molding_id)');
        $this->addSql('ALTER TABLE molding_datas_kits ADD CONSTRAINT FK_796B0A7A8AFC30E7 FOREIGN KEY (molding_id) REFERENCES molding (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_7E78F73CBD7DC630 ON molding_tool');
        $this->addSql('DROP INDEX UNIQ_7E78F73C49E7720D ON molding_tool');
        $this->addSql('ALTER TABLE molding_tool CHANGE designation designation VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identification identification VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
