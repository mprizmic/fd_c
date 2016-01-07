<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160107112742 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("CREATE TABLE cargo_ap (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(150) DEFAULT NULL, cantidad_horas TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE usuario CHANGE te_oficina te_oficina VARCHAR(35) DEFAULT NULL, CHANGE interno interno VARCHAR(5) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("DROP TABLE cargo_ap");
        $this->addSql("ALTER TABLE usuario CHANGE te_oficina te_oficina VARCHAR(35) NOT NULL, CHANGE interno interno VARCHAR(5) NOT NULL");
    }
}
