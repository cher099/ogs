-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2020 at 02:35 PM
-- Server version: 8.0.19
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ogs`
--
CREATE DATABASE IF NOT EXISTS `ogs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ogs`;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `section_id` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `subject_id` varchar(255) NOT NULL,
  `first_quarter` varchar(255) DEFAULT NULL,
  `second_quarter` varchar(255) DEFAULT NULL,
  `semestral_grade` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `teacher_id`, `section_id`, `student_id`, `subject_id`, `first_quarter`, `second_quarter`, `semestral_grade`, `remark`) VALUES
(1, '1', '1', '1', '1', '85', '85', '85', 'PASSED'),
(3, '1', '1', '1', '2', '85', '85', '85', 'PASSED'),
(4, '1', '1', '57', '3', '85', '85', '85', 'PASSED'),
(5, '1', '1', '57', '4', '90', '75', '82.5', 'PASSED'),
(6, '1', '1', '57', '1', '85', '95', '90', 'PASSED'),
(7, '1', '1', '57', '2', '85', '85', '85', 'PASSED');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`) VALUES
(1, 'Grade 7'),
(2, 'Grade 8'),
(3, 'Grade 9'),
(4, 'Grade 10'),
(5, 'Grade 11'),
(6, 'Grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `principals`
--

CREATE TABLE `principals` (
  `id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `principals`
--

INSERT INTO `principals` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`) VALUES
(1, 'Cardo', 'Posadas', 'Dalisay', 'cardo.dalisay', 'cardodalisay');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `name`) VALUES
(1, '2020-2021'),
(2, '2021-2022'),
(3, '2022-2023'),
(4, '2023-2024'),
(5, '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `level_id`) VALUES
(1, 'St. John', 1),
(2, 'St. Paul', 1),
(3, 'St. Catherine', 2),
(4, 'St. Paul II', 2),
(5, 'St. John II', 3),
(6, 'St. Dominic', 3),
(7, 'St. Pius', 4),
(8, 'St. Peter', 4),
(9, 'St. Mark', 5),
(10, 'St. Dominus', 5),
(11, 'St. Pius V', 6),
(12, 'St. Pius VI', 6);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sex` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `school_year` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `grade_level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `section` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `birth_date` varchar(50) DEFAULT NULL,
  `date_enrolled` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_number`, `first_name`, `last_name`, `middle_name`, `address`, `sex`, `school_year`, `grade_level`, `section`, `username`, `password`, `birth_date`, `date_enrolled`) VALUES
(1, '2017-00001', 'Heda', 'Sprull', 'Anaël', '3992 Troy Court', 'Female', '2020-2021', 'Grade 7', '1', 'Heda.Sprull', 'HedaSprull', '12/27/2013', '03/07/2020'),
(2, '2017-00002', 'Benedetto', 'McKall', 'Kù', '97 Lerdahl Crossing', 'Male', '2020-2021', 'Grade 7', '1', 'Benedetto.McKall', 'BenedettoMcKall', '12/18/2017', '03/07/2020'),
(3, '2017-00003', 'Zacherie', 'Vevers', 'Yú', '03 5th Way', 'Male', '2020-2021', 'Grade 7', '1', 'Zacherie.Vevers', 'ZacherieVevers', '12/07/2014', '03/07/2020'),
(4, '2017-00004', 'Karlene', 'Farney', 'Valérie', '66 Bayside Court', 'Female', '2020-2021', 'Grade 7', '1', 'Karlene.Farney', 'KarleneFarney', '11/09/2011', '03/07/2020'),
(5, '2017-00005', 'Gram', 'Kedward', 'Bérénice', '3 Crowley Center', 'Male', '2020-2021', 'Grade 7', '1', 'Gram.Kedward', 'GramKedward', '07/19/2007', '03/07/2020'),
(6, '2017-00006', 'Link', 'Rubberts', 'Félicie', '810 New Castle Road', 'Male', '2020-2021', 'Grade 7', '1', 'Link.Rubberts', 'LinkRubberts', '05/14/2011', '03/07/2020'),
(7, '2017-00007', 'Yorker', 'Bernhardsson', 'Séréna', '7211 Montana Place', 'Male', '2020-2021', 'Grade 7', '1', 'Yorker.Bernhardsson', 'YorkerBernhardsson', '07/19/2008', '03/07/2020'),
(8, '2017-00008', 'Hubey', 'Whipp', 'Lauréna', '962 Nevada Parkway', 'Male', '2020-2021', 'Grade 7', '1', 'Hubey.Whipp', 'HubeyWhipp', '07/24/2012', '03/07/2020'),
(9, '2017-00009', 'Langsdon', 'Plume', 'Dafnée', '603 West Pass', 'Male', '2020-2021', 'Grade 7', '1', 'Langsdon.Plume', 'LangsdonPlume', '07/18/2002', '03/07/2020'),
(10, '2017-00010', 'Jim', 'Cribbott', 'Cloé', '31 Dexter Plaza', 'Male', '2020-2021', 'Grade 7', '1', 'Jim.Cribbott', 'JimCribbott', '12/29/2009', '03/07/2020'),
(11, '2017-00011', 'Hermon', 'Francescuzzi', 'Gaïa', '12 Bashford Junction', 'Male', '2020-2021', 'Grade 7', '1', 'Hermon.Francescuzzi', 'HermonFrancescuzzi', '07/02/1998', '03/07/2020'),
(12, '2017-00012', 'Page', 'Trainor', 'Simplifiés', '71765 2nd Plaza', 'Male', '2020-2021', 'Grade 7', '1', 'Page.Trainor', 'PageTrainor', '08/03/1996', '03/07/2020'),
(13, '2017-00013', 'Hermione', 'Browne', 'Marlène', '60 Karstens Point', 'Female', '2020-2021', 'Grade 7', '1', 'Hermione.Browne', 'HermioneBrowne', '06/18/2007', '03/07/2020'),
(14, '2017-00014', 'Theodor', 'Rogge', 'Réservés', '638 Ridge Oak Center', 'Male', '2020-2021', 'Grade 7', '1', 'Theodor.Rogge', 'TheodorRogge', '02/16/2017', '03/07/2020'),
(15, '2017-00015', 'Riley', 'Baccas', 'Véronique', '05 1st Pass', 'Male', '2020-2021', 'Grade 7', '1', 'Riley.Baccas', 'RileyBaccas', '06/24/1999', '03/07/2020'),
(16, '2017-00016', 'Leslie', 'Peele', 'Marylène', '9 Coolidge Street', 'Female', '2020-2021', 'Grade 7', '1', 'Leslie.Peele', 'LesliePeele', '04/11/2003', '03/07/2020'),
(17, '2017-00017', 'Rubin', 'Langfat', 'Méng', '83937 Sachs Center', 'Male', '2020-2021', 'Grade 7', '1', 'Rubin.Langfat', 'RubinLangfat', '08/01/2004', '03/07/2020'),
(18, '2017-00018', 'Yoshi', 'Imlacke', 'Yè', '5549 Kings Junction', 'Female', '2020-2021', 'Grade 7', '1', 'Yoshi.Imlacke', 'YoshiImlacke', '12/24/2008', '03/07/2020'),
(19, '2017-00019', 'Des', 'Mancktelow', 'Léane', '76984 Birchwood Circle', 'Male', '2020-2021', 'Grade 7', '1', 'Des.Mancktelow', 'DesMancktelow', '06/01/2013', '03/07/2020'),
(20, '2017-00020', 'Andee', 'Schultes', 'Anaëlle', '6 Straubel Junction', 'Female', '2020-2021', 'Grade 7', '1', 'Andee.Schultes', 'AndeeSchultes', '02/21/1993', '03/07/2020'),
(21, '2017-00021', 'Hilde', 'Overton', 'Personnalisée', '2628 3rd Lane', 'Female', '2020-2021', 'Grade 8', '3', 'Hilde.Overton', 'HildeOverton', '08/28/2003', '03/07/2020'),
(22, '2017-00022', 'Blayne', 'Crowley', 'Josée', '87 Grasskamp Court', 'Male', '2020-2021', 'Grade 8', '3', 'Blayne.Crowley', 'BlayneCrowley', '01/04/1999', '03/07/2020'),
(23, '2017-00023', 'Burton', 'Rous', 'Uò', '770 North Way', 'Male', '2020-2021', 'Grade 8', '3', 'Burton.Rous', 'BurtonRous', '11/26/2015', '03/07/2020'),
(24, '2017-00024', 'Emile', 'Leggatt', 'Eugénie', '92752 Golf Parkway', 'Male', '2020-2021', 'Grade 8', '3', 'Emile.Leggatt', 'EmileLeggatt', '02/07/2011', '03/07/2020'),
(25, '2017-00025', 'Kessia', 'Benech', 'Edmée', '6 Banding Point', 'Female', '2020-2021', 'Grade 8', '3', 'Kessia.Benech', 'KessiaBenech', '11/24/2002', '03/07/2020'),
(26, '2017-00026', 'Karee', 'Tohill', 'Marie-ève', '70 Del Mar Circle', 'Female', '2020-2021', 'Grade 8', '3', 'Karee.Tohill', 'KareeTohill', '05/28/2019', '03/07/2020'),
(27, '2017-00027', 'Nickey', 'Revely', 'Judicaël', '7 Haas Street', 'Male', '2020-2021', 'Grade 8', '3', 'Nickey.Revely', 'NickeyRevely', '03/03/2020', '03/07/2020'),
(28, '2017-00028', 'Lezlie', 'Palmby', 'Léonie', '2508 Fremont Center', 'Female', '2020-2021', 'Grade 8', '3', 'Lezlie.Palmby', 'LezliePalmby', '01/29/2020', '03/07/2020'),
(29, '2017-00029', 'Jasmin', 'Leyden', 'Gösta', '0 School Circle', 'Female', '2020-2021', 'Grade 8', '3', 'Jasmin.Leyden', 'JasminLeyden', '11/27/2013', '03/07/2020'),
(30, '2017-00030', 'Markus', 'Scudders', 'Faîtes', '02889 Steensland Plaza', 'Male', '2020-2021', 'Grade 8', '3', 'Markus.Scudders', 'MarkusScudders', '12/26/1994', '03/07/2020'),
(31, '2017-00031', 'Nowell', 'Caret', 'Cléa', '9380 Almo Lane', 'Male', '2020-2021', 'Grade 8', '3', 'Nowell.Caret', 'NowellCaret', '03/03/1997', '03/07/2020'),
(32, '2017-00032', 'Kerwin', 'Blackney', 'Crééz', '837 Bunting Trail', 'Male', '2020-2021', 'Grade 8', '3', 'Kerwin.Blackney', 'KerwinBlackney', '11/05/2002', '03/07/2020'),
(33, '2017-00033', 'Lynnell', 'Barthod', 'Garçon', '546 Parkside Road', 'Female', '2020-2021', 'Grade 8', '3', 'Lynnell.Barthod', 'LynnellBarthod', '07/05/2012', '03/07/2020'),
(34, '2017-00034', 'Gregory', 'Garshore', 'Bécassine', '460 Dottie Street', 'Male', '2020-2021', 'Grade 8', '3', 'Gregory.Garshore', 'GregoryGarshore', '04/17/2012', '03/07/2020'),
(35, '2017-00035', 'Melany', 'Springell', 'Börje', '3958 Lien Circle', 'Female', '2020-2021', 'Grade 8', '3', 'Melany.Springell', 'MelanySpringell', '04/30/2007', '03/07/2020'),
(36, '2017-00036', 'Mikael', 'Mewis', 'Frédérique', '6 Fuller Drive', 'Male', '2020-2021', 'Grade 8', '3', 'Mikael.Mewis', 'MikaelMewis', '04/27/1996', '03/07/2020'),
(37, '2017-00037', 'Bran', 'Ondrousek', 'Adèle', '29388 Holy Cross Street', 'Male', '2020-2021', 'Grade 8', '3', 'Bran.Ondrousek', 'BranOndrousek', '06/24/2014', '03/07/2020'),
(38, '2017-00038', 'Adolphus', 'Beany', 'Thérèsa', '484 Clemons Trail', 'Male', '2020-2021', 'Grade 8', '3', 'Adolphus.Beany', 'AdolphusBeany', '04/21/1994', '03/07/2020'),
(39, '2017-00039', 'Link', 'Hovey', 'Andréa', '17456 7th Court', 'Male', '2020-2021', 'Grade 8', '3', 'Link.Hovey', 'LinkHovey', '04/28/1995', '03/07/2020'),
(40, '2017-00040', 'Fidelity', 'Trewhitt', 'Åslög', '368 Bartillon Pass', 'Female', '2020-2021', 'Grade 8', '3', 'Fidelity.Trewhitt', 'FidelityTrewhitt', '07/08/2019', '03/07/2020'),
(41, '2017-00041', 'Arvy', 'Grinnov', 'Marie-josée', '7 Del Mar Hill', 'Male', '2020-2021', 'Grade 8', '3', 'Arvy.Grinnov', 'ArvyGrinnov', '03/29/2004', '03/07/2020'),
(42, '2017-00042', 'Catina', 'Lightbourne', 'Lén', '7213 Bultman Lane', 'Female', '2020-2021', 'Grade 8', '3', 'Catina.Lightbourne', 'CatinaLightbourne', '05/30/1997', '03/07/2020'),
(43, '2017-00043', 'Tim', 'Aspel', 'Loïc', '01 Colorado Way', 'Male', '2020-2021', 'Grade 8', '3', 'Tim.Aspel', 'TimAspel', '06/26/2002', '03/07/2020'),
(44, '2017-00044', 'Mirabelle', 'Verlinde', 'Bénédicte', '05 Aberg Park', 'Female', '2020-2021', 'Grade 8', '3', 'Mirabelle.Verlinde', 'MirabelleVerlinde', '05/16/2006', '03/07/2020'),
(45, '2017-00045', 'Yves', 'Beckhouse', 'Hélèna', '53409 Judy Hill', 'Male', '2020-2021', 'Grade 8', '3', 'Yves.Beckhouse', 'YvesBeckhouse', '09/05/2001', '03/07/2020'),
(46, '2017-00046', 'Gram', 'Copnall', 'Bérangère', '09937 7th Place', 'Male', '2020-2021', 'Grade 8', '3', 'Gram.Copnall', 'GramCopnall', '09/10/1995', '03/07/2020'),
(47, '2017-00047', 'Jermayne', 'Doerling', 'Esbjörn', '50245 Westerfield Pass', 'Male', '2020-2021', 'Grade 8', '3', 'Jermayne.Doerling', 'JermayneDoerling', '04/20/2010', '03/07/2020'),
(48, '2017-00048', 'Morey', 'Nusche', 'Océane', '7102 Crest Line Street', 'Male', '2020-2021', 'Grade 8', '3', 'Morey.Nusche', 'MoreyNusche', '07/04/1998', '03/07/2020'),
(49, '2017-00049', 'Allegra', 'Audley', 'Yáo', '754 Magdeline Road', 'Female', '2020-2021', 'Grade 8', '3', 'Allegra.Audley', 'AllegraAudley', '04/10/1996', '03/07/2020'),
(50, '2017-00050', 'Orson', 'Fenton', 'Garçon', '727 Chinook Alley', 'Male', '2020-2021', 'Grade 8', '3', 'Orson.Fenton', 'OrsonFenton', '03/31/1991', '03/07/2020'),
(51, '2017-00051', 'Virgie', 'Tadgell', 'Magdalène', '891 Paget Pass', 'Female', '2020-2021', 'Grade 8', '3', 'Virgie.Tadgell', 'VirgieTadgell', '08/20/2001', '03/07/2020'),
(52, '2017-00052', 'Cahra', 'Scurrer', 'Mélissandre', '73837 Superior Trail', 'Female', '2020-2021', 'Grade 8', '3', 'Cahra.Scurrer', 'CahraScurrer', '02/11/1994', '03/07/2020'),
(53, '2017-00053', 'Gene', 'Hendrickson', 'Maëline', '14422 Larry Point', 'Male', '2020-2021', 'Grade 8', '3', 'Gene.Hendrickson', 'GeneHendrickson', '08/16/2016', '03/07/2020'),
(54, '2017-00054', 'Sibyl', 'Reckhouse', 'Börje', '4365 Cambridge Parkway', 'Female', '2020-2021', 'Grade 8', '3', 'Sibyl.Reckhouse', 'SibylReckhouse', '06/26/2015', '03/07/2020'),
(55, '2017-00055', 'Kyla', 'Hopkynson', 'Mélia', '78 Daystar Road', 'Female', '2020-2021', 'Grade 8', '3', 'Kyla.Hopkynson', 'KylaHopkynson', '11/18/1992', '03/07/2020'),
(56, '2017-00056', 'Rosanne', 'Vassano', 'Frédérique', '7 Pepper Wood Place', 'Female', '2020-2021', 'Grade 8', '3', 'Rosanne.Vassano', 'RosanneVassano', '07/31/1997', '03/07/2020'),
(57, '2017-00057', 'Didi', 'Shoulder', 'Cinéma', '17615 Reinke Center', 'Female', '2020-2021', 'Grade 8', '3', 'didi', 'didi', '06/20/2005', '03/07/2020'),
(58, '2017-00058', 'Remy', 'Smeaton', 'Kévina', '75 School Hill', 'Female', '2020-2021', 'Grade 8', '3', 'Remy.Smeaton', 'RemySmeaton', '08/21/1991', '03/07/2020'),
(59, '2017-00059', 'Kristien', 'Leftly', 'Estève', '2115 Grover Place', 'Female', '2020-2021', 'Grade 8', '3', 'Kristien.Leftly', 'KristienLeftly', '01/16/1990', '03/07/2020');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `level_id` varchar(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `semester` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `level_id`, `name`, `semester`, `track`, `school_year`) VALUES
(1, '1', 'Physics', 'First Semester', 'Core Subjects (All Tracks)', '2020-2021'),
(2, '1', 'Math', 'First Semester', 'Core Subjects (All Tracks)', '2020-2021'),
(3, '1', 'Filipino', 'Second Semester', 'Core Subjects (All Tracks)', '2020-2021'),
(4, '1', 'Araling Panlipunan', 'Second Semester', 'Core Subjects (All Tracks)', '2020-2021');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teachers`
--

CREATE TABLE `subject_teachers` (
  `id` int NOT NULL,
  `subject_id` varchar(255) DEFAULT NULL,
  `teacher_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_teachers`
--

INSERT INTO `subject_teachers` (`id`, `subject_id`, `teacher_id`) VALUES
(1, '1', '1'),
(2, '2', '1'),
(3, '3', '1'),
(4, '4', '1');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int NOT NULL,
  `level_id` varchar(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `level_id`, `first_name`, `middle_name`, `last_name`, `section`, `username`, `password`) VALUES
(1, '1', 'Ronn', 'Cudal', 'Ybanez', '1', 'ronn', 'ronn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `principals`
--
ALTER TABLE `principals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `subject_teachers`
--
ALTER TABLE `subject_teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `principals`
--
ALTER TABLE `principals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_teachers`
--
ALTER TABLE `subject_teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
