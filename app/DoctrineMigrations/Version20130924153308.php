<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130924153308 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("DROP TABLE lexik_maintenance");
//        $this->addSql("ALTER TABLE domicilio_localizacion ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
//        $this->addSql("ALTER TABLE domicilio ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
//        $this->addSql("ALTER TABLE autoridad ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
//        $this->addSql("ALTER TABLE inicial_x ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
//        $this->addSql("ALTER TABLE carrera ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
        $this->addSql("ALTER TABLE norma ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
        $this->addSql("ALTER TABLE cohorte ADD actualizado DATETIME NOT NULL, ADD creado DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE lexik_maintenance (ttl DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE autoridad DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE carrera DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE cohorte DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE domicilio DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE domicilio_localizacion DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE inicial_x DROP actualizado, DROP creado");
        $this->addSql("ALTER TABLE norma DROP actualizado, DROP creado");
    }
}
