<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241124161004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, slug, description, more_description, additional_infos, stock, solde_price, regular_price, image_urls, brand, is_available, is_best_seller, is_new_arrival, is_featured, is_special_offer FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, more_description CLOB DEFAULT NULL, additional_infos CLOB DEFAULT NULL, stock INTEGER DEFAULT NULL, solde_price INTEGER NOT NULL, regular_price INTEGER NOT NULL, image_urls CLOB NOT NULL --(DC2Type:array)
        , brand VARCHAR(255) DEFAULT NULL, is_available BOOLEAN DEFAULT NULL, is_best_seller BOOLEAN DEFAULT NULL, is_new_arrival BOOLEAN DEFAULT NULL, is_featured BOOLEAN DEFAULT NULL, is_special_offer BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO product (id, name, slug, description, more_description, additional_infos, stock, solde_price, regular_price, image_urls, brand, is_available, is_best_seller, is_new_arrival, is_featured, is_special_offer) SELECT id, name, slug, description, more_description, additional_infos, stock, solde_price, regular_price, image_urls, brand, is_available, is_best_seller, is_new_arrival, is_featured, is_special_offer FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }
}
