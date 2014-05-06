<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140327165621 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE acto_publico (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, fecha DATE NOT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE llamado (id INT AUTO_INCREMENT NOT NULL, establecimiento_id INT DEFAULT NULL, caracter_id INT DEFAULT NULL, motivo_id INT DEFAULT NULL, cargo VARCHAR(50) NOT NULL, horario TIME NOT NULL, anio VARCHAR(255) DEFAULT NULL, division VARCHAR(10) DEFAULT NULL, iniciacion DATE NOT NULL, terminacion DATE DEFAULT NULL, continuidad_pedagogica VARCHAR(2) DEFAULT NULL, actualizado DATETIME NOT NULL, creado DATETIME NOT NULL, INDEX IDX_56DB349071B61351 (establecimiento_id), INDEX IDX_56DB34907D89F04A (caracter_id), INDEX IDX_56DB3490F9E584F8 (motivo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE caracter (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(3) NOT NULL, descripcion VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE resultado (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(3) NOT NULL, descripcion VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE licencia (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(10) NOT NULL, descripcion VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE vacancia (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(15) NOT NULL, descripcion VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE llamado ADD CONSTRAINT FK_56DB349071B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento (id)");
        $this->addSql("ALTER TABLE llamado ADD CONSTRAINT FK_56DB34907D89F04A FOREIGN KEY (caracter_id) REFERENCES caracter (id)");
        $this->addSql("ALTER TABLE llamado ADD CONSTRAINT FK_56DB3490F9E584F8 FOREIGN KEY (motivo_id) REFERENCES licencia (id)");
//        $this->addSql("DROP TABLE lexik_maintenance");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE llamado DROP FOREIGN KEY FK_56DB34907D89F04A");
        $this->addSql("ALTER TABLE llamado DROP FOREIGN KEY FK_56DB3490F9E584F8");
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE acto_publico");
        $this->addSql("DROP TABLE llamado");
        $this->addSql("DROP TABLE caracter");
        $this->addSql("DROP TABLE resultado");
        $this->addSql("DROP TABLE licencia");
        $this->addSql("DROP TABLE vacancia");
    }
}
