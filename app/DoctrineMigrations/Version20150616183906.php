<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150616183906 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE inspector (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(25) NOT NULL, apellido VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, te VARCHAR(30) NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, UNIQUE INDEX UNIQ_72DD518BE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("CREATE TABLE turno_unidad_educativa (id INT AUTO_INCREMENT NOT NULL, unidad_educativa_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, INDEX IDX_167633EABF20CF2F (unidad_educativa_id), INDEX IDX_167633EA69C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
//        $this->addSql("ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EABF20CF2F FOREIGN KEY (unidad_educativa_id) REFERENCES unidad_educativa (id)");
//        $this->addSql("ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EA69C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE inspector");
//        $this->addSql("DROP TABLE turno_unidad_educativa");
    }
}
