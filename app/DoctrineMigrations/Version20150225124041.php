<?php
/**
 * MIGRACION
 * Elimina la unidad educativa de la tabla unidad_oferta.
 * Esto hay que correrlo luego de la migracion.
 */
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150225124041 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE turno_unidad_educativa (id INT AUTO_INCREMENT NOT NULL, unidad_educativa_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, INDEX IDX_167633EABF20CF2F (unidad_educativa_id), INDEX IDX_167633EA69C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EABF20CF2F FOREIGN KEY (unidad_educativa_id) REFERENCES unidad_educativa (id)");
        $this->addSql("ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EA69C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
        $this->addSql("ALTER TABLE unidad_oferta DROP FOREIGN KEY FK_95C6F11DBF20CF2F");
        $this->addSql("DROP INDEX IDX_95C6F11DBF20CF2F ON unidad_oferta");
        $this->addSql("ALTER TABLE unidad_oferta DROP unidad_educativa_id");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE turno_unidad_educativa");
        $this->addSql("ALTER TABLE unidad_oferta ADD unidad_educativa_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE unidad_oferta ADD CONSTRAINT FK_95C6F11DBF20CF2F FOREIGN KEY (unidad_educativa_id) REFERENCES unidad_educativa (id)");
        $this->addSql("CREATE INDEX IDX_95C6F11DBF20CF2F ON unidad_oferta (unidad_educativa_id)");
    }
}
