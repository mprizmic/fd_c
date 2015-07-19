<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150719203249 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
//        $this->addSql('CREATE TABLE turno_unidad_educativa (id INT AUTO_INCREMENT NOT NULL, unidad_educativa_id INT DEFAULT NULL, turno_id INT DEFAULT NULL, INDEX IDX_167633EABF20CF2F (unidad_educativa_id), INDEX IDX_167633EA69C5211E (turno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secundariox_orientacion (id INT AUTO_INCREMENT NOT NULL, secundariox_id INT DEFAULT NULL, orientacion_id INT DEFAULT NULL, INDEX IDX_98FC28242ED5694E (secundariox_id), INDEX IDX_98FC2824F73C956F (orientacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EABF20CF2F FOREIGN KEY (unidad_educativa_id) REFERENCES unidad_educativa (id)');
//        $this->addSql('ALTER TABLE turno_unidad_educativa ADD CONSTRAINT FK_167633EA69C5211E FOREIGN KEY (turno_id) REFERENCES turno (id)');
        $this->addSql('ALTER TABLE secundariox_orientacion ADD CONSTRAINT FK_98FC28242ED5694E FOREIGN KEY (secundariox_id) REFERENCES secundario_x (id)');
        $this->addSql('ALTER TABLE secundariox_orientacion ADD CONSTRAINT FK_98FC2824F73C956F FOREIGN KEY (orientacion_id) REFERENCES media_orientaciones (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
//        $this->addSql('DROP TABLE turno_unidad_educativa');
        $this->addSql('DROP TABLE secundariox_orientacion');
    }
}
