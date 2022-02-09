<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209135102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE molding (id INT AUTO_INCREMENT NOT NULL, mat_polym_id INT NOT NULL, mat_drap_id INT NOT NULL, molding_day DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', acuire_av DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', adraper_av DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_987F7B142D9ACB (mat_polym_id), INDEX IDX_987F7B180D55051 (mat_drap_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE molding_dataskits (molding_id INT NOT NULL, dataskits_id INT NOT NULL, INDEX IDX_A51DEC7B8AFC30E7 (molding_id), INDEX IDX_A51DEC7B1D2CED44 (dataskits_id), PRIMARY KEY(molding_id, dataskits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE molding ADD CONSTRAINT FK_987F7B142D9ACB FOREIGN KEY (mat_polym_id) REFERENCES datas_kits (id)');
        $this->addSql('ALTER TABLE molding ADD CONSTRAINT FK_987F7B180D55051 FOREIGN KEY (mat_drap_id) REFERENCES datas_kits (id)');
        $this->addSql('ALTER TABLE molding_dataskits ADD CONSTRAINT FK_A51DEC7B8AFC30E7 FOREIGN KEY (molding_id) REFERENCES molding (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE molding_dataskits ADD CONSTRAINT FK_A51DEC7B1D2CED44 FOREIGN KEY (dataskits_id) REFERENCES datas_kits (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE molding_dataskits DROP FOREIGN KEY FK_A51DEC7B8AFC30E7');
        $this->addSql('DROP TABLE molding');
        $this->addSql('DROP TABLE molding_dataskits');
        $this->addSql('ALTER TABLE datas_kits CHANGE id_mm id_mm VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE designation_sap designation_sap VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
