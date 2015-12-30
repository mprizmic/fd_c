<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151229220826 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
//        $this->addSql('ALTER TABLE cargo_ap ADD descripcion VARCHAR(150) DEFAULT NULL, ADD cantidad_horas TIME DEFAULT NULL, DROP nombre, DROP abreviatura');
        $this->addSql('ALTER TABLE carrera ADD publica_en_siol TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
//        $this->addSql('ALTER TABLE cargo_ap ADD nombre VARCHAR(50) DEFAULT NULL, ADD abreviatura VARCHAR(5) DEFAULT NULL, DROP descripcion, DROP cantidad_horas');
        $this->addSql('ALTER TABLE carrera DROP publica_en_siol');
    }
}
