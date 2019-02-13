<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213132925 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return '';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, equipment_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_D338D583517FE9FE (equipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, user_property_id INT DEFAULT NULL, property_category VARCHAR(255) NOT NULL, unique_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip_code INT NOT NULL, country VARCHAR(255) NOT NULL, surface_in_square_meter INT NOT NULL, number_of_piece INT NOT NULL, description LONGTEXT DEFAULT NULL, rental_category VARCHAR(255) NOT NULL, rent_excluding_charges DOUBLE PRECISION NOT NULL, charges DOUBLE PRECISION NOT NULL, purchase_price DOUBLE PRECISION NOT NULL, INDEX IDX_8BF21CDEFD89DA79 (user_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583517FE9FE FOREIGN KEY (equipment_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEFD89DA79 FOREIGN KEY (user_property_id) REFERENCES user (id)');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Ascenseur\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Cave\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Jardin\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Parking\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Balcon\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Fibre optique\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Interphone\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Terrasse\');');
        $this->addSql('INSERT INTO equipment (name) VALUE (\'Piscine\');');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEFD89DA79');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583517FE9FE');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE property');
    }
}
