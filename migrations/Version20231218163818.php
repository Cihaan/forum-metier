<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218163818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, secteur_id_id INT NOT NULL, salle_id_id INT DEFAULT NULL, edition_id_id INT NOT NULL, debut_datetime DATETIME NOT NULL, INDEX IDX_E1BB18234322D17E (secteur_id_id), UNIQUE INDEX UNIQ_E1BB182392419D3E (salle_id_id), INDEX IDX_E1BB182385FB94DF (edition_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_metier (atelier_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_B09756A082E2CF35 (atelier_id), INDEX IDX_B09756A0ED16FA20 (metier_id), PRIMARY KEY(atelier_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, annee DATE NOT NULL, questionaire_url VARCHAR(2048) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition_sponsor (edition_id INT NOT NULL, sponsor_id INT NOT NULL, INDEX IDX_9203C83674281A5E (edition_id), INDEX IDX_9203C83612F7FB51 (sponsor_id), PRIMARY KEY(edition_id, sponsor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, section_id_id INT NOT NULL, ecole_id_id INT NOT NULL, UNIQUE INDEX UNIQ_717E22E39D86650F (user_id_id), INDEX IDX_717E22E3E813F933 (section_id_id), INDEX IDX_717E22E3E97A7F4E (ecole_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, statut_chiffrement TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_etudiant (inscription_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_D8EB5D465DAC5993 (inscription_id), INDEX IDX_D8EB5D46DDEAB1A3 (etudiant_id), PRIMARY KEY(inscription_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_competence (metier_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_2B2C55BED16FA20 (metier_id), INDEX IDX_2B2C55B15761DAB (competence_id), PRIMARY KEY(metier_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_activite (metier_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_DA8FEC3ED16FA20 (metier_id), INDEX IDX_DA8FEC39B0F88B1 (activite_id), PRIMARY KEY(metier_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, atelier_id INT NOT NULL, nom VARCHAR(255) NOT NULL, lien VARCHAR(2048) DEFAULT NULL, INDEX IDX_939F454482E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, ecole_id_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, etage INT NOT NULL, capacite INT NOT NULL, INDEX IDX_4E977E5CE97A7F4E (ecole_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, role_id_id INT NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D64988987678 (role_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB18234322D17E FOREIGN KEY (secteur_id_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182392419D3E FOREIGN KEY (salle_id_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182385FB94DF FOREIGN KEY (edition_id_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE atelier_metier ADD CONSTRAINT FK_B09756A082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_metier ADD CONSTRAINT FK_B09756A0ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE edition_sponsor ADD CONSTRAINT FK_9203C83674281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE edition_sponsor ADD CONSTRAINT FK_9203C83612F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E39D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3E813F933 FOREIGN KEY (section_id_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3E97A7F4E FOREIGN KEY (ecole_id_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE inscription_etudiant ADD CONSTRAINT FK_D8EB5D465DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_etudiant ADD CONSTRAINT FK_D8EB5D46DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_competence ADD CONSTRAINT FK_2B2C55BED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_competence ADD CONSTRAINT FK_2B2C55B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_activite ADD CONSTRAINT FK_DA8FEC3ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_activite ADD CONSTRAINT FK_DA8FEC39B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F454482E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CE97A7F4E FOREIGN KEY (ecole_id_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64988987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB18234322D17E');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182392419D3E');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182385FB94DF');
        $this->addSql('ALTER TABLE atelier_metier DROP FOREIGN KEY FK_B09756A082E2CF35');
        $this->addSql('ALTER TABLE atelier_metier DROP FOREIGN KEY FK_B09756A0ED16FA20');
        $this->addSql('ALTER TABLE edition_sponsor DROP FOREIGN KEY FK_9203C83674281A5E');
        $this->addSql('ALTER TABLE edition_sponsor DROP FOREIGN KEY FK_9203C83612F7FB51');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E39D86650F');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3E813F933');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3E97A7F4E');
        $this->addSql('ALTER TABLE inscription_etudiant DROP FOREIGN KEY FK_D8EB5D465DAC5993');
        $this->addSql('ALTER TABLE inscription_etudiant DROP FOREIGN KEY FK_D8EB5D46DDEAB1A3');
        $this->addSql('ALTER TABLE metier_competence DROP FOREIGN KEY FK_2B2C55BED16FA20');
        $this->addSql('ALTER TABLE metier_competence DROP FOREIGN KEY FK_2B2C55B15761DAB');
        $this->addSql('ALTER TABLE metier_activite DROP FOREIGN KEY FK_DA8FEC3ED16FA20');
        $this->addSql('ALTER TABLE metier_activite DROP FOREIGN KEY FK_DA8FEC39B0F88B1');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F454482E2CF35');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CE97A7F4E');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64988987678');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE atelier_metier');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE edition_sponsor');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_etudiant');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE metier_competence');
        $this->addSql('DROP TABLE metier_activite');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
