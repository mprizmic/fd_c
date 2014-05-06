<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140422151901 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE establecimiento_recurso (id INT AUTO_INCREMENT NOT NULL, establecimiento_id INT DEFAULT NULL, recurso_id INT DEFAULT NULL, cantidad INT NOT NULL, INDEX IDX_D4968F6271B61351 (establecimiento_id), INDEX IDX_D4968F62E52B6C4E (recurso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE recurso (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(5) NOT NULL, descripcion VARCHAR(50) NOT NULL, orden INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE carrera_estado_validez (id INT AUTO_INCREMENT NOT NULL, carrera_id INT DEFAULT NULL, estado_validez_id INT DEFAULT NULL, fecha_estado_validez DATE DEFAULT NULL, createdAt DATETIME NOT NULL, INDEX IDX_77A76A5C671B40F (carrera_id), INDEX IDX_77A76A52C22C346 (estado_validez_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD CONSTRAINT FK_D4968F6271B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento (id)");
        $this->addSql("ALTER TABLE establecimiento_recurso ADD CONSTRAINT FK_D4968F62E52B6C4E FOREIGN KEY (recurso_id) REFERENCES recurso (id)");
        $this->addSql("ALTER TABLE carrera_estado_validez ADD CONSTRAINT FK_77A76A5C671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id)");
        $this->addSql("ALTER TABLE carrera_estado_validez ADD CONSTRAINT FK_77A76A52C22C346 FOREIGN KEY (estado_validez_id) REFERENCES estado_validez (id)");
//        $this->addSql("DROP TABLE lexik_maintenance");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE establecimiento_recurso DROP FOREIGN KEY FK_D4968F62E52B6C4E");
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE establecimiento_recurso");
        $this->addSql("DROP TABLE recurso");
        $this->addSql("DROP TABLE carrera_estado_validez");
    }
}
