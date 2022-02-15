<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214204231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE molding ADD created_by_id INT DEFAULT NULL, ADD modified_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE molding ADD CONSTRAINT FK_987F7B1B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE molding ADD CONSTRAINT FK_987F7B199049ECE FOREIGN KEY (modified_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_987F7B1B03A8386 ON molding (created_by_id)');
        $this->addSql('CREATE INDEX IDX_987F7B199049ECE ON molding (modified_by_id)');
        $this->addSql('ALTER TABLE molding_tool DROP TOOL_VERSION, DROP ID_PROGRAMME_AVION, DROP DATE_AJOUT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE datas_kits CHANGE id_mm id_mm VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE designation_sap designation_sap VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE molding DROP FOREIGN KEY FK_987F7B1B03A8386');
        $this->addSql('ALTER TABLE molding DROP FOREIGN KEY FK_987F7B199049ECE');
        $this->addSql('DROP INDEX IDX_987F7B1B03A8386 ON molding');
        $this->addSql('DROP INDEX IDX_987F7B199049ECE ON molding');
        $this->addSql('ALTER TABLE molding DROP created_by_id, DROP modified_by_id');
        $this->addSql('ALTER TABLE molding_tool ADD TOOL_VERSION INT NOT NULL, ADD ID_PROGRAMME_AVION INT NOT NULL, ADD DATE_AJOUT DATETIME NOT NULL, CHANGE designation designation VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identification identification VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
