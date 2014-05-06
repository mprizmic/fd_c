<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140429125345 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE primario_x (id INT AUTO_INCREMENT NOT NULL, unidad_oferta_id INT DEFAULT NULL, matricula INT DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, UNIQUE INDEX UNIQ_C8B17359D1F42FF (unidad_oferta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE primario_x ADD CONSTRAINT FK_C8B17359D1F42FF FOREIGN KEY (unidad_oferta_id) REFERENCES unidad_oferta (id)");
//        $this->addSql("DROP TABLE lexik_maintenance");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE primario_x");
    }
}
