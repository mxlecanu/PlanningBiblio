<?php

declare(strict_types=1);

namespace dir_name;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200702130324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cron_job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL, command VARCHAR(1024) NOT NULL, schedule VARCHAR(191) NOT NULL, description VARCHAR(191) NOT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX un_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cron_report (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, run_at DATETIME NOT NULL, run_time DOUBLE PRECISION NOT NULL, exit_code INT NOT NULL, output LONGTEXT NOT NULL, INDEX IDX_B6C6A7F5BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cron_report ADD CONSTRAINT FK_B6C6A7F5BE04EA9 FOREIGN KEY (job_id) REFERENCES cron_job (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE absences');
        $this->addSql('DROP TABLE absences_recurrentes');
        $this->addSql('DROP TABLE activites');
        $this->addSql('DROP TABLE appel_dispo');
        $this->addSql('DROP TABLE conges');
        $this->addSql('DROP TABLE conges_cet');
        $this->addSql('DROP TABLE conges_infos');
        $this->addSql('DROP TABLE cron');
        $this->addSql('DROP TABLE edt_samedi');
        $this->addSql('DROP TABLE heures_absences');
        $this->addSql('DROP TABLE heures_sp');
        $this->addSql('DROP TABLE hidden_tables');
        $this->addSql('DROP TABLE ip_blocker');
        $this->addSql('DROP TABLE jours_feries');
        $this->addSql('DROP TABLE lignes');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE pl_notes');
        $this->addSql('DROP TABLE pl_notifications');
        $this->addSql('DROP TABLE pl_poste');
        $this->addSql('DROP TABLE pl_poste_cellules');
        $this->addSql('DROP TABLE pl_poste_horaires');
        $this->addSql('DROP TABLE pl_poste_lignes');
        $this->addSql('DROP TABLE pl_poste_modeles');
        $this->addSql('DROP TABLE pl_poste_modeles_tab');
        $this->addSql('DROP TABLE pl_poste_tab');
        $this->addSql('DROP TABLE pl_poste_tab_affect');
        $this->addSql('DROP TABLE pl_poste_tab_grp');
        $this->addSql('DROP TABLE pl_poste_verrou');
        $this->addSql('DROP TABLE planning_hebdo');
        $this->addSql('DROP TABLE postes');
        $this->addSql('DROP TABLE recuperations');
        $this->addSql('DROP TABLE responsables');
        $this->addSql('DROP TABLE select_categories');
        $this->addSql('DROP TABLE select_etages');
        $this->addSql('DROP TABLE select_groupes');
        $this->addSql('DROP TABLE select_services');
        $this->addSql('DROP TABLE select_statuts');
        $this->addSql('DROP TABLE volants');
        $this->addSql('ALTER TABLE absences_infos CHANGE debut debut VARCHAR(255) NOT NULL, CHANGE fin fin VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE acces CHANGE page page VARCHAR(255) NOT NULL, CHANGE ordre ordre INT NOT NULL, CHANGE categorie categorie VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX nom ON config');
        $this->addSql('ALTER TABLE config CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE valeur valeur VARCHAR(255) NOT NULL, CHANGE commentaires commentaires VARCHAR(255) NOT NULL, CHANGE categorie categorie VARCHAR(255) NOT NULL, CHANGE valeurs valeurs VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE infos CHANGE debut debut VARCHAR(255) NOT NULL, CHANGE fin fin VARCHAR(255) NOT NULL, CHANGE texte texte LONGTEXT NOT NULL');
        $this->addSql('DROP INDEX login ON personnel');
        $this->addSql('ALTER TABLE personnel CHANGE categorie categorie VARCHAR(255) NOT NULL, CHANGE arrivee arrivee DATE NOT NULL, CHANGE depart depart DATE NOT NULL, CHANGE actif actif VARCHAR(255) NOT NULL, CHANGE droits droits JSON NOT NULL COMMENT \'(DC2Type:json_array)\', CHANGE login login VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE last_login last_login DATETIME NOT NULL, CHANGE heures_hebdo heures_hebdo VARCHAR(255) NOT NULL, CHANGE supprime supprime VARCHAR(255) NOT NULL, CHANGE matricule matricule VARCHAR(255) NOT NULL, CHANGE code_ics code_ics VARCHAR(255) NOT NULL, CHANGE url_ics url_ics LONGTEXT NOT NULL, CHANGE check_ics check_ics VARCHAR(255) NOT NULL, CHANGE check_hamac check_hamac INT NOT NULL, CHANGE conges_credit conges_credit DOUBLE PRECISION NOT NULL, CHANGE conges_reliquat conges_reliquat DOUBLE PRECISION NOT NULL, CHANGE conges_anticipation conges_anticipation DOUBLE PRECISION NOT NULL, CHANGE comp_time comp_time DOUBLE PRECISION NOT NULL, CHANGE conges_annuel conges_annuel DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE select_abs CHANGE rang rang INT NOT NULL, CHANGE type type INT NOT NULL, CHANGE notification_workflow notification_workflow VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cron_report DROP FOREIGN KEY FK_B6C6A7F5BE04EA9');
        $this->addSql('CREATE TABLE absences (id INT AUTO_INCREMENT NOT NULL, perso_id INT DEFAULT 0 NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, motif TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, motif_autre TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaires TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, demande DATETIME NOT NULL, valide INT DEFAULT 0 NOT NULL, validation DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide_n1 INT DEFAULT 0 NOT NULL, validation_n1 DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, pj1 INT DEFAULT 0, pj2 INT DEFAULT 0, so INT DEFAULT 0, groupe VARCHAR(14) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, cal_name VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ical_key TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_modified VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, uid TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, rrule TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, id_origin INT DEFAULT 0 NOT NULL, INDEX debut (debut), INDEX cal_name (cal_name(250)), INDEX fin (fin), INDEX perso_id (perso_id), INDEX groupe (groupe), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE absences_recurrentes (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, perso_id INT DEFAULT NULL, event TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, end VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'0\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, timestamp DATETIME DEFAULT \'current_timestamp()\' NOT NULL, last_update VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, last_check VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX end (end), INDEX uid (uid), INDEX last_check (last_check), INDEX perso_id (perso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE activites (id INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, supprime DATETIME DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE appel_dispo (id INT AUTO_INCREMENT NOT NULL, site INT DEFAULT 1 NOT NULL, poste INT DEFAULT 0 NOT NULL, date VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, debut VARCHAR(8) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, fin VARCHAR(8) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, destinataires TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, sujet TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, message TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, timestamp DATETIME DEFAULT \'current_timestamp()\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE conges (id INT AUTO_INCREMENT NOT NULL, perso_id INT NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, halfday TINYINT(1) DEFAULT \'0\', start_halfday VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' COLLATE `utf8mb4_unicode_ci`, end_halfday VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' COLLATE `utf8mb4_unicode_ci`, commentaires TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, refus TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, heures VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, debit VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, saisie DATETIME DEFAULT \'current_timestamp()\' NOT NULL, saisie_par INT NOT NULL, modif INT DEFAULT 0 NOT NULL, modification DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide_n1 INT DEFAULT 0 NOT NULL, validation_n1 DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide INT DEFAULT 0 NOT NULL, validation DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, solde_prec DOUBLE PRECISION DEFAULT \'NULL\', solde_actuel DOUBLE PRECISION DEFAULT \'NULL\', recup_prec DOUBLE PRECISION DEFAULT \'NULL\', recup_actuel DOUBLE PRECISION DEFAULT \'NULL\', reliquat_prec DOUBLE PRECISION DEFAULT \'NULL\', reliquat_actuel DOUBLE PRECISION DEFAULT \'NULL\', anticipation_prec DOUBLE PRECISION DEFAULT \'NULL\', anticipation_actuel DOUBLE PRECISION DEFAULT \'NULL\', supprime INT DEFAULT 0 NOT NULL, suppr_date DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, information INT DEFAULT 0 NOT NULL, info_date DATETIME DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE conges_cet (id INT AUTO_INCREMENT NOT NULL, perso_id INT NOT NULL, jours INT DEFAULT 0 NOT NULL, commentaires TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, saisie DATETIME DEFAULT \'current_timestamp()\' NOT NULL, saisie_par INT NOT NULL, modif INT DEFAULT 0 NOT NULL, modification DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide_n1 INT DEFAULT 0 NOT NULL, validation_n1 DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide_n2 INT DEFAULT 0 NOT NULL, validation_n2 DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, refus TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, solde_prec DOUBLE PRECISION DEFAULT \'NULL\', solde_actuel DOUBLE PRECISION DEFAULT \'NULL\', annee VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE conges_infos (id INT AUTO_INCREMENT NOT NULL, debut DATE DEFAULT \'NULL\', fin DATE DEFAULT \'NULL\', texte TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, saisie DATETIME DEFAULT \'current_timestamp()\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cron (id INT AUTO_INCREMENT NOT NULL, m VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, h VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, dom VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, mon VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, dow VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, command VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, comments VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, last DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE edt_samedi (id INT AUTO_INCREMENT NOT NULL, perso_id INT NOT NULL, semaine DATE DEFAULT \'NULL\', tableau INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE heures_absences (id INT AUTO_INCREMENT NOT NULL, semaine DATE DEFAULT \'NULL\', update_time INT DEFAULT NULL, heures TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE heures_sp (id INT AUTO_INCREMENT NOT NULL, semaine DATE DEFAULT \'NULL\', update_time INT DEFAULT NULL, heures TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE hidden_tables (id INT AUTO_INCREMENT NOT NULL, perso_id INT DEFAULT 0 NOT NULL, tableau INT DEFAULT 0 NOT NULL, hidden_tables TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ip_blocker (id INT AUTO_INCREMENT NOT NULL, ip VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, login VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, status VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, timestamp DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX timestamp (timestamp), INDEX ip (ip), INDEX status (status), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jours_feries (id INT AUTO_INCREMENT NOT NULL, annee VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, jour DATE DEFAULT \'NULL\', ferie INT DEFAULT NULL, fermeture INT DEFAULT NULL, nom TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, commentaire TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lignes (id INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, msg TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, program VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, timestamp DATETIME DEFAULT \'current_timestamp()\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, niveau1 INT NOT NULL, niveau2 INT NOT NULL, titre VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, url VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, `condition` VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_notes (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT \'NULL\', site INT DEFAULT 1 NOT NULL, text TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, perso_id INT NOT NULL, timestamp DATETIME DEFAULT \'current_timestamp()\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_notifications (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, site INT DEFAULT 1 NOT NULL, update_time DATETIME DEFAULT \'current_timestamp()\' NOT NULL, data TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX date (date), INDEX site (site), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste (id INT UNSIGNED AUTO_INCREMENT NOT NULL, perso_id INT DEFAULT 0 NOT NULL, date DATE DEFAULT \'\'\'0000-00-00\'\'\' NOT NULL, poste INT DEFAULT 0 NOT NULL, absent VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'0\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, chgt_login INT DEFAULT NULL, chgt_time DATETIME NOT NULL, debut TIME NOT NULL, fin TIME NOT NULL, supprime VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'0\'\'\' COLLATE `utf8mb4_unicode_ci`, site INT DEFAULT 1, grise VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'0\'\'\' COLLATE `utf8mb4_unicode_ci`, INDEX date (date), INDEX site (site), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_cellules (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, tableau INT NOT NULL, ligne INT NOT NULL, colonne INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_horaires (id INT AUTO_INCREMENT NOT NULL, debut TIME DEFAULT \'\'\'00:00:00\'\'\' NOT NULL, fin TIME DEFAULT \'\'\'00:00:00\'\'\' NOT NULL, tableau INT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_lignes (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, tableau INT NOT NULL, ligne INT NOT NULL, poste VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_modeles (id INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, perso_id INT NOT NULL, poste INT NOT NULL, commentaire TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, debut TIME NOT NULL, fin TIME NOT NULL, tableau VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, jour VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, site INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_modeles_tab (id INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, jour INT NOT NULL, tableau INT NOT NULL, site INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_tab (id INT AUTO_INCREMENT NOT NULL, tableau INT NOT NULL, nom TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, site INT DEFAULT 1 NOT NULL, supprime DATETIME DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_tab_affect (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, tableau INT NOT NULL, site INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_tab_grp (id INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lundi INT DEFAULT NULL, mardi INT DEFAULT NULL, mercredi INT DEFAULT NULL, jeudi INT DEFAULT NULL, vendredi INT DEFAULT NULL, samedi INT DEFAULT NULL, dimanche INT DEFAULT NULL, site INT DEFAULT 1 NOT NULL, supprime DATETIME DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pl_poste_verrou (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT \'\'\'0000-00-00\'\'\' NOT NULL, verrou INT DEFAULT 0 NOT NULL, validation DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, perso INT DEFAULT 0 NOT NULL, verrou2 INT DEFAULT 0 NOT NULL, validation2 DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, perso2 INT DEFAULT 0 NOT NULL, vivier INT DEFAULT 0 NOT NULL, site INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE planning_hebdo (id INT AUTO_INCREMENT NOT NULL, perso_id INT NOT NULL, debut DATE NOT NULL, fin DATE NOT NULL, temps TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, breaktime TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, saisie DATETIME DEFAULT \'current_timestamp()\' NOT NULL, modif INT DEFAULT 0 NOT NULL, modification DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide_n1 INT DEFAULT 0 NOT NULL, validation_n1 DATETIME DEFAULT \'NULL\', valide INT DEFAULT 0 NOT NULL, validation DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, actuel INT DEFAULT 0 NOT NULL, remplace INT DEFAULT 0 NOT NULL, cle VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX cle (cle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE postes (id INT AUTO_INCREMENT NOT NULL, nom TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, groupe TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, groupe_id INT DEFAULT 0 NOT NULL, obligatoire VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etage TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, activites TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, statistiques VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'1\'\'\' COLLATE `utf8mb4_unicode_ci`, bloquant VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'1\'\'\' COLLATE `utf8mb4_unicode_ci`, site INT DEFAULT 1, categories TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, supprime DATETIME DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recuperations (id INT AUTO_INCREMENT NOT NULL, perso_id INT NOT NULL, date DATE DEFAULT \'NULL\', date2 DATE DEFAULT \'NULL\', heures DOUBLE PRECISION DEFAULT \'NULL\', etat VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, commentaires TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, saisie DATETIME DEFAULT \'current_timestamp()\' NOT NULL, saisie_par INT NOT NULL, modif INT DEFAULT 0 NOT NULL, modification DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, valide_n1 INT DEFAULT 0 NOT NULL, validation_n1 DATETIME DEFAULT \'NULL\', valide INT DEFAULT 0 NOT NULL, validation DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, refus TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, solde_prec DOUBLE PRECISION DEFAULT \'NULL\', solde_actuel DOUBLE PRECISION DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE responsables (id INT AUTO_INCREMENT NOT NULL, perso_id INT DEFAULT 0 NOT NULL, responsable INT DEFAULT 0 NOT NULL, notification INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE select_categories (id INT AUTO_INCREMENT NOT NULL, valeur TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rang INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE select_etages (id INT AUTO_INCREMENT NOT NULL, valeur TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rang INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE select_groupes (id INT AUTO_INCREMENT NOT NULL, valeur TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rang INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE select_services (id INT AUTO_INCREMENT NOT NULL, valeur TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rang INT NOT NULL, couleur VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE select_statuts (id INT AUTO_INCREMENT NOT NULL, valeur TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rang INT DEFAULT 0 NOT NULL, couleur VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, categorie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE volants (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT \'NULL\', perso_id INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE cron_job');
        $this->addSql('DROP TABLE cron_report');
        $this->addSql('ALTER TABLE absences_infos CHANGE debut debut DATE DEFAULT \'\'\'0000-00-00\'\'\' NOT NULL, CHANGE fin fin DATE DEFAULT \'\'\'0000-00-00\'\'\' NOT NULL');
        $this->addSql('ALTER TABLE acces CHANGE page page VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ordre ordre INT DEFAULT 0 NOT NULL, CHANGE categorie categorie VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE config CHANGE nom nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE valeur valeur TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commentaires commentaires TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE categorie categorie VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE valeurs valeurs TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX nom ON config (nom)');
        $this->addSql('ALTER TABLE infos CHANGE debut debut DATE DEFAULT \'NULL\', CHANGE fin fin DATE DEFAULT \'NULL\', CHANGE texte texte TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personnel CHANGE categorie categorie VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE arrivee arrivee DATE DEFAULT \'\'\'0000-00-00\'\'\' NOT NULL, CHANGE depart depart DATE DEFAULT \'\'\'0000-00-00\'\'\' NOT NULL, CHANGE actif actif VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'\'\'true\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE droits droits VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE login login VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'\'\'0000-00-00 00:00:00\'\'\' NOT NULL, CHANGE heures_hebdo heures_hebdo VARCHAR(6) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE supprime supprime VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'0\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE matricule matricule VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code_ics code_ics VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE url_ics url_ics TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE check_ics check_ics VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'\'\'[1,1,1]\'\'\' COLLATE `utf8mb4_unicode_ci`, CHANGE check_hamac check_hamac INT DEFAULT 1 NOT NULL, CHANGE conges_credit conges_credit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE conges_reliquat conges_reliquat DOUBLE PRECISION DEFAULT \'NULL\', CHANGE conges_anticipation conges_anticipation DOUBLE PRECISION DEFAULT \'NULL\', CHANGE comp_time comp_time DOUBLE PRECISION DEFAULT \'NULL\', CHANGE conges_annuel conges_annuel DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('CREATE UNIQUE INDEX login ON personnel (login)');
        $this->addSql('ALTER TABLE select_abs CHANGE rang rang INT DEFAULT 0 NOT NULL, CHANGE type type INT DEFAULT 0 NOT NULL, CHANGE notification_workflow notification_workflow CHAR(1) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
