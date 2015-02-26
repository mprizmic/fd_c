<?php
/**
 * esta migración es para actualizar la base de producción del proxmox ("Fd") copiada locamente como ("Fdprod").
 * La base de desarrollo local ("Fd") ya tiene estas modificaciones
 * Localmente queda como Fd pero es copia aggiornada de Fd de producción en proxmox
 */
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140915094829 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE unidadoferta_turno (id INT AUTO_INCREMENT NOT NULL, unidad_oferta_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, INDEX IDX_59229137D1F42FF (unidad_oferta_id), INDEX IDX_5922913769C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE primario_x (id INT AUTO_INCREMENT NOT NULL, unidad_oferta_id INT DEFAULT NULL, matricula INT DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, UNIQUE INDEX UNIQ_C8B17359D1F42FF (unidad_oferta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE unidadoferta_turno ADD CONSTRAINT FK_59229137D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)");
        $this->addSql("ALTER TABLE unidadoferta_turno ADD CONSTRAINT FK_5922913769C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
        $this->addSql("ALTER TABLE primario_x ADD CONSTRAINT FK_C8B17359D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)");
//        $this->addSql("DROP TABLE lexik_maintenance");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD CONSTRAINT FK_D4968F6271B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento (id)");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD CONSTRAINT FK_D4968F62E52B6C4E FOREIGN KEY (recurso_id) REFERENCES recurso (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE unidadoferta_turno");
        $this->addSql("DROP TABLE primario_x");
        $this->addSql("ALTER TABLE establecimiento_recurso DROP FOREIGN KEY FK_D4968F6271B61351");
        $this->addSql("ALTER TABLE establecimiento_recurso DROP FOREIGN KEY FK_D4968F62E52B6C4E");
    }
}
