<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528141950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
                CREATE TABLE order_log
                    (
                        id INT AUTO_INCREMENT NOT NULL,
                        supplier_id INT NOT NULL,
                        region_id INT NOT NULL,
                        reference VARCHAR(255) DEFAULT NULL,
                        date_ordered DATETIME NOT NULL,
                        eta_date DATE NOT NULL,
                        eta_start_time TIME NOT NULL,
                        eta_end_time TIME NOT NULL,
                        created_at DATETIME NOT NULL,
                        updated_at DATETIME NOT NULL,
                        INDEX IDX_64E1C0CDA65F9C7D (supplier_id),
                        INDEX IDX_64E1C0CDC7209D4F (region_id),
                        PRIMARY KEY(id)
                    )
                    DEFAULT CHARACTER SET utf8mb4
                    COLLATE utf8mb4_unicode_ci
                    ENGINE = InnoDB'
        );

        $this->addSql('
                CREATE TABLE region
                    (
                        id INT AUTO_INCREMENT NOT NULL,
                        supplier_id INT NOT NULL,
                        name VARCHAR(50) NOT NULL,
                        created_at DATETIME NOT NULL,
                        updated_at DATETIME NOT NULL,
                        INDEX IDX_F62F176A65F9C7D (supplier_id),
                        PRIMARY KEY(id)
                    )
                    DEFAULT CHARACTER SET utf8mb4
                    COLLATE utf8mb4_unicode_ci
                    ENGINE = InnoDB'
        );

        $this->addSql('
                CREATE TABLE shipping_period
                    (
                        id INT AUTO_INCREMENT NOT NULL,
                        supplier_id INT NOT NULL,
                        delivery_day SMALLINT NOT NULL,
                        start_time TIME NOT NULL,
                        end_time TIME NOT NULL,
                        created_at DATETIME NOT NULL,
                        updated_at DATETIME NOT NULL,
                        INDEX IDX_EEE2DB81A65F9C7D (supplier_id),
                        PRIMARY KEY(id)
                    )
                    DEFAULT CHARACTER SET utf8mb4
                    COLLATE utf8mb4_unicode_ci
                    ENGINE = InnoDB'
        );

        $this->addSql('
                CREATE TABLE supplier
                    (
                        id INT AUTO_INCREMENT NOT NULL,
                        name VARCHAR(100) NOT NULL,
                        created_at DATETIME NOT NULL,
                        updated_at DATETIME NOT NULL,
                        PRIMARY KEY(id)
                    )
                    DEFAULT CHARACTER SET utf8mb4
                    COLLATE utf8mb4_unicode_ci
                    ENGINE = InnoDB'
        );

        $this->addSql('
                CREATE TABLE delivery_time
                    (
                        id INT AUTO_INCREMENT NOT NULL,
                        supplier_id INT NOT NULL,
                        region_id INT NOT NULL,
                        days_to_deliver SMALLINT NOT NULL,
                        created_at DATETIME NOT NULL,
                        updated_at DATETIME NOT NULL,
                        INDEX IDX_BE0850DFA65F9C7D (supplier_id),
                        INDEX IDX_BE0850DFC7209D4F (region_id),
                        PRIMARY KEY(id)
                    )
                    DEFAULT CHARACTER SET utf8mb4
                    COLLATE utf8mb4_unicode_ci
                    ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE order_log ADD CONSTRAINT FK_64E1C0CDA65F9C7D FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE order_log ADD CONSTRAINT FK_64E1C0CDC7209D4F FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176A65F9C7D FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE shipping_period ADD CONSTRAINT FK_EEE2DB81A65F9C7D FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE delivery_time ADD CONSTRAINT FK_BE0850DFA65F9C7D FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE delivery_time ADD CONSTRAINT FK_BE0850DFC7209D4F FOREIGN KEY (region_id) REFERENCES region (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_log DROP FOREIGN KEY FK_64E1C0CDC7209D4F');
        $this->addSql('ALTER TABLE delivery_time DROP FOREIGN KEY FK_BE0850DFC7209D4F');
        $this->addSql('ALTER TABLE order_log DROP FOREIGN KEY FK_64E1C0CDA65F9C7D');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176A65F9C7D');
        $this->addSql('ALTER TABLE shipping_period DROP FOREIGN KEY FK_EEE2DB81A65F9C7D');
        $this->addSql('ALTER TABLE delivery_time DROP FOREIGN KEY FK_BE0850DFA65F9C7D');
        $this->addSql('DROP TABLE order_log');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE shipping_period');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE delivery_time');
    }
}
