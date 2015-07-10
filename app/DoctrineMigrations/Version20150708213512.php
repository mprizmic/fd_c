<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150708213512 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE secundario_x (id INT AUTO_INCREMENT NOT NULL, unidad_oferta_id INT DEFAULT NULL, matricula INT DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, UNIQUE INDEX UNIQ_151CAFD6D1F42FF (unidad_oferta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secundario (id INT AUTO_INCREMENT NOT NULL, oferta_educativa_id INT DEFAULT NULL, nombre VARCHAR(50) DEFAULT NULL, titulo VARCHAR(50) DEFAULT NULL, duracion VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_EBA5F50A15CE31DF (oferta_educativa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secundario_x ADD CONSTRAINT FK_151CAFD6D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)');
        $this->addSql('ALTER TABLE secundario ADD CONSTRAINT FK_EBA5F50A15CE31DF FOREIGN KEY (oferta_educativa_id) REFERENCES oferta_educativa (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE secundario_x');
        $this->addSql('DROP TABLE secundario');
    }
}
