<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218092606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navire ADD type_id INT NOT NULL, ADD longueur INT NOT NULL, ADD largeur INT NOT NULL, ADD tirantdeau DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038C54C8C93 FOREIGN KEY (type_id) REFERENCES aisshptype (id)');
        $this->addSql('CREATE INDEX IDX_EED1038C54C8C93 ON navire (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED1038C54C8C93');
        $this->addSql('DROP INDEX IDX_EED1038C54C8C93 ON navire');
        $this->addSql('ALTER TABLE navire DROP type_id, DROP longueur, DROP largeur, DROP tirantdeau');
    }
}
