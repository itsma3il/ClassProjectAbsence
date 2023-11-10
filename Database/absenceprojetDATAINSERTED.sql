-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2023 at 11:06 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenceprojet`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `CalculateStudentNote`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculateStudentNote` (IN `MatriculeParam` VARCHAR(11))  BEGIN
    DECLARE TotalHours DECIMAL(5, 2);
    DECLARE DaysAbsent DECIMAL(5, 2);
    DECLARE Note DECIMAL(5, 2);

    -- Calculate the total hours of absence for the student with the given Cin
    SELECT IFNULL(SUM(nbHeures), 0) INTO TotalHours
    FROM absence
    WHERE StagiaireCin = MatriculeParam AND justification IS NULL;

    -- Calculate the number of days absent based on 10 hours per day
    SET DaysAbsent = TotalHours / 10;

    -- Calculate the student's note based on DaysAbsent
    SET Note = 20 - ((DaysAbsent * 20) / 20);
    
    -- Update the calculated note in the stagiaire table
    UPDATE stagiaire
    SET noteDisciplinaire = Note
    WHERE cin = MatriculeParam;

    -- Return the student's note
    SELECT Note AS 'Student Note';
END$$

DROP PROCEDURE IF EXISTS `GetAbsenceCount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAbsenceCount` (IN `MatriculeParam` VARCHAR(11))  BEGIN
    DECLARE AbsenceCount INT;

    SELECT COUNT(*) INTO AbsenceCount
    FROM absence
    WHERE StagiaireCin = MatriculeParam;

    SELECT AbsenceCount AS 'Absence Count';
END$$

DROP PROCEDURE IF EXISTS `ShowAbsenceHours`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ShowAbsenceHours` (IN `MatriculeParam` VARCHAR(11))  BEGIN
    DECLARE HoursWithJustification DECIMAL(5, 2);
    DECLARE HoursWithoutJustification DECIMAL(5, 2);
    DECLARE DaysWithJustification DECIMAL(5, 2);
    DECLARE DaysWithoutJustification DECIMAL(5, 2);

    -- Calculate the total hours of absence with justification for the student
    SELECT IFNULL(SUM(nbHeures), 0) INTO HoursWithJustification
    FROM absence
    WHERE StagiaireCin = MatriculeParam AND justification IS NOT NULL;

    -- Calculate the total hours of absence without justification for the student
    SELECT IFNULL(SUM(nbHeures), 0) INTO HoursWithoutJustification
    FROM absence
    WHERE StagiaireCin = MatriculeParam AND justification IS NULL;

    -- Calculate the total days of absence based on 10 hours per day
    SET DaysWithJustification = HoursWithJustification / 10;
    SET DaysWithoutJustification = HoursWithoutJustification / 10;

    -- Return the results
    SELECT
        HoursWithJustification AS 'Hours With Justification',
        HoursWithoutJustification AS 'Hours Without Justification',
        DaysWithJustification AS 'Days With Justification',
        DaysWithoutJustification AS 'Days Without Justification';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `AbsenceID` int(11) NOT NULL AUTO_INCREMENT,
  `StagiaireCin` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `nbHeures` int(11) NOT NULL,
  `justification` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`AbsenceID`),
  KEY `FK_Abs_Stg` (`StagiaireCin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `absence`
--
DROP TRIGGER IF EXISTS `AfterInsertAbsence`;
DELIMITER $$
CREATE TRIGGER `AfterInsertAbsence` AFTER INSERT ON `absence` FOR EACH ROW BEGIN
    DECLARE TotalHours DECIMAL(5, 2);
    DECLARE DaysAbsent DECIMAL(5, 2);
    DECLARE Note DECIMAL(5, 2);

    -- Calculate the total hours of absence for the student with the given Cin
    SELECT IFNULL(SUM(nbHeures), 0) INTO TotalHours
    FROM absence
    WHERE StagiaireCin = NEW.StagiaireCin AND justification IS NULL;

    -- Calculate the number of days absent based on 10 hours per day
    SET DaysAbsent = TotalHours / 10;

    -- Calculate the student's note based on DaysAbsent
    SET Note = 20 - ((DaysAbsent * 20) / 20);

    -- Update the calculated note in the stagiaire table
    UPDATE stagiaire
    SET noteDisciplinaire = Note
    WHERE cin = NEW.StagiaireCin;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `AfterUpdateAbsence`;
DELIMITER $$
CREATE TRIGGER `AfterUpdateAbsence` AFTER UPDATE ON `absence` FOR EACH ROW BEGIN
    DECLARE TotalHours DECIMAL(5, 2);
    DECLARE DaysAbsent DECIMAL(5, 2);
    DECLARE Note DECIMAL(5, 2);

    -- Calculate the total hours of absence for the student with the given Cin
    SELECT IFNULL(SUM(nbHeures), 0) INTO TotalHours
    FROM absence
    WHERE StagiaireCin = NEW.StagiaireCin AND justification IS NULL;

    -- Calculate the number of days absent based on 10 hours per day
    SET DaysAbsent = TotalHours / 10;

    -- Calculate the student's note based on DaysAbsent
    SET Note = 20 - ((DaysAbsent * 20) / 20);

    -- Update the calculated note in the stagiaire table
    UPDATE stagiaire
    SET noteDisciplinaire = Note
    WHERE cin = NEW.StagiaireCin;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `BeforeDeleteAbsence`;
DELIMITER $$
CREATE TRIGGER `BeforeDeleteAbsence` BEFORE DELETE ON `absence` FOR EACH ROW BEGIN
    DECLARE TotalHours DECIMAL(5, 2);
    DECLARE DaysAbsent DECIMAL(5, 2);
    DECLARE Note DECIMAL(5, 2);

    -- Calculate the total hours of absence for the student with the given Cin
    SELECT IFNULL(SUM(nbHeures), 0) INTO TotalHours
    FROM absence
    WHERE StagiaireCin = OLD.StagiaireCin AND justification IS NULL;

    -- Calculate the number of days absent based on 10 hours per day
    SET DaysAbsent = TotalHours / 10;

    -- Calculate the student's note based on DaysAbsent
    SET Note = 20 - ((DaysAbsent * 20) / 20);

    -- Update the calculated note in the stagiaire table
    UPDATE stagiaire
    SET noteDisciplinaire = Note
    WHERE cin = OLD.StagiaireCin;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `avertissement`
--

DROP TABLE IF EXISTS `avertissement`;
CREATE TABLE IF NOT EXISTS `avertissement` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `StagiaireCin` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` enum('Mise en garde','Avertissement','Exclusion de 2j','Exclusion temporaire CD','Exclusion définitif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateAverti` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code`),
  KEY `FK_Avertissement_Stg` (`StagiaireCin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `cin` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Niveau` enum('1ere annee','2eme annee') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1ere annee ou 2eme annee',
  `groupe` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comme "DEV100"',
  `dateNaissance` date NOT NULL,
  `noteDisciplinaire` decimal(10,2) NOT NULL DEFAULT '20.00',
  PRIMARY KEY (`cin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`cin`, `nom`, `prenom`, `Niveau`, `groupe`, `dateNaissance`, `noteDisciplinaire`) VALUES
('BK736256', 'MAATAOUI', 'SALAH EDDINE', '1ere annee', 'DEV109', '2005-06-12', '20.00'),
('E263182', 'BENCHAHID', 'AHLAM', '1ere annee', 'DEV107', '2005-05-19', '20.00'),
('EA229155', 'ED-DAHHAK', 'AYMANE', '1ere annee', 'DEV102', '2000-09-08', '20.00'),
('EA244085', 'N\'AIT IHYA', 'YASSINE', '1ere annee', 'DEV107', '2002-05-08', '20.00'),
('EA250031', 'BOUNOU', 'FATIMA ZAHRA', '1ere annee', 'DEV102', '2004-07-06', '20.00'),
('EA255374', 'NAJEM', 'KHAOULA', '1ere annee', 'DEV103', '2003-11-16', '20.00'),
('EA256452', 'LAHDILI', 'FATIMA EZZAHRAE', '1ere annee', 'DEV107', '2004-11-22', '20.00'),
('EA261564', 'HORRA', 'MOHAMED', '1ere annee', 'DEV103', '2004-07-02', '20.00'),
('EA262183', 'ER-RADY', 'OUMAIMA', '1ere annee', 'DEV107', '2005-05-18', '20.00'),
('EC72256', 'BEN EL FAQIH', 'ABDELKHALEK', '1ere annee', 'DEV104', '2002-11-03', '20.00'),
('EC77966', 'BALAKHCHA', 'MAROUAN', '1ere annee', 'DEV104', '2003-06-22', '20.00'),
('EC78447', 'CHINOUNE', 'ANOUAR', '1ere annee', 'DEV109', '2001-05-29', '20.00'),
('EC96158', 'ABOUTARIK', 'JMIA', '1ere annee', 'DEV112', '2005-08-19', '20.00'),
('EE168996', 'EL HOURI', 'MOHAMED RACHID', '1ere annee', 'DEV103', '2005-06-13', '20.00'),
('EE169105', 'EL GUETTAFI', 'SOUKAINA', '1ere annee', 'DEV107', '2004-10-24', '20.00'),
('EE178023', 'ABOUHANBAL', 'AIMRANE', '1ere annee', 'DEV111', '2005-12-26', '20.00'),
('EE178694', 'CHARIFA', 'BELGUEROUA', '1ere annee', 'DEV112', '2005-04-07', '20.00'),
('EE242348', 'GORTAT', 'AYOUB', '1ere annee', 'DEV107', '2005-10-11', '20.00'),
('EE278033', 'AIT BRAIM', 'IKRAM', '1ere annee', 'DEV101', '2005-11-07', '20.00'),
('EE278573', 'TALHI', 'AHMED', '1ere annee', 'DEV103', '2006-03-16', '20.00'),
('EE279122', 'CHAFFAF', 'MAHA', '1ere annee', 'DEV107', '2005-06-24', '20.00'),
('EE301050', 'ELAZZAOUY', 'HIBA', '1ere annee', 'DEV110', '2006-07-03', '20.00'),
('EE301418', 'ELGHAYABI', 'IKRAM', '1ere annee', 'DEV112', '2006-01-18', '20.00'),
('EE301853', 'EL AAMERY', 'HAITAM', '1ere annee', 'DEV107', '2006-01-21', '20.00'),
('EE301957', 'AKHIATE', 'MOHAMED ADAM', '1ere annee', 'DEV105', '2006-02-16', '20.00'),
('EE320128', 'MANSOURI', 'BARA\'E', '1ere annee', 'DEV101', '2005-12-14', '20.00'),
('EE390037', 'KAMAL', 'OUISSAL', '1ere annee', 'DEV110', '2005-10-10', '20.00'),
('EE390038', 'KAMAL', 'HIBA', '1ere annee', 'DEV109', '2005-11-10', '20.00'),
('EE416574', 'HMIMID', 'ILYASS', '1ere annee', 'DEV105', '2005-03-13', '20.00'),
('EE434533', 'AACHCHAQ', 'ABDERRAHMANE', '1ere annee', 'DEV109', '2006-01-03', '20.00'),
('EE434704', 'ELKHAYAT', 'MEHDI', '1ere annee', 'DEV112', '2005-09-14', '20.00'),
('EE472196', 'BOU EL HRAJANE', 'EL MEHDI', '1ere annee', 'DEV111', '2005-09-28', '20.00'),
('EE483019', 'BAYDDOU', 'AYOUB', '1ere annee', 'DEV112', '2004-01-11', '20.00'),
('EE484158', 'AIT MOUSSE', 'MEHDI', '1ere annee', 'DEV110', '2005-03-21', '20.00'),
('EE484589', 'HAMZA', 'YASSINE', '1ere annee', 'DEV107', '2005-01-02', '20.00'),
('EE485205', 'OUABI', 'SALMA', '1ere annee', 'DEV104', '2004-01-08', '20.00'),
('EE485940', 'AMAARRAS', 'SALIM', '1ere annee', 'DEV107', '2005-06-24', '20.00'),
('EE486248', 'EZOUIZI', 'JAMILA', '1ere annee', 'DEV102', '2004-08-20', '20.00'),
('EE486634', 'BEN ABDELKRIM', 'HOUSSAM', '1ere annee', 'DEV103', '2005-05-07', '20.00'),
('EE488261', 'EL AOUFI', 'NOURA', '1ere annee', 'DEV103', '2005-09-30', '20.00'),
('EE505263', 'BENHSSAIN', 'HOUDA', '1ere annee', 'DEV109', '2005-02-04', '20.00'),
('EE505494', 'AIT ADDI', 'ICHRAQ', '1ere annee', 'DEV108', '2005-07-10', '20.00'),
('EE570254', 'TALBI', 'YOUSSEF', '1ere annee', 'DEV111', '2004-07-08', '20.00'),
('EE590085', 'OUBELAID', 'HOUDAIFA', '1ere annee', 'DEV110', '2004-03-22', '20.00'),
('EE590096', 'IBBA-ALI', 'MOHAMED', '1ere annee', 'DEV111', '2004-09-18', '20.00'),
('EE621088', 'ZAHID', 'ABDELKAYOUM', '1ere annee', 'DEV104', '1996-05-05', '20.00'),
('EE628879', 'ELFANE', 'YOUSRA', '1ere annee', 'DEV102', '1995-12-25', '20.00'),
('EE640937', 'ALJARRARI', 'YASSINE', '1ere annee', 'DEV107', '1999-07-10', '20.00'),
('EE647835', 'BENCHAFIA', 'SAAD', '1ere annee', 'DEV104', '2000-07-07', '20.00'),
('EE650636', 'EL KOURI', 'ZAHIRA', '1ere annee', 'DEV102', '2000-06-16', '20.00'),
('EE652437', 'ELKKERM', 'SAMIRA', '1ere annee', 'DEV106', '2000-08-14', '20.00'),
('EE654214', 'ELBARJI', 'ABDERRAHMAN', '1ere annee', 'DEV112', '2001-03-03', '20.00'),
('EE663763', 'TABET', 'MALAK', '1ere annee', 'DEV101', '2004-06-04', '20.00'),
('EE664989', 'LAHLANE', 'OTHMANE', '1ere annee', 'DEV109', '2001-06-09', '20.00'),
('EE667624', 'ELHOUARI', 'SAMIRA', '1ere annee', 'DEV102', '2002-06-05', '20.00'),
('EE667635', 'SLIMANI', 'ABDERRAHMAN', '1ere annee', 'DEV111', '1998-02-27', '20.00'),
('EE670550', 'BENRAISS', ' ANAS', '1ere annee', 'DEV109', '1999-09-09', '20.00'),
('EE672140', 'OUAHMOUDOU', 'ILYAS', '1ere annee', 'DEV101', '2004-09-04', '20.00'),
('EE673532', 'ELMASOUDI', 'OUSSAMA', '1ere annee', 'DEV112', '2002-11-28', '20.00'),
('EE674455', 'AIT TALEB', 'SANA', '1ere annee', 'DEV111', '2002-01-19', '20.00'),
('EE674984', 'OUHADI', 'JAMILA', '1ere annee', 'DEV104', '2001-11-16', '20.00'),
('EE677322', 'DORAID', 'HANANE', '1ere annee', 'DEV108', '2002-11-03', '20.00'),
('EE679519', 'SALHI', 'MOURAD', '1ere annee', 'DEV109', '2002-07-03', '20.00'),
('EE679705', 'KRIBI', 'MOHAMED KARIM', '1ere annee', 'DEV111', '2002-11-08', '20.00'),
('EE679892', 'SUIBA', 'INSAF', '1ere annee', 'DEV106', '2003-09-11', '20.00'),
('EE682006', 'AIT BOURICE', 'MOHAMED', '1ere annee', 'DEV104', '2003-05-14', '20.00'),
('EE682205', 'BANDOSSE', 'KENZA', '1ere annee', 'DEV101', '2004-12-01', '20.00'),
('EE684738', 'AMEZDAOU', 'HAJAR', '1ere annee', 'DEV104', '2003-04-01', '20.00'),
('EE685733', 'ZOUINE', 'AYA', '1ere annee', 'DEV110', '2004-09-01', '20.00'),
('EE687433', 'HIMD', 'ABDELLAH', '1ere annee', 'DEV112', '2001-01-01', '20.00'),
('EE689849', 'TARIKI', 'MOHAMED ANAS', '1ere annee', 'DEV106', '2002-01-26', '20.00'),
('EE690154', 'MARDAT', 'MOUAD', '1ere annee', 'DEV110', '2003-03-31', '20.00'),
('EE691121', 'ELMISSI', 'SARA', '1ere annee', 'DEV101', '2004-01-08', '20.00'),
('EE691293', 'EL ANSSARI', 'NOUHAILA', '1ere annee', 'DEV106', '2002-09-08', '20.00'),
('EE694848', 'ELMAHDAOUI', 'OUMAIMA', '1ere annee', 'DEV107', '2001-11-01', '20.00'),
('EE697625', 'FATTAMI', 'AYOUB', '1ere annee', 'DEV103', '2003-04-29', '20.00'),
('EE697847', 'BEN ADDI', 'ABDESSAMAD', '1ere annee', 'DEV101', '2002-02-26', '20.00'),
('EE698593', 'LATIF', 'MALIKA', '1ere annee', 'DEV105', '2001-08-19', '20.00'),
('EE699203', 'EL AMRANI', 'ABDELHAMID', '1ere annee', 'DEV103', '2003-02-16', '20.00'),
('EE699944', 'EL HOUBRI', 'ZAKARYA', '1ere annee', 'DEV101', '2003-08-27', '20.00'),
('EE738221', 'ARIF', 'ADAM', '1ere annee', 'DEV109', '2000-11-30', '20.00'),
('EE748345', 'ELFARIKH', 'SARA', '1ere annee', 'DEV104', '2004-11-08', '20.00'),
('EE748481', 'GHANJIRI', 'NOUHAILA', '1ere annee', 'DEV106', '2004-03-12', '20.00'),
('EE751055', 'ELMAHDAOUI', 'YASSIR', '1ere annee', 'DEV106', '2004-11-08', '20.00'),
('EE751358', 'SASSAOUI', 'YASSER', '1ere annee', 'DEV106', '2005-01-01', '20.00'),
('EE751790', 'OUTLIT', 'SAAD', '1ere annee', 'DEV109', '2003-07-16', '20.00'),
('EE751862', 'ELHOUR', 'KAMAL', '1ere annee', 'DEV105', '2005-04-01', '20.00'),
('EE753029', 'KARIM', 'HIBA', '1ere annee', 'DEV106', '2002-10-10', '20.00'),
('EE753118', 'ELOUARAOUI', 'ABDELOUAHED', '1ere annee', 'DEV103', '2003-04-29', '20.00'),
('EE753700', 'MARKHI', 'SARA', '1ere annee', 'DEV111', '2004-06-25', '20.00'),
('EE753907', 'NEMROUCH', 'SOUMIA', '1ere annee', 'DEV109', '2003-11-17', '20.00'),
('EE755722', 'BENHAROU', 'ILIAS', '1ere annee', 'DEV105', '2005-12-15', '20.00'),
('EE756031', 'BASSOR', 'OUSSAMA', '1ere annee', 'DEV103', '2005-10-31', '20.00'),
('EE756544', 'ICHKHAKH', 'ANAS', '1ere annee', 'DEV101', '2005-09-07', '20.00'),
('EE761014', 'CHRARTI', 'SOMIA', '1ere annee', 'DEV110', '1997-08-15', '20.00'),
('EE779369', 'SEKHAL', 'AMINE', '1ere annee', 'DEV105', '2005-03-23', '20.00'),
('EE779609', 'DOUISSY', 'MOHCINE', '1ere annee', 'DEV106', '2003-11-22', '20.00'),
('EE779646', 'ABBAD', 'AYMANE', '1ere annee', 'DEV102', '2005-05-13', '20.00'),
('EE779905', 'MOUNCIR', 'OUMNIA', '1ere annee', 'DEV102', '2006-01-25', '20.00'),
('EE780145', 'BARROU', 'ILIASS', '1ere annee', 'DEV103', '2006-02-16', '20.00'),
('EE780272', 'HRIGUICH', 'ZAINEB', '1ere annee', 'DEV102', '2005-12-23', '20.00'),
('EE81309', 'BAREK', 'ABDERRAHMANE', '1ere annee', 'DEV108', '2005-06-06', '20.00'),
('EE81435', 'HASSAY', 'ABDARRAHIME', '1ere annee', 'DEV105', '2004-11-22', '20.00'),
('EE81538', 'ROUFISSE', 'BADR', '1ere annee', 'DEV104', '2005-07-30', '20.00'),
('EE81610', 'DERDAK', 'SARA', '1ere annee', 'DEV103', '2006-03-25', '20.00'),
('EE818078', 'AIT BRAHIM', 'RIDA', '1ere annee', 'DEV102', '1997-12-12', '20.00'),
('EE82358', 'BENBBA', 'AMINE', '1ere annee', 'DEV112', '2004-12-23', '20.00'),
('EE827409', 'SABIRI', 'AHMED', '1ere annee', 'DEV108', '2004-02-16', '20.00'),
('EE828156', 'BARGHAZI', 'RANIA', '1ere annee', 'DEV102', '1998-05-28', '20.00'),
('EE830885', 'EL HAMDAOUI', 'IMANE', '1ere annee', 'DEV108', '2003-08-24', '20.00'),
('EE834568', 'NMILI', 'ADIL', '1ere annee', 'DEV106', '1998-09-23', '20.00'),
('EE839639', 'KHAOUIRY', 'NADIA', '1ere annee', 'DEV102', '2000-03-13', '20.00'),
('EE843799', 'EL IDRISSI', 'ABDELMOUNAIM', '1ere annee', 'DEV105', '1998-08-17', '20.00'),
('EE84400', 'BOUTIRA', 'OUSSAMA', '1ere annee', 'DEV110', '2006-02-27', '20.00'),
('EE84699', 'BAANI', 'KAOUTAR', '1ere annee', 'DEV110', '2005-03-09', '20.00'),
('EE84798', 'SAADOUNI', 'MONSEF', '1ere annee', 'DEV111', '2005-10-12', '20.00'),
('EE85039', 'GHOUSMI', 'IKRAM', '1ere annee', 'DEV112', '2005-11-11', '20.00'),
('EE85201', 'LAICHOUCHI', 'AYA', '1ere annee', 'DEV105', '2006-02-17', '20.00'),
('EE852036', 'BOUMJAHID', 'SALMA', '1ere annee', 'DEV108', '2003-12-02', '20.00'),
('EE853652', 'AIT ZENNI', 'SALAH EDDINE', '1ere annee', 'DEV103', '1997-08-08', '20.00'),
('EE854333', 'HAJHOUJ', 'AYMANE', '1ere annee', 'DEV103', '2000-04-23', '20.00'),
('EE85641', 'TIRAR', 'MOHAMED TAHER', '1ere annee', 'DEV103', '2005-11-20', '20.00'),
('EE857125', 'HIMMI', 'MOHAMMED', '1ere annee', 'DEV108', '1999-10-23', '20.00'),
('EE860115', 'BERRAHO', 'SAFAE', '1ere annee', 'DEV108', '2004-01-30', '20.00'),
('EE873258', 'BOUMRAH', 'AYA', '1ere annee', 'DEV112', '2002-12-31', '20.00'),
('EE873268', 'JABRI', 'ZINEB', '1ere annee', 'DEV106', '2004-10-05', '20.00'),
('EE873687', 'OUYOUSSEF', 'WAFA', '1ere annee', 'DEV104', '2003-07-04', '20.00'),
('EE874226', 'EL GARGATI', 'MOHAMMED', '1ere annee', 'DEV103', '2004-07-26', '20.00'),
('EE874405', 'ASSAL', 'WALID', '1ere annee', 'DEV104', '2003-06-26', '20.00'),
('EE875037', 'EL ASKALANI', 'NOUHAILA', '1ere annee', 'DEV107', '2005-03-02', '20.00'),
('EE875926', 'MEHDAOUI', 'CHAIMA', '1ere annee', 'DEV104', '2004-07-24', '20.00'),
('EE875934', 'AAMIMI', 'YOUSSEF', '1ere annee', 'DEV105', '2004-07-14', '20.00'),
('EE876610', 'ER-RISSOUNI', 'NADA', '1ere annee', 'DEV112', '2004-11-20', '20.00'),
('EE876698', 'CHOUIRGUI', 'SAFAA', '1ere annee', 'DEV107', '2003-11-18', '20.00'),
('EE87697', 'CHAIB', 'OUALID', '1ere annee', 'DEV103', '2005-10-09', '20.00'),
('EE877123', 'BOUZOUGGAR', 'ABDELHAK', '1ere annee', 'DEV111', '2003-12-14', '20.00'),
('EE877253', 'SABRI', 'KHADIJA', '1ere annee', 'DEV103', '2005-01-25', '20.00'),
('EE877610', 'RAIS', 'HATIM', '1ere annee', 'DEV107', '2004-01-23', '20.00'),
('EE877903', 'HAMIMADI', 'SOUKAINA', '1ere annee', 'DEV110', '2004-02-03', '20.00'),
('EE87808', 'CHANTIT', 'IKBAL', '1ere annee', 'DEV101', '2005-08-17', '20.00'),
('EE878102', 'TEMTAM', 'JAAFAR', '1ere annee', 'DEV108', '2003-03-26', '20.00'),
('EE878975', 'ZARRAQI', 'ZINEB', '1ere annee', 'DEV108', '2005-06-16', '20.00'),
('EE87945', 'MAMOUNI', 'SAAD', '1ere annee', 'DEV101', '2005-05-25', '20.00'),
('EE88124', 'SAOUN', 'MOHAMED', '1ere annee', 'DEV111', '2004-04-28', '20.00'),
('EE881949', 'ECHAHOUR', 'HAMZA', '1ere annee', 'DEV110', '2003-07-19', '20.00'),
('EE882025', 'BEN KARROUM', 'FATIMA EZZAHRA', '1ere annee', 'DEV105', '2003-06-27', '20.00'),
('EE883005', 'EL AAMRANI', 'IMANE', '1ere annee', 'DEV108', '2004-05-28', '20.00'),
('EE884746', 'AIT ALI OU BRAHIM', 'KAOUTAR', '1ere annee', 'DEV105', '2004-05-03', '20.00'),
('EE884903', 'AFFROUKH', 'OUMAIMA', '1ere annee', 'DEV109', '2005-12-06', '20.00'),
('EE884979', 'RIDA', 'LADIB', '1ere annee', 'DEV103', '2006-03-12', '20.00'),
('EE885825', 'SNIBA', 'AYA', '1ere annee', 'DEV110', '2004-12-29', '20.00'),
('EE887116', 'BAAD', 'ABDERRAHIM', '1ere annee', 'DEV112', '2004-01-06', '20.00'),
('EE887284', 'MOUMEN', 'SIHAM', '1ere annee', 'DEV101', '2004-06-22', '20.00'),
('EE887397', 'QSSITI', 'ILIAS', '1ere annee', 'DEV111', '2005-01-05', '20.00'),
('EE887453', 'LAARIFI', 'AMAL', '1ere annee', 'DEV107', '2003-07-20', '20.00'),
('EE887479', 'TAMRI', 'AYOUB', '1ere annee', 'DEV111', '2004-06-15', '20.00'),
('EE887484', 'EZ-ZAHIRI', 'IMANE', '1ere annee', 'DEV110', '2003-11-27', '20.00'),
('EE887525', 'SARI', 'MOHAMED', '1ere annee', 'DEV111', '2004-09-25', '20.00'),
('EE887869', 'JAMMAKHI', 'CHAIMAE', '1ere annee', 'DEV101', '2005-01-09', '20.00'),
('EE888269', 'ZOUINE', 'GHIZLANE', '1ere annee', 'DEV112', '2004-10-10', '20.00'),
('EE888634', 'FOUASSI', 'KHADIJA', '1ere annee', 'DEV104', '2005-05-01', '20.00'),
('EE889067', 'GARTI', 'ANAS', '1ere annee', 'DEV112', '2004-06-29', '20.00'),
('EE889126', 'KOUBI', 'MOHAMED', '1ere annee', 'DEV107', '2004-10-29', '20.00'),
('EE889146', 'ERRABIAI', 'ANWAR', '1ere annee', 'DEV109', '2004-07-06', '20.00'),
('EE889323', 'EL BENNA', 'RIYAD', '1ere annee', 'DEV106', '2005-06-07', '20.00'),
('EE891568', 'AIT AHMAD OUALI', 'ZAKARIA', '1ere annee', 'DEV104', '2005-11-05', '20.00'),
('EE892422', 'RAFIQ', 'YASSINE', '1ere annee', 'DEV112', '2004-05-17', '20.00'),
('EE892612', 'HAMDOUNE', 'KAWTAR', '1ere annee', 'DEV108', '2004-04-14', '20.00'),
('EE893204', 'ASRYA', 'SARA', '1ere annee', 'DEV108', '2005-09-20', '20.00'),
('EE894430', ' ER.RADI', 'ABDERRAHMANE', '1ere annee', 'DEV110', '2004-12-14', '20.00'),
('EE894834', 'CHATIBI', 'MOHAMMED', '1ere annee', 'DEV108', '2004-02-15', '20.00'),
('EE895206', 'TAI', 'BADREDDINE', '1ere annee', 'DEV111', '2005-05-18', '20.00'),
('EE895477', 'OUTOUCHENTE', 'OUSSAMA', '1ere annee', 'DEV102', '2004-12-28', '20.00'),
('EE896319', 'ABOULHAB', 'AHMED', '1ere annee', 'DEV108', '2005-07-22', '20.00'),
('EE896409', 'EL KARKOURI', 'HAMZA', '1ere annee', 'DEV108', '2002-02-16', '20.00'),
('EE897375', 'EL IDRISSI SALMI', 'AFNANE', '1ere annee', 'DEV108', '2004-08-16', '20.00'),
('EE898203', 'AIT ALLA', 'MUSTAPHA', '1ere annee', 'DEV112', '2004-10-10', '20.00'),
('EE898233', 'SOUHJOUD', 'ABDERRAZZAK', '1ere annee', 'DEV112', '2005-09-25', '20.00'),
('EE904437', 'EL GOURKANI', 'SARA', '1ere annee', 'DEV108', '2005-11-03', '20.00'),
('EE906204', 'HMISSA', 'OUSSAMA', '1ere annee', 'DEV108', '2004-11-05', '20.00'),
('EE909048', 'JIALANE', 'AYOUB', '1ere annee', 'DEV109', '1999-07-29', '20.00'),
('EE911067', 'LAMSAOUI', 'MOHAMED', '1ere annee', 'DEV109', '1998-10-28', '20.00'),
('EE91120', 'TALA', 'ABDERRAHIM', '1ere annee', 'DEV107', '2003-06-12', '20.00'),
('EE913359', 'LBADAOUI', 'YOUSSEF', '1ere annee', 'DEV105', '2000-05-24', '20.00'),
('EE91419', 'BOUMGARD', 'YASSINE', '1ere annee', 'DEV110', '2005-06-17', '20.00'),
('EE915389', 'OUBAHA', 'MOUSTAPHA', '1ere annee', 'DEV112', '2000-07-19', '20.00'),
('EE915616', 'GARRAG', 'ABDELLAH', '1ere annee', 'DEV104', '2000-07-20', '20.00'),
('EE91583', 'AIT ELOUHAB', 'MAROUANE', '1ere annee', 'DEV102', '2003-09-01', '20.00'),
('EE91834', 'EL GHABA', 'SAAD', '1ere annee', 'DEV106', '2004-08-04', '20.00'),
('EE922339', 'AIT CHEKH', 'OUMAIMA', '1ere annee', 'DEV108', '2000-07-25', '20.00'),
('EE92657', 'BANI', 'HAJAR', '1ere annee', 'DEV101', '2005-03-13', '20.00'),
('EE927558', 'HANDA', 'HANANE', '1ere annee', 'DEV108', '2004-06-06', '20.00'),
('EE92767', 'EL KHAMLICHI', 'OTHMANE', '1ere annee', 'DEV104', '2005-12-30', '20.00'),
('EE928796', 'BEN ZAHI', 'OUISSAL', '1ere annee', 'DEV106', '2002-04-12', '20.00'),
('EE930335', 'KZAIBER', 'ATIKA', '1ere annee', 'DEV102', '2001-01-20', '20.00'),
('EE933984', 'ACHIBANE', 'KENZA', '1ere annee', 'DEV108', '2004-04-13', '20.00'),
('EE93596', 'AKSAS', 'ABDESSAMIA', '1ere annee', 'DEV101', '2004-08-13', '20.00'),
('EE936066', 'IMANE', 'NAMIHI', '1ere annee', 'DEV105', '2000-07-03', '20.00'),
('EE938584', 'HALLAJI', 'ZAKARIAE', '1ere annee', 'DEV110', '1999-10-10', '20.00'),
('EE94142', 'BEN SSAOUD', 'SALMA', '1ere annee', 'DEV111', '2004-10-05', '20.00'),
('EE941514', 'EL MAMDOUHI', 'NADA', '1ere annee', 'DEV106', '2006-03-06', '20.00'),
('EE941588', 'MOUSTIK', 'ISMAIL', '1ere annee', 'DEV108', '2004-07-20', '20.00'),
('EE942222', 'KHADRAOUI', 'ABDELMOUNAIM', '1ere annee', 'DEV110', '2002-05-23', '20.00'),
('EE942757', 'EL-OURGHY', 'FARAH', '1ere annee', 'DEV109', '2001-08-08', '20.00'),
('EE943005', 'LAGRICH', 'MOHAMED', '1ere annee', 'DEV103', '2000-05-18', '20.00'),
('EE94606', 'BAOULI', 'SAAD', '1ere annee', 'DEV106', '2004-10-23', '20.00'),
('EE946822', 'ALAOUI', 'ABDELHADI', '1ere annee', 'DEV108', '2004-10-15', '20.00'),
('EE946999', 'ESSAFIR', 'KHAWLA', '1ere annee', 'DEV112', '2001-02-25', '20.00'),
('EE949721', 'AIT OUNEFLOUS', 'HAMZA', '1ere annee', 'DEV109', '2002-09-18', '20.00'),
('EE949749', 'LAGOUILLY', 'TARIQ', '1ere annee', 'DEV107', '2001-05-26', '20.00'),
('EE95599', 'WAHAB', 'YOUSSEF', '1ere annee', 'DEV106', '2004-01-02', '20.00'),
('EE95634', 'BENSALAH', 'ZINEB', '1ere annee', 'DEV108', '2005-07-16', '20.00'),
('EE957169', 'ABNINI', 'MOSTAFA', '1ere annee', 'DEV108', '2001-12-04', '20.00'),
('EE958394', 'ALAMI', 'RAJAA', '1ere annee', 'DEV108', '2003-09-11', '20.00'),
('EE95925', 'ZIZA', 'CHAIMA', '1ere annee', 'DEV101', '2004-09-14', '20.00'),
('EE961187', 'SOUABNI', 'MONA', '1ere annee', 'DEV111', '2001-07-05', '20.00'),
('EE96172', 'EL MOUJAHID', 'ABDELAZIZ', '1ere annee', 'DEV104', '2003-02-09', '20.00'),
('EE963165', 'ASSAOUD', 'WAFAE', '1ere annee', 'DEV108', '2002-07-08', '20.00'),
('EE964768', 'CHAKIR', 'IMANE', '1ere annee', 'DEV108', '2004-08-04', '20.00'),
('EE966312', 'LAGHCHIM', 'AYOUB', '1ere annee', 'DEV105', '2003-08-10', '20.00'),
('EE966834', 'MOUATIQI', 'MOHAMED', '1ere annee', 'DEV110', '2004-06-29', '20.00'),
('EE967385', 'TALAKAKINE', 'SALMA', '1ere annee', 'DEV109', '2005-03-12', '20.00'),
('EE968170', 'EL HAKMI', 'ANAS', '1ere annee', 'DEV108', '2002-05-26', '20.00'),
('EE968683', 'GHAZOUAN', ' MOHAMED', '1ere annee', 'DEV105', '2002-08-12', '20.00'),
('EE970859', 'BIRAMA', 'ABDESSADEK', '1ere annee', 'DEV103', '2004-08-24', '20.00'),
('EE971428', 'MAKROUN', 'SOULAIMANE', '1ere annee', 'DEV108', '2003-01-12', '20.00'),
('EE971476', 'ALQOUCH', 'WALID', '1ere annee', 'DEV110', '2002-07-28', '20.00'),
('EE971696', 'OUAFI', 'DOUNIA', '1ere annee', 'DEV112', '2002-08-24', '20.00'),
('EE972111', 'FATIMA EZZAHRA', 'EL ASSABI', '1ere annee', 'DEV107', '2003-07-20', '20.00'),
('EE972121', 'AIT EL GAZZAR', 'YASSINE', '1ere annee', 'DEV108', '2004-07-28', '20.00'),
('EE972447', 'M\'HAND', 'ABDELOUAHED', '1ere annee', 'DEV108', '2003-07-29', '20.00'),
('EE972786', 'TOUGHZOUT', 'YOUNESS', '1ere annee', 'DEV110', '2003-06-25', '20.00'),
('EE97553', 'EL FATIMY', 'EL MEHDI', '1ere annee', 'DEV102', '2004-03-25', '20.00'),
('EE977066', 'KHABIDI', 'HAMZA', '1ere annee', 'DEV109', '2002-02-21', '20.00'),
('EE98131', 'EL BAKOURI', 'MEHDI', '1ere annee', 'DEV101', '2005-09-05', '20.00'),
('EE981947', 'AIT MOHAMED', 'OUSSAMA', '1ere annee', 'DEV102', '2004-01-03', '20.00'),
('EE981964', 'BELATTAR', 'SARA', '1ere annee', 'DEV108', '2004-10-15', '20.00'),
('EE981976', 'EL-MALIKY', 'AYA', '1ere annee', 'DEV111', '2004-06-06', '20.00'),
('EE98225', 'AIT CHKIH', 'ROUMAYSSA', '1ere annee', 'DEV101', '2006-02-25', '20.00'),
('EE982727', 'CHABBI', 'IMANE', '1ere annee', 'DEV102', '2004-07-09', '20.00'),
('EE983681', 'BENNAHIM', 'ZINEB', '1ere annee', 'DEV104', '2004-03-26', '20.00'),
('EE984324', 'SARSAR', 'ANAS', '1ere annee', 'DEV106', '2004-02-12', '20.00'),
('EE985812', 'FETTAH', 'ILYAS', '1ere annee', 'DEV105', '2004-02-01', '20.00'),
('EE985980', 'FATHALLAH', 'LAMIAA', '1ere annee', 'DEV105', '2004-07-05', '20.00'),
('EE986376', 'YAICH', 'NOUAMAN', '1ere annee', 'DEV106', '2004-05-05', '20.00'),
('EE98650', 'TALEB', 'SARA', '1ere annee', 'DEV108', '2003-10-24', '20.00'),
('EE986519', 'AIT BELFADIL', 'YOUSSEF', '1ere annee', 'DEV101', '2003-05-02', '20.00'),
('EE98737', 'ELBANNA', 'KHALID', '1ere annee', 'DEV102', '2004-09-24', '20.00'),
('EE98738', 'ABDELILLAH', 'EL HADDAOUI', '1ere annee', 'DEV109', '2004-09-02', '20.00'),
('EE987901', 'KHATIM', 'WASSIM', '1ere annee', 'DEV108', '2004-10-16', '20.00'),
('EE990000', 'ALIOUA', 'ABDELLAH', '1ere annee', 'DEV101', '2005-11-28', '20.00'),
('EE990288', 'LAADARI', 'HAMZA', '1ere annee', 'DEV112', '2004-06-04', '20.00'),
('EE990851', 'SOUFIA', 'EL HABTI', '1ere annee', 'DEV102', '2004-05-18', '20.00'),
('EE990958', 'AOUAQ', 'MOHAMED', '1ere annee', 'DEV110', '2005-02-12', '20.00'),
('EE991087', 'ETTALBI', 'AYOUB', '1ere annee', 'DEV101', '2005-01-01', '20.00'),
('EE992685', ' BOUCHAMA', 'AKRAM', '1ere annee', 'DEV101', '2003-02-12', '20.00'),
('EE992742', 'AZZI', 'AOUTMANE', '1ere annee', 'DEV108', '2004-06-04', '20.00'),
('EE994274', 'SOUKARNOU', 'TAHA', '1ere annee', 'DEV104', '2003-02-10', '20.00'),
('EE995552', 'AZLOU', 'KHADIJA', '1ere annee', 'DEV105', '2003-07-11', '20.00'),
('EE995639', 'AALOUANI', 'SOUMIA', '1ere annee', 'DEV104', '2002-05-29', '20.00'),
('EE995652', 'OUARGUIG', 'ABDESSAMAD', '1ere annee', 'DEV107', '2004-01-13', '20.00'),
('EE996072', 'AMENZOU', 'IBTISSAM', '1ere annee', 'DEV112', '2003-07-29', '20.00'),
('EE996266', 'EL BISSARI', ' ABDERRAHMAN', '1ere annee', 'DEV107', '2005-01-04', '20.00'),
('EE996816', 'EZZAHI', 'ACHRAF', '1ere annee', 'DEV107', '2004-05-02', '20.00'),
('EE997927', 'ZIATE', 'ZAKARYA', '1ere annee', 'DEV109', '2003-07-24', '20.00'),
('EE998718', 'ELKHATABI', 'HAYTAM', '1ere annee', 'DEV108', '2003-09-10', '20.00'),
('EE999507', 'ETTAHIRI', 'ABDESSAMAD', '1ere annee', 'DEV111', '2002-10-18', '20.00'),
('EF12193', 'MOUTOU', 'SOUFIANE', '1ere annee', 'DEV104', '2003-12-12', '20.00'),
('EF12484', 'KHATIR', 'SARA', '1ere annee', 'DEV106', '2004-01-04', '20.00'),
('EF12909', 'CHERQAOUI', 'ABDELTIF', '1ere annee', 'DEV104', '2003-10-15', '20.00'),
('EF13127', 'BOUABOUT', 'OUSSAMA', '1ere annee', 'DEV110', '2003-11-05', '20.00'),
('EF15392', 'ID IHIA', 'YOUSSEF', '1ere annee', 'DEV105', '2005-04-15', '20.00'),
('EF16119', 'AIT ADDI', 'MAJDA', '1ere annee', 'DEV112', '2003-09-30', '20.00'),
('EF17065', 'BOUSSAH', 'ILYASS', '1ere annee', 'DEV103', '2004-08-12', '20.00'),
('EF18730', 'AIT DAOUD', 'ANAS', '1ere annee', 'DEV108', '2004-10-10', '20.00'),
('EF20389', 'AIT OUAARAB', 'MOUAD', '1ere annee', 'DEV102', '2003-09-30', '20.00'),
('EF20598', 'IMEGHRI', 'AMINE', '1ere annee', 'DEV108', '2003-10-18', '20.00'),
('EF23851', 'AIT BEN ALI', 'ZINEB', '1ere annee', 'DEV111', '2004-09-25', '20.00'),
('EF24373', 'AIT TALEB', 'WAHIBA', '1ere annee', 'DEV107', '2005-06-15', '20.00'),
('EF24967', 'BAGHAZ', 'TAHA', '1ere annee', 'DEV105', '2005-03-01', '20.00'),
('EF25717', 'AARIBIA', 'ABIDARAHMAN', '1ere annee', 'DEV102', '2003-07-13', '20.00'),
('EF26263', 'OUAHMANE', 'MOUHCINE', '1ere annee', 'DEV106', '2005-07-20', '20.00'),
('EF26341', 'BOUJAMAOUI', 'SAIDA', '1ere annee', 'DEV101', '2004-08-17', '20.00'),
('EF30346', 'AIT ELQADI', 'FATIMA', '1ere annee', 'DEV105', '2004-07-20', '20.00'),
('EF6626', 'AMAYOUGH', 'AYMANE', '1ere annee', 'DEV110', '2002-10-15', '20.00'),
('EF8691', 'BENLAHSAR', 'NIZAR', '1ere annee', 'DEV111', '2003-02-24', '20.00'),
('HA232058', 'BOUIHI', 'KHALID', '1ere annee', 'DEV111', '2002-06-16', '20.00'),
('HA249759', 'EL MASSOUAB', 'JOUMANA', '1ere annee', 'DEV106', '2005-12-14', '20.00'),
('HA250270', 'EZZITA', ' AHMED', '1ere annee', 'DEV109', '2005-11-07', '20.00'),
('IC191695', 'EL-LATYFY', 'HIBA', '1ere annee', 'DEV108', '2005-09-07', '20.00'),
('IE75050', 'MAHMOUCH', 'HOUSSAM', '1ere annee', 'DEV109', '2005-06-23', '20.00'),
('LC389732', 'AL ISSAOUI', 'WAIL', '1ere annee', 'DEV102', '2006-01-15', '20.00'),
('LE34610', 'DMILIJE', 'NORA', '1ere annee', 'DEV108', '2003-08-20', '20.00'),
('M655544', 'MENSOUB', 'YOUNES', '1ere annee', 'DEV111', '2002-10-24', '20.00'),
('M687253', 'ELGOUZI', 'OUSSAMA', '1ere annee', 'DEV103', '2005-11-01', '20.00'),
('N420182', 'ABOUELKACIM', 'ABDERRAHMAN', '1ere annee', 'DEV108', '1999-01-17', '20.00'),
('N461429', 'AKHFAMANI', 'AMINE', '1ere annee', 'DEV111', '2002-04-12', '20.00'),
('N468486', 'ZOUHRI ', 'SOUKAINA', '1ere annee', 'DEV102', '2001-09-19', '20.00'),
('N470355', 'ASMAH', 'MOHAMMED', '1ere annee', 'DEV109', '2002-06-26', '20.00'),
('N478152', 'BARKAOUI', 'TAOUFIQ', '1ere annee', 'DEV107', '2004-01-05', '20.00'),
('N484713', 'BENAABED', 'HIBA', '1ere annee', 'DEV106', '2005-07-11', '20.00'),
('N497283', 'EL HOSAYNY', 'FARAH', '1ere annee', 'DEV106', '2005-09-12', '20.00'),
('P355928', 'RIH', 'AZZEDINE', '1ere annee', 'DEV102', '2001-02-21', '20.00'),
('SH218405', 'EZZOUHIR', 'HASSAN', '1ere annee', 'DEV103', '2004-05-31', '20.00'),
('Y501702', 'AIT OUAARAB', 'OUSSAMA', '1ere annee', 'DEV106', '2002-11-11', '20.00'),
('Y511126', 'ELATTARI', 'NAIMA', '1ere annee', 'DEV101', '2003-03-12', '20.00'),
('Y512417', 'KORSA', 'ABDELLAH', '1ere annee', 'DEV104', '2003-05-14', '20.00'),
('Y533307', 'QADA', 'YAHYA', '1ere annee', 'DEV104', '2006-01-16', '20.00'),
('YT10230', 'ELRHAZZALI', 'KHAOULA', '1ere annee', 'DEV103', '2003-06-02', '20.00'),
('YT10456', 'BARI', 'OMAYMA', '1ere annee', 'DEV108', '2003-12-01', '20.00'),
('YT11059', 'ELAATI ELLAH', 'ASMAA', '1ere annee', 'DEV102', '2003-05-12', '20.00'),
('YT13315', 'ELYOUSEFY', 'SALMA', '1ere annee', 'DEV101', '2006-04-04', '20.00'),
('YT19517', 'EL OUAFA', 'OUTMANE', '1ere annee', 'DEV110', '2005-09-14', '20.00'),
('YT4994', 'HMIMIDA', 'AHMED', '1ere annee', 'DEV109', '2004-04-12', '20.00'),
('YT6970', 'CHAOUKI', 'KHADIJA', '1ere annee', 'DEV105', '2004-05-23', '20.00'),
('YT7315', 'JOUHAD', 'ABDELLAH', '1ere annee', 'DEV105', '2003-05-31', '20.00'),
('YT8381', 'DAALOUS', 'ETAJANI', '1ere annee', 'DEV110', '2004-10-13', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pswrd` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `pswrd`) VALUES
(1, 'admin@tt', 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_Abs_Stg` FOREIGN KEY (`StagiaireCin`) REFERENCES `stagiaire` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `avertissement`
--
ALTER TABLE `avertissement`
  ADD CONSTRAINT `FK_Avertissement_Stg` FOREIGN KEY (`StagiaireCin`) REFERENCES `stagiaire` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
