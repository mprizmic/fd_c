<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150713160507 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE turno_unidad_educativa (id INT AUTO_INCREMENT NOT NULL, unidad_educativa_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, INDEX IDX_167633EABF20CF2F (unidad_educativa_id), INDEX IDX_167633EA69C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EABF20CF2F FOREIGN KEY (unidad_educativa_id) REFERENCES unidad_educativa (id)");
//        $this->addSql("ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EA69C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
        $this->addSql("ALTER TABLE secundario_x ADD anio_inicio INT DEFAULT NULL");
        $this->addSql("ALTER TABLE media_orientaciones ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL, CHANGE nombre nombre VARCHAR(250) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("DROP TABLE turno_unidad_educativa");
        $this->addSql("ALTER TABLE media_orientaciones DROP actualizado, DROP creado, CHANGE nombre nombre VARCHAR(150) NOT NULL");
        $this->addSql("ALTER TABLE secundario_x DROP anio_inicio");
    }
}
