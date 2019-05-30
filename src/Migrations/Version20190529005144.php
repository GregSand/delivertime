<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529005144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("
            INSERT INTO testdb.supplier
                (name, created_at, updated_at)
                VALUES('Royal Mail', now(), now());
         ");

        $this->addSql("
            INSERT INTO testdb.shipping_period
                (supplier_id, delivery_day, start_time, end_time, created_at, updated_at)
                VALUES
                ('1', '1', '00:00:00', '16:00:00', now(), now()),
                ('1', '2', '00:00:00', '16:00:00', now(), now()),
                ('1', '3', '00:00:00', '16:00:00', now(), now()),
                ('1', '4', '00:00:00', '16:00:00', now(), now()),
                ('1', '5', '00:00:00', '16:00:00', now(), now())
        ");

        $this->addSql("
            INSERT INTO testdb.region
            (supplier_id, name, created_at, updated_at)
            VALUES
            ('1', 'UK', now(), now()),
            ('1', 'Europe', now(), now()),
            ('1', 'Rest of the world', now(), now())
        ");

        $this->addSql("
            INSERT INTO testdb.delivery_time
            (supplier_id, region_id, days_to_deliver, created_at, updated_at)
            VALUES
            ('1', '1', '1', now(), now()),
            ('1', '2', '3', now(), now()),
            ('1', '3', '8', now(), now())
        ");

    }

    public function down(Schema $schema) : void
    {
    }
}
