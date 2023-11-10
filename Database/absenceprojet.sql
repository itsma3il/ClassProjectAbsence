-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2023 at 09:57 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `cin` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Niveau` enum('1annee','2annee') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1ere annee ou 2eme annee',
  `groupe` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comme "DEV100"',
  `dateNaissance` date NOT NULL,
  `noteDisciplinaire` decimal(10,0) NOT NULL DEFAULT '20',
  PRIMARY KEY (`cin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
