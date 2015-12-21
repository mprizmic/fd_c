<?php
/**
 * 
 * con problemas 
 * 
 * 
 * 
 * 
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151014171637 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        //el indice tiene distinto nro
//        $this->addSql("ALTER TABLE autoridad DROP FOREIGN KEY FK_14FFC077418D0677");

        //el indice tiene distinto nro
//        $this->addSql("ALTER TABLE unidad_educativa DROP FOREIGN KEY FK_27515E80418D0677");

        $this->addSql("CREATE TABLE dependencia (id INT AUTO_INCREMENT NOT NULL, nivel_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, codigo VARCHAR(10) NOT NULL, nombre VARCHAR(150) NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_D23000C8DA3426AE (nivel_id), INDEX IDX_D23000C869C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE cargo (id INT AUTO_INCREMENT NOT NULL, nivel_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, codigo VARCHAR(10) NOT NULL, nombre VARCHAR(150) NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_3BEE5771DA3426AE (nivel_id), INDEX IDX_3BEE577169C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE dependencia ADD CONSTRAINT FK_D23000C8DA3426AE FOREIGN KEY (nivel_id) REFERENCES nivel (id)");
        $this->addSql("ALTER TABLE dependencia ADD CONSTRAINT FK_D23000C869C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
        $this->addSql("ALTER TABLE cargo ADD CONSTRAINT FK_3BEE5771DA3426AE FOREIGN KEY (nivel_id) REFERENCES nivel (id)");
        $this->addSql("ALTER TABLE cargo ADD CONSTRAINT FK_3BEE577169C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
        
        //esta tabla la borre a mano
//        $this->addSql("DROP TABLE cargo_autoridad");
        $this->addSql("DROP INDEX IDX_14FFC077418D0677 ON autoridad");
        $this->addSql("ALTER TABLE autoridad CHANGE cargo_autoridad_id cargo_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE autoridad ADD CONSTRAINT FK_14FFC077813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id)");
        $this->addSql("CREATE INDEX IDX_14FFC077813AC380 ON autoridad (cargo_id)");
        $this->addSql("DROP INDEX IDX_27515E80418D0677 ON unidad_educativa");
        $this->addSql("ALTER TABLE unidad_educativa DROP cargo_autoridad_id, DROP nombre_autoridad");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE autoridad DROP FOREIGN KEY FK_14FFC077813AC380");
        $this->addSql("CREATE TABLE cargo_autoridad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) DEFAULT NULL, abreviatura VARCHAR(5) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE dependencia");
        $this->addSql("DROP TABLE cargo");
        $this->addSql("DROP INDEX IDX_14FFC077813AC380 ON autoridad");
        $this->addSql("ALTER TABLE autoridad CHANGE cargo_id cargo_autoridad_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE autoridad ADD CONSTRAINT FK_14FFC077418D0677 FOREIGN KEY (cargo_autoridad_id) REFERENCES cargo_autoridad (id)");
        $this->addSql("CREATE INDEX IDX_14FFC077418D0677 ON autoridad (cargo_autoridad_id)");
        $this->addSql("ALTER TABLE unidad_educativa ADD cargo_autoridad_id INT DEFAULT NULL, ADD nombre_autoridad VARCHAR(50) DEFAULT NULL");
        $this->addSql("ALTER TABLE unidad_educativa ADD CONSTRAINT FK_27515E80418D0677 FOREIGN KEY (cargo_autoridad_id) REFERENCES cargo_autoridad (id)");
        $this->addSql("CREATE INDEX IDX_27515E80418D0677 ON unidad_educativa (cargo_autoridad_id)");
    }
}
