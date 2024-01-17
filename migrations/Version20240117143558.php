<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117143558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE aisshptype');
        $this->addSql('ALTER TABLE aisshiptype CHANGE aisshptype aisshiptype INT NOT NULL');
        $this->addSql('ALTER TABLE navire ADD idpays INT NOT NULL, CHANGE nom nom VARCHAR(100) NOT NULL, CHANGE eta eta DATETIME DEFAULT NULL, CHANGE tirantdeau tirantdeau INT NOT NULL, CHANGE indicatifAppel indicatif_appel VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038C54C8C93 FOREIGN KEY (type_id) REFERENCES aisshiptype (id)');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038E750CD0E FOREIGN KEY (idpays) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_EED1038E750CD0E ON navire (idpays)');
        $this->addSql('ALTER TABLE navire RENAME INDEX ind_mmst TO ind_MMSI');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB39F5FA88 FOREIGN KEY (idaisshiptype) REFERENCES aisshiptype (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aisshptype (id INT AUTO_INCREMENT NOT NULL, aisshptype INT NOT NULL, libelle VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE aisshiptype CHANGE aisshiptype aisshptype INT NOT NULL');
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED1038C54C8C93');
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED1038E750CD0E');
        $this->addSql('DROP INDEX IDX_EED1038E750CD0E ON navire');
        $this->addSql('ALTER TABLE navire DROP idpays, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE eta eta VARCHAR(255) NOT NULL, CHANGE tirantdeau tirantdeau DOUBLE PRECISION NOT NULL, CHANGE indicatif_appel indicatifAppel VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE navire RENAME INDEX ind_mmsi TO ind_MMST');
        $this->addSql('ALTER TABLE porttypecompatible DROP FOREIGN KEY FK_2C02FFDB39F5FA88');
    }
}
