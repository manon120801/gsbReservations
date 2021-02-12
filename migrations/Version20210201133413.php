<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201133413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences ADD regions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agences ADD CONSTRAINT FK_B46015DDFCE83E5F FOREIGN KEY (regions_id) REFERENCES regions (id)');
        $this->addSql('CREATE INDEX IDX_B46015DDFCE83E5F ON agences (regions_id)');
        $this->addSql('ALTER TABLE batiments ADD agences_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE batiments ADD CONSTRAINT FK_124D79909917E4AB FOREIGN KEY (agences_id) REFERENCES agences (id)');
        $this->addSql('CREATE INDEX IDX_124D79909917E4AB ON batiments (agences_id)');
        $this->addSql('ALTER TABLE materiels ADD salles_id INT DEFAULT NULL, ADD type_materiels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE69B11E4946 FOREIGN KEY (salles_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE69264D3153 FOREIGN KEY (type_materiels_id) REFERENCES type_materiels (id)');
        $this->addSql('CREATE INDEX IDX_9C1EBE69B11E4946 ON materiels (salles_id)');
        $this->addSql('CREATE INDEX IDX_9C1EBE69264D3153 ON materiels (type_materiels_id)');
        $this->addSql('ALTER TABLE reservations ADD utilisateurs_id INT DEFAULT NULL, ADD salles_id INT DEFAULT NULL, ADD extras_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2391E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239B11E4946 FOREIGN KEY (salles_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239955D4F3F FOREIGN KEY (extras_id) REFERENCES extras (id)');
        $this->addSql('CREATE INDEX IDX_4DA2391E969C5 ON reservations (utilisateurs_id)');
        $this->addSql('CREATE INDEX IDX_4DA239B11E4946 ON reservations (salles_id)');
        $this->addSql('CREATE INDEX IDX_4DA239955D4F3F ON reservations (extras_id)');
        $this->addSql('ALTER TABLE salles ADD batiments_id INT DEFAULT NULL, ADD surface_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA6DC28240 FOREIGN KEY (batiments_id) REFERENCES batiments (id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AACA11F534 FOREIGN KEY (surface_id) REFERENCES surface (id)');
        $this->addSql('CREATE INDEX IDX_799D45AA6DC28240 ON salles (batiments_id)');
        $this->addSql('CREATE INDEX IDX_799D45AACA11F534 ON salles (surface_id)');
        $this->addSql('ALTER TABLE utilisateurs ADD agence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315ED725330D FOREIGN KEY (agence_id) REFERENCES agences (id)');
        $this->addSql('CREATE INDEX IDX_497B315ED725330D ON utilisateurs (agence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences DROP FOREIGN KEY FK_B46015DDFCE83E5F');
        $this->addSql('DROP INDEX IDX_B46015DDFCE83E5F ON agences');
        $this->addSql('ALTER TABLE agences DROP regions_id');
        $this->addSql('ALTER TABLE batiments DROP FOREIGN KEY FK_124D79909917E4AB');
        $this->addSql('DROP INDEX IDX_124D79909917E4AB ON batiments');
        $this->addSql('ALTER TABLE batiments DROP agences_id');
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE69B11E4946');
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE69264D3153');
        $this->addSql('DROP INDEX IDX_9C1EBE69B11E4946 ON materiels');
        $this->addSql('DROP INDEX IDX_9C1EBE69264D3153 ON materiels');
        $this->addSql('ALTER TABLE materiels DROP salles_id, DROP type_materiels_id');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2391E969C5');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239B11E4946');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239955D4F3F');
        $this->addSql('DROP INDEX IDX_4DA2391E969C5 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA239B11E4946 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA239955D4F3F ON reservations');
        $this->addSql('ALTER TABLE reservations DROP utilisateurs_id, DROP salles_id, DROP extras_id');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA6DC28240');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AACA11F534');
        $this->addSql('DROP INDEX IDX_799D45AA6DC28240 ON salles');
        $this->addSql('DROP INDEX IDX_799D45AACA11F534 ON salles');
        $this->addSql('ALTER TABLE salles DROP batiments_id, DROP surface_id');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315ED725330D');
        $this->addSql('DROP INDEX IDX_497B315ED725330D ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP agence_id');
    }
}
