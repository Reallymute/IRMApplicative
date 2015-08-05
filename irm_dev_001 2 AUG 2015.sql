-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 02 Août 2015 à 16:13
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `irm_dev_001`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_datedernieraccess`
--

CREATE TABLE IF NOT EXISTS `admin_datedernieraccess` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `DateDernierUsage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `admin_listedesregles`
--

CREATE TABLE IF NOT EXISTS `admin_listedesregles` (
  `id` int(11) NOT NULL,
  `Ref_Int_Regle` int(11) NOT NULL AUTO_INCREMENT,
  `TypeRegle` varchar(255) DEFAULT NULL,
  `RegleNom` varchar(255) DEFAULT NULL,
  `Ref_Int_RegleLiee` mediumtext,
  `StatutActive` tinyint(4) DEFAULT '-1',
  `Priorite` int(15) DEFAULT NULL,
  `CritereInclusion` varchar(255) DEFAULT NULL,
  `CritereExclusion` varchar(255) DEFAULT NULL,
  `RessourceInclusionRegle` varchar(255) DEFAULT NULL,
  `Ref_Type_InsertionRegle` mediumtext,
  PRIMARY KEY (`Ref_Int_Regle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `admin_listedesregles`
--

INSERT INTO `admin_listedesregles` (`id`, `Ref_Int_Regle`, `TypeRegle`, `RegleNom`, `Ref_Int_RegleLiee`, `StatutActive`, `Priorite`, `CritereInclusion`, `CritereExclusion`, `RessourceInclusionRegle`, `Ref_Type_InsertionRegle`) VALUES
(1, 1, 'REGEXP', 'IdentOMEGABig', NULL, 0, 1, 'omega', NULL, NULL, '9'),
(2, 2, 'REGEXP', 'IdentO2CER@RIEN', NULL, -1, 1, 'Sers A Rien', NULL, 'IRM Applicative Agent Plug-in SIMULATION CAST (XML).accdb', '9'),
(3, 3, 'REGEXP', 'IdentOMEGAvalcred', NULL, -1, 1, 'omega(.)*valcred', NULL, 'IRM Applicative Agent Plug-in SIMULATION LOG (BRUT).accdb', '9'),
(4, 4, 'REGEXP', 'IdentIRMGetData', NULL, -1, 1, 'GetData(.)*ACTIVE', NULL, 'IRM Appli.txt', '9');

-- --------------------------------------------------------

--
-- Structure de la table `admin_listedestaches`
--

CREATE TABLE IF NOT EXISTS `admin_listedestaches` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `Activite` mediumtext,
  `Identifiant` varchar(255) DEFAULT NULL,
  `CheminAcces` varchar(255) DEFAULT NULL,
  `HeureDateValide` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `HeureDateTermine` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `HeureDateProgrammee` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Statut` varchar(255) DEFAULT NULL,
  `Ref_Ext_NomApplication` mediumtext,
  `Ref_Ext_Fonction` mediumtext,
  `RegleTraitementRef` mediumtext,
  `RegleCycleReset` mediumtext,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `admin_listeentites`
--

CREATE TABLE IF NOT EXISTS `admin_listeentites` (
  `No` int(11) NOT NULL,
  `NomEntite` varchar(255) NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bufferintermediare_fonctiondetectionnormalisee`
--

CREATE TABLE IF NOT EXISTS `bufferintermediare_fonctiondetectionnormalisee` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `NomCandidatAppli` varchar(255) DEFAULT NULL,
  `NomCandidatFonction` varchar(255) DEFAULT NULL,
  `DatePriseEnCompte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DatePremiereActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateArretActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Cle_Ext_Provenance` mediumtext,
  `Cle_Ext_ChainonActivite` mediumtext,
  `Cle_Ext_Relation_Logique` mediumtext,
  `Cle_Ext_Fonction` mediumtext,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `bufferintermediare_fonctionsyntheseapport`
--

CREATE TABLE IF NOT EXISTS `bufferintermediare_fonctionsyntheseapport` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `NomCandidatAppli` varchar(255) DEFAULT NULL,
  `NomCandidatFonction` varchar(255) DEFAULT NULL,
  `DatePriseEnCompte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DatePremiereActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateArretActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Cle_Ext_Provenance` mediumtext,
  `Cle_Ext_ChainonActivite` mediumtext,
  `Cle_Ext_Relation_Logique` mediumtext,
  `Cle_Ext_Fonction` mediumtext,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entree_fonctionpourinsert`
--

CREATE TABLE IF NOT EXISTS `entree_fonctionpourinsert` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `NomCandidatAppli` varchar(255) DEFAULT NULL,
  `NomCandidatFonction` varchar(255) DEFAULT NULL,
  `DatePriseEnCompte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DatePremiereActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateArretActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Provenance` varchar(255) DEFAULT NULL,
  `TypeInsertion` mediumtext,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entree_indicesfonctionsupervision`
--

CREATE TABLE IF NOT EXISTS `entree_indicesfonctionsupervision` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `NomCandidatAppli` varchar(255) DEFAULT NULL,
  `NomCandidatFonction` varchar(255) DEFAULT NULL,
  `DatePriseEnCompte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DatePremiereActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateArretActivite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Provenance` mediumtext,
  `TypeInsertion` mediumtext,
  `ActiviteSource` varchar(255) DEFAULT NULL,
  `AttenteTransfert` tinyint(4) DEFAULT '0',
  `PourSuppression` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `journal_fonctionetapplication`
--

CREATE TABLE IF NOT EXISTS `journal_fonctionetapplication` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `TypeJournal` mediumtext,
  `Cle_Ext_Application` mediumtext,
  `Cle_Ext_Fonction` mediumtext,
  `NomApplication` varchar(255) DEFAULT NULL,
  `NomFonction` varchar(255) DEFAULT NULL,
  `DateDebutPeriodeRef` datetime NOT NULL,
  `DatePremiereActivite` datetime NOT NULL,
  `DateArretActivite` datetime NOT NULL,
  `Cle_Ext_Relation_Logique` mediumtext,
  `Cle_Ext_Provenance` mediumtext,
  `DateFinDePeriodeRef` datetime NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liens_activiteverstypejournal`
--

CREATE TABLE IF NOT EXISTS `liens_activiteverstypejournal` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `Ref_Int_ActiviteTache` mediumtext,
  `Ref_Int_TypeJournal` mediumtext,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liens_fonctionversprovenance`
--

CREATE TABLE IF NOT EXISTS `liens_fonctionversprovenance` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `Ref_Ext_Fonction` mediumtext,
  `Ref_Ext_Provenance` mediumtext,
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liens_relations`
--

CREATE TABLE IF NOT EXISTS `liens_relations` (
  `Cle_Relation` int(11) NOT NULL AUTO_INCREMENT,
  `Cle_Ext_Relation_Logique` mediumtext,
  `Cle_Ext_ProchaineRelation` mediumtext,
  `RacinePrimaireBool` tinyint(4) DEFAULT '0',
  `FeuilleBool` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`Cle_Relation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `referentielhistorique_application`
--

CREATE TABLE IF NOT EXISTS `referentielhistorique_application` (
  `Cle_Ext_ApplicationIDExterne` int(11) NOT NULL AUTO_INCREMENT,
  `NomApplication` varchar(255) DEFAULT NULL,
  `Descriptif` varchar(255) DEFAULT NULL,
  `Statut` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Cle_Ext_ApplicationIDExterne`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `referentielhistorique_application`
--

INSERT INTO `referentielhistorique_application` (`Cle_Ext_ApplicationIDExterne`, `NomApplication`, `Descriptif`, `Statut`) VALUES
(1, 'OMEGA', 'OMEGA', NULL),
(2, 'IRMA', 'IRMApplicative', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `referentielhistorique_fonction`
--

CREATE TABLE IF NOT EXISTS `referentielhistorique_fonction` (
  `Cle_Ext_FonctionID` int(11) NOT NULL AUTO_INCREMENT,
  `Cle_Ext_ApplicationIDExterne` mediumtext,
  `NomFonction` varchar(255) DEFAULT NULL,
  `DescriptionFonction` varchar(255) DEFAULT NULL,
  `DateMiseEnService` datetime NOT NULL,
  `Date_Disponibilite` datetime NOT NULL,
  `Utilisateur` varchar(255) DEFAULT NULL,
  `DateSuppression` datetime NOT NULL,
  PRIMARY KEY (`Cle_Ext_FonctionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `referentielhistorique_fonction`
--

INSERT INTO `referentielhistorique_fonction` (`Cle_Ext_FonctionID`, `Cle_Ext_ApplicationIDExterne`, `NomFonction`, `DescriptionFonction`, `DateMiseEnService`, `Date_Disponibilite`, `Utilisateur`, `DateSuppression`) VALUES
(1, '2', 'Connexion', 'COnnexion a un Service', '2015-05-05 00:00:00', '2015-05-07 00:00:00', 'TX8981', '0000-00-00 00:00:00'),
(2, '2', 'Recherche', 'Chercher des traces dactivité', '2015-05-05 00:00:00', '2015-05-07 00:00:00', 'TX8981', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `referentielhistorique_provenance`
--

CREATE TABLE IF NOT EXISTS `referentielhistorique_provenance` (
  `Cle_Ext_ProvenanceID` int(11) NOT NULL AUTO_INCREMENT,
  `NomProvenance` varchar(255) DEFAULT NULL,
  `DescriptionProvenance` varchar(255) DEFAULT NULL,
  `DateMiseEnService` datetime NOT NULL,
  `Date_Disponibilite` datetime NOT NULL,
  `Utilisateur` varchar(255) DEFAULT NULL,
  `DateSuppression` datetime NOT NULL,
  PRIMARY KEY (`Cle_Ext_ProvenanceID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `refliste_activitetache`
--

CREATE TABLE IF NOT EXISTS `refliste_activitetache` (
  `Ref_Int_ActiviteTache` int(11) NOT NULL AUTO_INCREMENT,
  `ActiviteTache` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Ref_Int_ActiviteTache`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `refliste_cycletraitement`
--

CREATE TABLE IF NOT EXISTS `refliste_cycletraitement` (
  `Ref_Int_CycleTraitement` int(11) NOT NULL AUTO_INCREMENT,
  `TypeCycle` varchar(255) DEFAULT NULL,
  `Ref_Int_Regle` mediumtext,
  PRIMARY KEY (`Ref_Int_CycleTraitement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `refliste_typeinsertionregle`
--

CREATE TABLE IF NOT EXISTS `refliste_typeinsertionregle` (
  `Ref_Int_InsertionRegle` int(11) NOT NULL AUTO_INCREMENT,
  `TypeInsertionRegle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Ref_Int_InsertionRegle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `refliste_typejournal`
--

CREATE TABLE IF NOT EXISTS `refliste_typejournal` (
  `Ref_Int_TypeJournal` int(11) NOT NULL AUTO_INCREMENT,
  `TypeJournal` varchar(255) DEFAULT NULL,
  `PrioriteCategorie` int(15) DEFAULT NULL,
  `PrioriteEnumeration` int(15) DEFAULT NULL,
  PRIMARY KEY (`Ref_Int_TypeJournal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tech_sequencesqlcommandes`
--

CREATE TABLE IF NOT EXISTS `tech_sequencesqlcommandes` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `NomSequence` varchar(255) DEFAULT NULL,
  `OrdreSeq` mediumtext,
  `Ref_Ext_SQLCommande` mediumtext,
  `Valide` tinyint(4) DEFAULT '-1',
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tech_sqlcommandespartaches`
--

CREATE TABLE IF NOT EXISTS `tech_sqlcommandespartaches` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `NomUnique` varchar(255) DEFAULT NULL,
  `SQL` longtext,
  `CommandeType` varchar(255) DEFAULT NULL,
  `NombreVariables` mediumtext,
  `CodeVariableTexte` varchar(255) DEFAULT NULL,
  `CodeVariableDate` varchar(255) DEFAULT NULL,
  `CodeVariableEntier` varchar(255) DEFAULT NULL,
  `FormatIndexVariable` varchar(255) DEFAULT NULL,
  `ListeChamps` varchar(255) DEFAULT NULL,
  `ListeFormat` varchar(255) DEFAULT NULL,
  `Categorie` varchar(255) DEFAULT NULL,
  `Tache` varchar(255) DEFAULT NULL,
  `Ordre` varchar(255) DEFAULT NULL,
  `Valide` tinyint(4) DEFAULT '-1',
  PRIMARY KEY (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `verifconnex`
--

CREATE TABLE IF NOT EXISTS `verifconnex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DateAccess` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `verifconnex`
--

INSERT INTO `verifconnex` (`id`, `DateAccess`) VALUES
(1, '2015-05-04 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
