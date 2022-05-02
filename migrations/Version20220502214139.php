<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502214139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments ADD user_id_id INT NOT NULL, ADD product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962ADE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A9D86650F ON comments (user_id_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962ADE18E50B ON comments (product_id_id)');
        $this->addSql('ALTER TABLE product ADD category_id_id INT NOT NULL, ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD9777D11E ON product (category_id_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD9D86650F ON product (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9D86650F');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962ADE18E50B');
        $this->addSql('DROP INDEX IDX_5F9E962A9D86650F ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962ADE18E50B ON comments');
        $this->addSql('ALTER TABLE comments DROP user_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9777D11E');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9D86650F');
        $this->addSql('DROP INDEX IDX_D34A04AD9777D11E ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD9D86650F ON product');
        $this->addSql('ALTER TABLE product DROP category_id_id, DROP user_id_id');
    }
}
