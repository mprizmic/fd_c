<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150517214010 extends AbstractMigration {

    public function up(Schema $schema) {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('ALTER TABLE establecimiento DROP inscripcion_2_cuatrimestre');
        $this->addSql('ALTER TABLE carrera ADD comentario VARCHAR(250) DEFAULT NULL');
    }

    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carrera DROP comentario');
//        $this->addSql('ALTER TABLE establecimiento ADD inscripcion_2_cuatrimestre VARCHAR(2) DEFAULT NULL');
    }

}
