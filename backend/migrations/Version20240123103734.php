<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123103734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY fk_command_customer');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY fk_command_product');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (order_id INT NOT NULL, product_id INT NOT NULL, customer_id INT NOT NULL, order_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, total_amount NUMERIC(10, 0) NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, shipping_address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, payment_method VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_command_customer (customer_id), INDEX fk_command_product (product_id), PRIMARY KEY(order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE customers (id INT NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'Customer\' NOT NULL COLLATE `utf8mb4_general_ci`, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, product_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, price NUMERIC(10, 0) NOT NULL, stock_quantity INT NOT NULL, description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, category VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT fk_command_customer FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT fk_command_product FOREIGN KEY (product_id) REFERENCES product (id)');
    }
}
