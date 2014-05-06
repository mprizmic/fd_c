<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140311143020 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE titulo (id INT AUTO_INCREMENT NOT NULL, carrera_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, estado_validez_id INT DEFAULT NULL, nombre VARCHAR(150) NOT NULL, fecha_estado_validez DATE DEFAULT NULL, validez_desde DATE DEFAULT NULL, validez_hasta DATE DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_17713E5AC671B40F (carrera_id), INDEX IDX_17713E5A9F5A440B (estado_id), INDEX IDX_17713E5A2C22C346 (estado_validez_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE titulo_estado_validez (id INT AUTO_INCREMENT NOT NULL, titulo_id INT DEFAULT NULL, estado_validez_id INT DEFAULT NULL, fecha_estado_validez DATE DEFAULT NULL, validez_desde DATE DEFAULT NULL, validez_hasta DATE DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_44057B5561AD3496 (titulo_id), INDEX IDX_44057B552C22C346 (estado_validez_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE titulo ADD CONSTRAINT FK_17713E5AC671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id)");
        $this->addSql("ALTER TABLE titulo ADD CONSTRAINT FK_17713E5A9F5A440B FOREIGN KEY (estado_id) REFERENCES estado_carrera (id)");
        $this->addSql("ALTER TABLE titulo ADD CONSTRAINT FK_17713E5A2C22C346 FOREIGN KEY (estado_validez_id) REFERENCES estado_validez (id)");
        $this->addSql("ALTER TABLE titulo_estado_validez ADD CONSTRAINT FK_44057B5561AD3496 FOREIGN KEY (titulo_id) REFERENCES titulo (id)");
        $this->addSql("ALTER TABLE titulo_estado_validez ADD CONSTRAINT FK_44057B552C22C346 FOREIGN KEY (estado_validez_id) REFERENCES estado_validez (id)");
//        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE carrera DROP FOREIGN KEY FK_CF1ECD302C22C346");
        $this->addSql("DROP INDEX IDX_CF1ECD302C22C346 ON carrera");
        $this->addSql("ALTER TABLE carrera DROP estado_validez_id, DROP titulo, DROP fecha_estado_validez, DROP validez_desde, DROP validez_hasta");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE titulo_estado_validez DROP FOREIGN KEY FK_44057B5561AD3496");
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE titulo");
        $this->addSql("DROP TABLE titulo_estado_validez");
        $this->addSql("ALTER TABLE carrera ADD estado_validez_id INT DEFAULT NULL, ADD titulo VARCHAR(150) DEFAULT NULL, ADD fecha_estado_validez DATE DEFAULT NULL, ADD validez_desde DATE DEFAULT NULL, ADD validez_hasta DATE DEFAULT NULL");
        $this->addSql("ALTER TABLE carrera ADD CONSTRAINT FK_CF1ECD302C22C346 FOREIGN KEY (estado_validez_id) REFERENCES estado_validez (id)");
        $this->addSql("CREATE INDEX IDX_CF1ECD302C22C346 ON carrera (estado_validez_id)");
    }
}
