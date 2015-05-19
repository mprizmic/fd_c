<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150519154327 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE titulo_carrera (id INT AUTO_INCREMENT NOT NULL, carrera_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, nombre VARCHAR(150) NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_955288BAC671B40F (carrera_id), INDEX IDX_955288BA9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE titulo_carrera ADD CONSTRAINT FK_955288BAC671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id)");
        $this->addSql("ALTER TABLE titulo_carrera ADD CONSTRAINT FK_955288BA9F5A440B FOREIGN KEY (estado_id) REFERENCES estado_carrera (id)");
        $this->addSql("DROP TABLE titulo");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE titulo (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, carrera_id INT DEFAULT NULL, nombre VARCHAR(150) NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_17713E5A9F5A440B (estado_id), INDEX IDX_17713E5AC671B40F (carrera_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE titulo ADD CONSTRAINT FK_17713E5A9F5A440B FOREIGN KEY (estado_id) REFERENCES estado_carrera (id)");
        $this->addSql("ALTER TABLE titulo ADD CONSTRAINT FK_17713E5AC671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id)");
        $this->addSql("DROP TABLE titulo_carrera");
    }
}
