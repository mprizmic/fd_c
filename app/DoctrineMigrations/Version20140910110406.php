<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140910110406 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE unidadoferta_turno (id INT AUTO_INCREMENT NOT NULL, unidad_oferta_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, INDEX IDX_59229137D1F42FF (unidad_oferta_id), INDEX IDX_5922913769C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE unidadoferta_turno ADD CONSTRAINT FK_59229137D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)");
        $this->addSql("ALTER TABLE unidadoferta_turno ADD CONSTRAINT FK_5922913769C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
//        $this->addSql("DROP TABLE lexik_maintenance");
//        $this->addSql("DROP TABLE tabla_administrada");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("CREATE TABLE tabla_administrada (id INT AUTO_INCREMENT NOT NULL, tabla VARCHAR(100) NOT NULL, url VARCHAR(200) NOT NULL, descripcion VARCHAR(200) DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE unidadoferta_turno");
    }
}
