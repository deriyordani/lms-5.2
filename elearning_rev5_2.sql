-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2021 at 05:07 AM
-- Server version: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 5.6.40-47+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning_rev5_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `lms_assessment`
--

DROP TABLE IF EXISTS `lms_assessment`;
CREATE TABLE `lms_assessment` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `uc_content` varchar(15) NOT NULL,
  `uc_subject` varchar(15) NOT NULL,
  `uc_instructor` varchar(15) NOT NULL,
  `category` smallint(6) NOT NULL COMMENT '1 = exercise; 2 = examination',
  `assessment_title` varchar(100) NOT NULL,
  `duration` float DEFAULT NULL,
  `maximum_attempt` smallint(6) NOT NULL,
  `passing_grade` float NOT NULL,
  `time_create` datetime NOT NULL,
  `time_open` datetime NOT NULL,
  `time_close` datetime NOT NULL,
  `is_review` smallint(6) NOT NULL DEFAULT '0',
  `is_active` smallint(6) NOT NULL DEFAULT '0',
  `has_attempt` smallint(6) NOT NULL DEFAULT '0',
  `is_exist` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_assignment_score`
--

DROP TABLE IF EXISTS `lms_assignment_score`;
CREATE TABLE `lms_assignment_score` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_assignment` varchar(15) NOT NULL COMMENT '= lms_content.uc WHERE category = 5',
  `uc_participant` varchar(15) NOT NULL,
  `answer` text NOT NULL,
  `file_attach` varchar(255) NOT NULL,
  `submit_time` datetime DEFAULT NULL,
  `comment` mediumtext NOT NULL,
  `score` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_ass_attempt`
--

DROP TABLE IF EXISTS `lms_ass_attempt`;
CREATE TABLE `lms_ass_attempt` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_assessment` varchar(15) NOT NULL,
  `uc_subject` varchar(15) NOT NULL,
  `uc_student` varchar(15) NOT NULL,
  `questions` text NOT NULL,
  `keyss` text NOT NULL,
  `answers` text NOT NULL,
  `answer_true` int(11) NOT NULL,
  `answer_false` int(11) NOT NULL,
  `answer_result` text NOT NULL,
  `is_marks` int(11) NOT NULL,
  `non_essay_score` float NOT NULL,
  `score` float NOT NULL,
  `time_start` datetime NOT NULL,
  `time_finish` datetime NOT NULL,
  `time_running` int(11) NOT NULL,
  `time_remain` int(11) DEFAULT NULL,
  `has_attempted` int(11) NOT NULL,
  `is_done` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_ass_essay_answer`
--

DROP TABLE IF EXISTS `lms_ass_essay_answer`;
CREATE TABLE `lms_ass_essay_answer` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_ass_attempt` varchar(15) NOT NULL,
  `uc_ass_question` varchar(15) NOT NULL,
  `answer` text,
  `score` float DEFAULT NULL,
  `uc_student` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_ass_options`
--

DROP TABLE IF EXISTS `lms_ass_options`;
CREATE TABLE `lms_ass_options` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_exam_question` varchar(15) NOT NULL,
  `uc_exam` varchar(15) NOT NULL,
  `option_text` text NOT NULL,
  `option_att_type` varchar(50) NOT NULL,
  `option_att_file` varchar(255) NOT NULL,
  `is_correct` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_ass_question`
--

DROP TABLE IF EXISTS `lms_ass_question`;
CREATE TABLE `lms_ass_question` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_question` varchar(15) NOT NULL,
  `question_title` varchar(100) NOT NULL,
  `question_text` text NOT NULL,
  `question_att_type` varchar(50) NOT NULL,
  `question_att_file` varchar(255) NOT NULL,
  `question_type` smallint(6) NOT NULL COMMENT '1 = MC; 2 =TF',
  `answer_truefalse` smallint(6) NOT NULL,
  `answer_multiplechoice` varchar(15) NOT NULL,
  `bobot` float DEFAULT NULL,
  `uc_assessment` varchar(15) NOT NULL,
  `is_exist` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_chats_messages`
--

DROP TABLE IF EXISTS `lms_chats_messages`;
CREATE TABLE `lms_chats_messages` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `uc_user` varchar(15) NOT NULL,
  `content` text NOT NULL,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_classroom`
--

DROP TABLE IF EXISTS `lms_classroom`;
CREATE TABLE `lms_classroom` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_diklat_class` varchar(15) NOT NULL,
  `uc_subject` varchar(15) NOT NULL,
  `uc_instructor` varchar(15) NOT NULL,
  `classroom_title` varchar(100) NOT NULL,
  `classroom_code` varchar(10) NOT NULL,
  `is_exist` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_classroom`
--

INSERT INTO `lms_classroom` (`id`, `uc`, `uc_diklat_class`, `uc_subject`, `uc_instructor`, `classroom_title`, `classroom_code`, `is_exist`) VALUES
(1, '60fa17c1db110', '60fa0575c978e', '60fa04f729144', '60fa05a935986', 'Pend. Kewarganegaraan', 'T31032-PK-', 1),
(2, '60fa923c9ec4d', '60fa0575c978e', '60fa0418894b6', '60fa05a935986', 'Pancasila Class', 'T31022-PK', 1),
(3, '60fa966d4539e', '60fa057a85bce', '60fa04f729144', '60fa05a935986', 'Pend. Kewarganegaraan', 'T31032', 1),
(4, '6102375328950', '61023697b4a53', '61023717597c5', '60fb848b0e4b3', 'NAUTIKA II A', 'N-II-A', 1),
(5, '61023ad581d63', '610239b9e96d1', '61023a8fc0f89', '60fa05a9358d7', '123456', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_comment`
--

DROP TABLE IF EXISTS `lms_comment`;
CREATE TABLE `lms_comment` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_content` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `uc_user` varchar(15) NOT NULL,
  `uc_reply_comment` varchar(15) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_content`
--

DROP TABLE IF EXISTS `lms_content`;
CREATE TABLE `lms_content` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `uc_section` varchar(15) NOT NULL,
  `sequence` smallint(6) NOT NULL,
  `content_title` varchar(100) NOT NULL,
  `content_description` text NOT NULL,
  `category` smallint(6) NOT NULL COMMENT '1 = tpack; 2 = document; 3 = video; 4 = image; 5 = assignment; 6 = assessment; 7 = link',
  `uc_tpack` varchar(15) DEFAULT NULL,
  `type_ass` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = exercise; 2 = examination',
  `file_attach` varchar(255) DEFAULT NULL,
  `link` mediumtext,
  `assignment_point` float DEFAULT NULL,
  `time_open` datetime DEFAULT NULL,
  `time_close` datetime DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_exist` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_content`
--

INSERT INTO `lms_content` (`id`, `uc`, `uc_classroom`, `uc_section`, `sequence`, `content_title`, `content_description`, `category`, `uc_tpack`, `type_ass`, `file_attach`, `link`, `assignment_point`, `time_open`, `time_close`, `create_time`, `is_exist`) VALUES
(6, '60fa4fd3b7526', '60fa17c1db110', '60fa17c1dbe47', 1, 'Bahan Ajar Pertemuan ke 1', '<p>Bahan Ajar Pertemuan ke 1 dua tiga empat</p>', 2, NULL, 0, NULL, 'a', NULL, '1970-01-01 07:00:00', '1970-01-01 07:00:00', '2021-07-23 12:12:51', 1),
(7, '60fd168f2b1ea', '60fa923c9ec4d', '60fa923ca0489', 1, 'Materi Pembelajaran', '<p>belajar belajar</p>', 2, NULL, 0, NULL, NULL, NULL, '1970-01-01 07:00:00', '1970-01-01 07:00:00', '2021-07-25 14:45:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_content_files`
--

DROP TABLE IF EXISTS `lms_content_files`;
CREATE TABLE `lms_content_files` (
  `id` int(15) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_content` varchar(15) NOT NULL,
  `category` int(5) NOT NULL,
  `file_attach` text NOT NULL,
  `type` varchar(150) NOT NULL,
  `location` text NOT NULL,
  `size` int(100) NOT NULL,
  `extension` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_content_files`
--

INSERT INTO `lms_content_files` (`id`, `uc`, `uc_content`, `category`, `file_attach`, `type`, `location`, `size`, `extension`) VALUES
(12, '60fa4fd3ba3c1', '60fa4fd3b7526', 0, 'Screenshot 2021-06-19 at 11-23-14 Deri Ramadhan Yordani ( dyordani) • Instagram photos and videos.png', 'png', '', 0, ''),
(13, '60fa4fd3ba954', '60fa4fd3b7526', 0, 'TAMBAHAN LMS SUBHANALLOH.xlsx', 'xlsx', '', 0, ''),
(14, '60fa4fd3bae6b', '60fa4fd3b7526', 0, 'pl_user.sql', 'sql', '', 0, ''),
(15, '60fa4fd3bbe6a', '60fa4fd3b7526', 0, 'https://www.youtube.com/watch?v=GB46GN1SXzU', 'link', '', 0, ''),
(16, '60fa4fd3bbefb', '60fa4fd3b7526', 0, 'https://mail.google.com/mail/u/0/#inbox', 'link', '', 0, ''),
(17, '60fd168f2dd17', '60fd168f2b1ea', 0, 'temp_instruktur nautika.xls', 'xls', '', 0, ''),
(18, '60fd168f2e2c1', '60fd168f2b1ea', 0, 'https://www.youtube.com/watch?v=SxzjpgDwOt0&list=RDSxzjpgDwOt0&start_radio=1', 'link', '', 0, ''),
(19, '60fd168f2e2cd', '60fd168f2b1ea', 0, 'http://localhost:9999/lms-rev6/classroom/content/add_materi/60fa923c9ec4d/60fa0575c978e', 'link', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `lms_diklat`
--

DROP TABLE IF EXISTS `lms_diklat`;
CREATE TABLE `lms_diklat` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `diklat` varchar(100) NOT NULL,
  `category` tinyint(1) NOT NULL COMMENT '1 = Long, 2 = Short'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_diklat`
--

INSERT INTO `lms_diklat` (`id`, `uc`, `diklat`, `category`) VALUES
(2, '60fa02e7c8f37', 'DIKLAT PELAUT III PENINGKATAN', 1),
(3, '60fa02f319167', 'DIKLAT PELAUT IV PENINGKATAN', 1),
(5, '610230da918c8', 'DIKLAT PELAUT V PENINGKATAN', 1),
(6, '6102310e7274e', 'DIKLAT PELAUT IV PEMBENTUKAN', 1),
(7, '6102311c44a20', 'DIKLAT PELAUT III PEMBENTUKAN', 1),
(8, '61023127f3502', 'DIPLOMA III PELAYARAN', 1),
(9, '6103b3300926a', 'DIKLAT KETERAMPILAN PELAUT', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lms_diklat_class`
--

DROP TABLE IF EXISTS `lms_diklat_class`;
CREATE TABLE `lms_diklat_class` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_diklat_period` varchar(15) NOT NULL,
  `class_label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_diklat_class`
--

INSERT INTO `lms_diklat_class` (`id`, `uc`, `uc_diklat_period`, `class_label`) VALUES
(1, '60fa0575c978e', '60fa056a48216', 'A'),
(2, '60fa057a85bce', '60fa056a48216', 'B'),
(3, '60fb835998e98', '60fb834b9a8c4', 'NT-A'),
(4, '60fb83620cd0e', '60fb834b9a8c4', 'NT-B'),
(5, '6102366036434', '610236521f2eb', 'A'),
(6, '61023663771f8', '610235ddf0dbb', 'Kelas A'),
(7, '61023697b4a53', '61023627a5710', 'NAUTIKA II-A'),
(8, '610239b9e96d1', '610239244fa6d', 'DP-III T II A'),
(9, '612ddffac5a29', '612ddfe7f1553', 'DPIII-A'),
(10, '612de00d9b8a6', '612ddfe7f1553', 'DPIII-B');

-- --------------------------------------------------------

--
-- Table structure for table `lms_diklat_dkp`
--

DROP TABLE IF EXISTS `lms_diklat_dkp`;
CREATE TABLE `lms_diklat_dkp` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `label_dkp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_diklat_dkp`
--

INSERT INTO `lms_diklat_dkp` (`id`, `uc`, `label_dkp`) VALUES
(1, '610251f7a91d4', 'Basic Safety Training (BST)'),
(2, '6102520179c38', 'Advanced Fire Fighting (AFF)'),
(3, '6102520d8474f', 'Security Awareness Training (SAT)'),
(4, '610255e3cb506', 'Seafarers with Designated Security Duties (SDSD)'),
(5, '610255ed8d58b', 'Medical First Aid (MFA)'),
(6, '610255fb8cac6', 'Proficiency in Survival Craft and Rescue Boats other than Fast Rescue Boats (PSCRB)'),
(7, '61025605c01d7', 'Crowd Management Training (CMT)'),
(8, '6102561255993', 'Crisis Management and Human Behaviour Training (CMHBT)'),
(9, '6102561b5df7c', 'Medical Care on Board (MC)'),
(10, '610256258821d', 'Ship Security Officer (SSO)'),
(11, '6102562ddee43', 'Bridge Resources Management (BRM)'),
(12, '61025637883e0', 'Engine Room Resources Management (ERM)'),
(13, '61025bfb14c59', 'Radar Simulator (RS)'),
(14, '61025c049b114', 'ARPA Simulator (AS)'),
(15, '61025c0d6f341', 'Electronic Chart Display and Information System (ECDIS)'),
(16, '61025c1c17006', 'Basic Safety Training Kapal Layar Motor (BST-KLM)'),
(17, '61025c27a89d1', 'Pelaut Rating Dinas Jaga Navigasi (Rating Forming Part of Navigational Watch)'),
(18, '61025c339ff40', 'Pelaut Rating Dinas Jaga Mesin (Rating Forming Part of Engine Room Watch)'),
(19, '61025c3fb2b69', 'Pelaut Terampil Bagian Dek (Rating as Able Seafarer Deck)'),
(20, '61025c48d3129', 'Pelaut Terampil Bagian Mesin (Rating as Able Seafarer Engine)');

-- --------------------------------------------------------

--
-- Table structure for table `lms_diklat_participant`
--

DROP TABLE IF EXISTS `lms_diklat_participant`;
CREATE TABLE `lms_diklat_participant` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_diklat_period` varchar(15) NOT NULL,
  `uc_diklat_class` varchar(15) NOT NULL,
  `no_peserta` varchar(50) NOT NULL,
  `is_claim` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_diklat_participant`
--

INSERT INTO `lms_diklat_participant` (`id`, `uc`, `uc_diklat_period`, `uc_diklat_class`, `no_peserta`, `is_claim`) VALUES
(1, '60fa05c8d3bdc', '60fa056a48216', '60fa0575c978e', 'BST001', 1),
(2, '60fa05c8d3d1a', '60fa056a48216', '60fa0575c978e', 'BST002', 0),
(3, '60fa05c8d3df8', '60fa056a48216', '60fa0575c978e', 'BST003', 0),
(4, '60fa05c8d3e57', '60fa056a48216', '60fa0575c978e', 'BST004', 0),
(5, '60fa05c8d4008', '60fa056a48216', '60fa0575c978e', 'BST005', 0),
(6, '60fa05c8d4053', '60fa056a48216', '60fa0575c978e', 'BST006', 0),
(7, '60fa05c8d40c5', '60fa056a48216', '60fa0575c978e', 'BST007', 0),
(8, '60fa05c8d410e', '60fa056a48216', '60fa0575c978e', 'BST008', 0),
(9, '60fa950b306b3', '60fa056a48216', '60fa057a85bce', 'BST009', 1),
(10, '60fa950b30702', '60fa056a48216', '60fa057a85bce', 'BST010', 0),
(11, '60fa950b3073d', '60fa056a48216', '60fa057a85bce', 'BST011', 0),
(12, '60fa950b3076c', '60fa056a48216', '60fa057a85bce', 'BST012', 0),
(13, '60fa950b30798', '60fa056a48216', '60fa057a85bce', 'BST013', 0),
(14, '60fa950b307c3', '60fa056a48216', '60fa057a85bce', 'BST014', 0),
(15, '60fa950b307ed', '60fa056a48216', '60fa057a85bce', 'BST015', 0),
(16, '60fa950b30817', '60fa056a48216', '60fa057a85bce', 'BST016', 0),
(18, '60fb865ad1e68', '60fb834b9a8c4', '60fb835998e98', 'NT.SM2.001A', 1),
(19, '60fb865ad1f05', '60fb834b9a8c4', '60fb835998e98', 'NT.SM2.002A', 0),
(20, '60fb865ad225a', '60fb834b9a8c4', '60fb835998e98', 'NT.SM2.003A', 0),
(21, '612de07992b41', '612ddfe7f1553', '612ddffac5a29', 'TRIAL001', 0),
(22, '612de07992c4b', '612ddfe7f1553', '612ddffac5a29', 'TRIAL002', 0),
(23, '612de07992d02', '612ddfe7f1553', '612ddffac5a29', 'TRIAL003', 0),
(24, '612de07992db4', '612ddfe7f1553', '612ddffac5a29', 'TRIAL004', 0),
(25, '612de07992e43', '612ddfe7f1553', '612ddffac5a29', 'TRIAL005', 0),
(26, '612de07992ed7', '612ddfe7f1553', '612ddffac5a29', 'TRIAL006', 0),
(27, '612de07992f99', '612ddfe7f1553', '612ddffac5a29', 'TRIAL007', 0),
(28, '612de0799305d', '612ddfe7f1553', '612ddffac5a29', 'TRIAL008', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_diklat_participant_temp`
--

DROP TABLE IF EXISTS `lms_diklat_participant_temp`;
CREATE TABLE `lms_diklat_participant_temp` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_diklat_period` varchar(15) NOT NULL,
  `uc_diklat_class` varchar(15) NOT NULL,
  `no_peserta` varchar(50) NOT NULL,
  `is_claim` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_diklat_period`
--

DROP TABLE IF EXISTS `lms_diklat_period`;
CREATE TABLE `lms_diklat_period` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_prodi` varchar(15) NOT NULL,
  `uc_diklat` varchar(15) NOT NULL,
  `uc_diklat_dkp` varchar(15) DEFAULT NULL,
  `uc_level` varchar(15) NOT NULL,
  `label_periode` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL COMMENT 'untuk category = pembentukan',
  `periode_mulai` date NOT NULL COMMENT 'untuk category = peningkatan',
  `periode_selesai` date NOT NULL COMMENT 'untuk category = peningkatan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_diklat_period`
--

INSERT INTO `lms_diklat_period` (`id`, `uc`, `uc_prodi`, `uc_diklat`, `uc_diklat_dkp`, `uc_level`, `label_periode`, `tahun`, `periode_mulai`, `periode_selesai`) VALUES
(1, '60fa056a48216', '60fa032a04886', '60fa02d4782ca', NULL, '', 'Semester 2', 2021, '0000-00-00', '0000-00-00'),
(2, '60fb834b9a8c4', '60fa03323e658', '60fa02d4782ca', NULL, '', 'Semester 2', 2021, '0000-00-00', '0000-00-00'),
(3, '610235ddf0dbb', '60fa032a04886', '61023127f3502', NULL, '', 'Semester 2 - Trial Deri', 2021, '0000-00-00', '0000-00-00'),
(4, '61023627a5710', '60fa03323e658', '61023127f3502', NULL, '', 'SEMESTER II', 2021, '0000-00-00', '0000-00-00'),
(5, '610236521f2eb', '60fa032a04886', '61023127f3502', NULL, '', 'A', 2021, '0000-00-00', '0000-00-00'),
(6, '610239244fa6d', '60fa032a04886', '6102311c44a20', NULL, '', 'DP-III PEMBENTUKAN', 2021, '2021-07-29', '2021-09-30'),
(7, '612ddfe7f1553', '60fa032a04886', '61023127f3502', '', '', 'TRIAL 31AGUSTUS2021', 2021, '0000-00-00', '0000-00-00'),
(8, '612de2ba84f70', '60fa033e4f484', '61023127f3502', '', '', '', 2021, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `lms_fgroup`
--

DROP TABLE IF EXISTS `lms_fgroup`;
CREATE TABLE `lms_fgroup` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_forum` varchar(15) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_fgroup_participant`
--

DROP TABLE IF EXISTS `lms_fgroup_participant`;
CREATE TABLE `lms_fgroup_participant` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_fgroup` varchar(15) NOT NULL,
  `uc_diklat_participant` varchar(15) NOT NULL,
  `uc_student` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_forum`
--

DROP TABLE IF EXISTS `lms_forum`;
CREATE TABLE `lms_forum` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `uc_diklat_class` varchar(15) NOT NULL,
  `uc_instructor` varchar(15) NOT NULL,
  `topic` varchar(200) NOT NULL,
  `topic_description` text NOT NULL,
  `file_attach` varchar(225) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_forum_comment`
--

DROP TABLE IF EXISTS `lms_forum_comment`;
CREATE TABLE `lms_forum_comment` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_forum` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `uc_user` varchar(15) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_groups_chats`
--

DROP TABLE IF EXISTS `lms_groups_chats`;
CREATE TABLE `lms_groups_chats` (
  `id` int(11) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `total_member` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_groups_members`
--

DROP TABLE IF EXISTS `lms_groups_members`;
CREATE TABLE `lms_groups_members` (
  `id` int(11) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `uc_user` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_instructor`
--

DROP TABLE IF EXISTS `lms_instructor`;
CREATE TABLE `lms_instructor` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `uc_prodi` varchar(15) NOT NULL,
  `is_claim` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_instructor`
--

INSERT INTO `lms_instructor` (`id`, `uc`, `full_name`, `id_number`, `uc_prodi`, `is_claim`) VALUES
(1, '60fa05a935590', 'HERI SUTANTO, SE., M. Pd', '19731109 199808 1 001', '60fa032a04886', 0),
(2, '60fa05a9355d8', 'CARLES Y.A. NALLE, S.Si.T., MM', '19770414 200912 1 003', '60fa032a04886', 0),
(3, '60fa05a93561d', 'YUNIAR AYU HAFITA, S. Pd.,M.Pd', '19890623 201012 2 002', '60fa032a04886', 0),
(4, '60fa05a93563f', 'I MADE MARIASA, S.ST.Pel', '19890416 201402 1 004', '60fa032a04886', 0),
(5, '60fa05a935662', 'MUH. ARIEF RAHMAN,ST.', '19840129 201012 1 003', '60fa032a04886', 0),
(6, '60fa05a935683', 'NURJAMAN TINO ENDASAH, S.ST.Pel', '19891111 201402 1 004', '60fa032a04886', 0),
(7, '60fa05a9356a4', 'RIKI, S.ST.Pel', '19891114 201402 1 004', '60fa032a04886', 0),
(8, '60fa05a9356c5', 'ROBERTUS WENDI RINEKSO, S.ST.Pel', '19890812 201503 1 004', '60fa032a04886', 0),
(9, '60fa05a9356e5', 'SISWANTO, ST', '19840730 200912 1 003', '60fa032a04886', 0),
(10, '60fa05a935707', 'SUROYO', '19890820 201503 1001', '60fa032a04886', 1),
(11, '60fa05a935728', 'FANDHI, H.,S.T', '19831202 201012 1 005', '60fa032a04886', 0),
(12, '60fa05a935748', 'THOMAS, S.Tr', '19860512 200912 1 002', '60fa032a04886', 0),
(13, '60fa05a935768', 'WISNU AJI PRAWOTO, S.T', '19860503 201012 1 005', '60fa032a04886', 0),
(14, '60fa05a935788', 'ELI ANSANAI', '26002021', '60fa032a04886', 0),
(15, '60fa05a9357ae', 'NURSUKMANA DJATI, S. Sos., MM', '27002021', '60fa032a04886', 0),
(16, '60fa05a9357e0', 'ARIFIANTO WICAKSONO, S. Tr. Pel', '28002021', '60fa032a04886', 0),
(17, '60fa05a935811', 'DANIEL ROBERTO, S. Tr. Pel', '29002021', '60fa032a04886', 0),
(18, '60fa05a935833', 'GUNTUR ANDHIKA PRATAMA, S. Tr. Pel', '30002021', '60fa032a04886', 0),
(19, '60fa05a935854', 'JONATHAN GERALD DION, S. Tr. Pel', '31002021', '60fa032a04886', 0),
(20, '60fa05a935875', 'SALOMO PIETER SIBARANI, S. Tr. Pel', '32002021', '60fa032a04886', 0),
(21, '60fa05a935897', 'DANANG DWI SETYO NUGROHO, S. Tr. Pel', '19960627 201902 1 002', '60fa032a04886', 0),
(22, '60fa05a9358b7', 'FILEMON, S. ST. Pel', '19940622 201902 1 001', '60fa032a04886', 0),
(23, '60fa05a9358d7', 'FIRDAUS, S. Tr. Pel', '33002021', '60fa032a04886', 1),
(24, '60fa05a9358f8', 'HENRA WIJAYA SYAM, S. Tr. Pel', '34002021', '60fa032a04886', 0),
(25, '60fa05a935919', 'HENDRI PURWANTO', '35002021', '60fa032a04886', 0),
(26, '60fa05a93593b', 'HERWIN YUSUF', '36002021', '60fa032a04886', 0),
(27, '60fa05a935964', 'SUDIRMAN S.', '37002021', '60fa032a04886', 0),
(28, '60fa05a935986', 'Tigor Napitulu', '38002021', '60fa032a04886', 1),
(29, '60fb848b0e18e', 'Capt.WISNU RISIANTO, M.M.', '19710202 1998081 000', '60fa03323e658', 0),
(30, '60fb848b0e1dd', 'Capt. M. SYAFRIL,M.Pd.M.Mar.', '19681118 199808 1 001', '60fa03323e658', 0),
(31, '60fb848b0e219', 'ARIZAL HENDRIAWAN, M.Sc', '19751001 199808 1 001', '60fa03323e658', 0),
(32, '60fb848b0e23b', 'Capt. IRFAN FAUZAN,MM.', '19730908 200812 1 001', '60fa03323e658', 0),
(33, '60fb848b0e25f', 'Dr. ISKANDAR, S.H.,M.T', '19730621 199808 1 001', '60fa03323e658', 0),
(34, '60fb848b0e281', 'AGUS SULISTIONO, S. Pd.,M.Pd', '19850817 200912 1 001', '60fa03323e658', 0),
(35, '60fb848b0e2a1', 'ADE WARMANSYAH, S.ST.Pel', '19890826 201503 1 005', '60fa03323e658', 0),
(36, '60fb848b0e2c2', 'DANYAKA PUTRA AJI, S.ST.Pel', '19891108 201402 1 002', '60fa03323e658', 0),
(37, '60fb848b0e2e2', 'I KOMANG H.P. ADIPUTRA, S.ST.Pel,M.Sc.', '19901024 201503 1 005', '60fa03323e658', 0),
(38, '60fb848b0e303', 'ICHSAN SYAWALUDDIN, S.ST.Pel', '19900509 201402 1 002', '60fa03323e658', 0),
(39, '60fb848b0e323', 'RAGIL WISNU SAPUTRA, S.ST.Pel', '11002021', '60fa03323e658', 0),
(40, '60fb848b0e348', 'Capt. ENGELBERT MAMUSUNG, S. SiT', '12002021', '60fa03323e658', 0),
(41, '60fb848b0e369', 'Capt. WELEM HATUMESEN, M.Mar', '13002021', '60fa03323e658', 0),
(42, '60fb848b0e38a', 'Capt. YOPPY YANSEND KOCU, S. SiT', '14002021', '60fa03323e658', 0),
(43, '60fb848b0e3ab', 'ELIAS OKTOVIANUS NEBORE, ST', '15002021', '60fa03323e658', 0),
(44, '60fb848b0e3dc', 'SAYONO', '16002021', '60fa03323e658', 0),
(45, '60fb848b0e40d', 'YEHESKIEL NUSSY, M.Mar', '17002021', '60fa03323e658', 0),
(46, '60fb848b0e42f', 'FEBRIANTO MARBUN, S. Tr., Pel', '18002021', '60fa03323e658', 0),
(47, '60fb848b0e450', 'REY LORENZO SARAAN, S. Tr. Pel', '19002021', '60fa03323e658', 0),
(48, '60fb848b0e471', 'ROBBY AGUSTA,S.Tr.Pel', '20002021', '60fa03323e658', 0),
(49, '60fb848b0e492', 'THERY ADAM ORA SITA, S. Tr. Pel', '21002021', '60fa03323e658', 0),
(50, '60fb848b0e4b3', 'FADEL MUHAMMAD', '19961109 201902 1 001', '60fa03323e658', 1),
(51, '60fb848b0e4d2', 'FAJAR GUMELAR, S. Tr. Pel', '19950913 201902 1 001', '60fa03323e658', 0),
(52, '60fb848b0e4f9', 'IDHAM DWI SATRIA, S. ST. Pel', '19940522 201902 1 002', '60fa03323e658', 0),
(53, '60fb848b0e519', 'MUJI SETIYONO, S. Tr. Pel', '19930808 201902 1 008', '60fa03323e658', 0),
(54, '60fb848b0e539', 'SUDARMIN, S. Tr. Pel', '19960527 201902 1 002', '60fa03323e658', 0),
(55, '60fb848b0e558', 'ANDRI BIMANTARA', '22002021', '60fa03323e658', 0),
(56, '60fb848b0e57a', 'ELIAS YANES BURDAM', '23002021', '60fa03323e658', 0),
(57, '60fb848b0e5a1', 'SOVIA DESIRE LAU, S. Pd', '24002021', '60fa03323e658', 1),
(58, '60fb848b0e5be', 'MUHAMMAD RISYAL, S. Pd', '25002021', '60fa03323e658', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_instructor_temp`
--

DROP TABLE IF EXISTS `lms_instructor_temp`;
CREATE TABLE `lms_instructor_temp` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `uc_prodi` varchar(15) NOT NULL,
  `is_claim` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_kehadiran`
--

DROP TABLE IF EXISTS `lms_kehadiran`;
CREATE TABLE `lms_kehadiran` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `uc_section` varchar(15) DEFAULT NULL,
  `uc_instructor` varchar(15) DEFAULT NULL,
  `uc_diklat_participant` varchar(15) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 = hadir; 2 = sakit; 3 = ijin',
  `date_time` datetime DEFAULT NULL,
  `first_access` datetime DEFAULT NULL,
  `visit_time` datetime DEFAULT NULL,
  `leave_time` datetime DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `duration` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_kehadiran`
--

INSERT INTO `lms_kehadiran` (`id`, `uc`, `uc_classroom`, `uc_section`, `uc_instructor`, `uc_diklat_participant`, `status`, `date_time`, `first_access`, `visit_time`, `leave_time`, `last_access`, `duration`) VALUES
(1, '60fc057fa36d6', '60fa923c9ec4d', '60fa923ca0489', '60fa05a935986', NULL, 1, '2021-07-24 19:20:00', '2021-07-24 19:20:00', '2021-07-24 19:20:00', NULL, NULL, 0),
(2, '60fce2f382f7a', '60fa923c9ec4d', '60fa923ca0489', NULL, '60fa05c8d3bdc', 1, '2021-07-25 11:05:00', '2021-07-25 11:05:00', '2021-07-25 15:26:00', '2021-07-25 14:46:00', '2021-07-25 14:46:00', 60);

-- --------------------------------------------------------

--
-- Table structure for table `lms_level`
--

DROP TABLE IF EXISTS `lms_level`;
CREATE TABLE `lms_level` (
  `id` int(11) NOT NULL,
  `label` varchar(225) DEFAULT NULL,
  `majors` varchar(5) NOT NULL,
  `level_majors` int(11) DEFAULT NULL,
  `uc` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_prodi`
--

DROP TABLE IF EXISTS `lms_prodi`;
CREATE TABLE `lms_prodi` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_prodi`
--

INSERT INTO `lms_prodi` (`id`, `uc`, `prodi`) VALUES
(1, '60fa032a04886', 'Permesinan Kapal'),
(2, '60fa03323e658', 'Nautika'),
(3, '60fa033e4f484', 'Manajemen Transportasi Laut');

-- --------------------------------------------------------

--
-- Table structure for table `lms_question`
--

DROP TABLE IF EXISTS `lms_question`;
CREATE TABLE `lms_question` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_subject` varchar(15) NOT NULL,
  `question_title` varchar(225) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` int(11) NOT NULL,
  `truefalse_answer` int(11) NOT NULL,
  `att_file` varchar(225) DEFAULT NULL,
  `author` varchar(15) NOT NULL,
  `is_exist` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_question_options`
--

DROP TABLE IF EXISTS `lms_question_options`;
CREATE TABLE `lms_question_options` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_question` varchar(15) NOT NULL,
  `option_text` text NOT NULL,
  `is_correct` smallint(6) NOT NULL,
  `att_file` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_schedule`
--

DROP TABLE IF EXISTS `lms_schedule`;
CREATE TABLE `lms_schedule` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_diklat_class` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_schedule`
--

INSERT INTO `lms_schedule` (`id`, `uc`, `uc_diklat_class`) VALUES
(1, '61022bbdc9e36', '60fa0575c978e');

-- --------------------------------------------------------

--
-- Table structure for table `lms_sched_plot`
--

DROP TABLE IF EXISTS `lms_sched_plot`;
CREATE TABLE `lms_sched_plot` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_sched_week` varchar(15) NOT NULL,
  `jam_ke` smallint(6) NOT NULL,
  `jam_mulai` varchar(7) NOT NULL,
  `jam_selesai` varchar(7) NOT NULL,
  `uc_subject` varchar(15) NOT NULL,
  `uc_instructor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_sched_week`
--

DROP TABLE IF EXISTS `lms_sched_week`;
CREATE TABLE `lms_sched_week` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_schedule` varchar(15) NOT NULL,
  `minggu_ke` smallint(6) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_sched_week`
--

INSERT INTO `lms_sched_week` (`id`, `uc`, `uc_schedule`, `minggu_ke`, `tanggal_mulai`, `tanggal_akhir`) VALUES
(1, '61022bcc8f030', '61022bbdc9e36', 1, '2021-07-28', '2021-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `lms_section`
--

DROP TABLE IF EXISTS `lms_section`;
CREATE TABLE `lms_section` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `section_label` varchar(100) NOT NULL,
  `uc_classroom` varchar(15) NOT NULL,
  `sequence` smallint(6) NOT NULL,
  `is_active` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_section`
--

INSERT INTO `lms_section` (`id`, `uc`, `section_label`, `uc_classroom`, `sequence`, `is_active`) VALUES
(1, '60fa17c1dbe47', 'Pertemuan Ke 1', '60fa17c1db110', 1, 0),
(2, '60fa17c1ddb0f', 'Pertemuan Ke 2', '60fa17c1db110', 2, 0),
(3, '60fa923ca0489', 'Pertemuan Ke 1', '60fa923c9ec4d', 1, 1),
(4, '60fa923ca0ebc', 'Pertemuan Ke 2', '60fa923c9ec4d', 2, 0),
(5, '60fa966d4cdd1', 'Pertemuan Ke 1', '60fa966d4539e', 1, 0),
(6, '60fa966d4d2d7', 'Pertemuan Ke 2', '60fa966d4539e', 2, 0),
(7, '610237532c83d', 'Pertemuan Ke 1', '6102375328950', 1, 0),
(8, '610237532e8a2', 'Pertemuan Ke 2', '6102375328950', 2, 0),
(9, '6102375330cbd', 'Pertemuan Ke 3', '6102375328950', 3, 0),
(10, '61023753339c9', 'Pertemuan Ke 4', '6102375328950', 4, 0),
(11, '610237533b5f8', 'Pertemuan Ke 5', '6102375328950', 5, 0),
(12, '610237533e75a', 'Pertemuan Ke 6', '6102375328950', 6, 0),
(13, '6102375341de5', 'Pertemuan Ke 7', '6102375328950', 7, 0),
(14, '6102375343919', 'Pertemuan Ke 8', '6102375328950', 8, 0),
(15, '6102375345d2c', 'Pertemuan Ke 9', '6102375328950', 9, 0),
(16, '610237534903e', 'Pertemuan Ke 10', '6102375328950', 10, 0),
(17, '610237534addb', 'Pertemuan Ke 11', '6102375328950', 11, 0),
(18, '610237534e1a4', 'Pertemuan Ke 12', '6102375328950', 12, 0),
(19, '6102375351d81', 'Pertemuan Ke 13', '6102375328950', 13, 0),
(20, '6102375355270', 'Pertemuan Ke 14', '6102375328950', 14, 0),
(21, '6102375358653', 'Pertemuan Ke 15', '6102375328950', 15, 0),
(22, '610237535a8d6', 'Pertemuan Ke 16', '6102375328950', 16, 0),
(23, '61023ad5864c4', 'Pertemuan Ke 1', '61023ad581d63', 1, 0),
(24, '61023ad58c82b', 'Pertemuan Ke 2', '61023ad581d63', 2, 0),
(25, '61023ad58e310', 'Pertemuan Ke 3', '61023ad581d63', 3, 0),
(26, '61023ad59024e', 'Pertemuan Ke 4', '61023ad581d63', 4, 0),
(27, '61023ad5947bf', 'Pertemuan Ke 5', '61023ad581d63', 5, 0),
(28, '61023ad598e06', 'Pertemuan Ke 6', '61023ad581d63', 6, 0),
(29, '61023ad59acfc', 'Pertemuan Ke 7', '61023ad581d63', 7, 0),
(30, '61023ad59bf91', 'Pertemuan Ke 8', '61023ad581d63', 8, 0),
(31, '61023ad59ef56', 'Pertemuan Ke 9', '61023ad581d63', 9, 0),
(32, '61023ad5a0323', 'Pertemuan Ke 10', '61023ad581d63', 10, 0),
(33, '61023ad5a1a27', 'Pertemuan Ke 11', '61023ad581d63', 11, 0),
(34, '61023ad5a3c22', 'Pertemuan Ke 12', '61023ad581d63', 12, 0),
(35, '61023ad5a5be5', 'Pertemuan Ke 13', '61023ad581d63', 13, 0),
(36, '61023ad5a773d', 'Pertemuan Ke 14', '61023ad581d63', 14, 0),
(37, '61023ad5a90d8', 'Pertemuan Ke 15', '61023ad581d63', 15, 0),
(38, '61023ad5ad2ff', 'Pertemuan Ke 16', '61023ad581d63', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_student`
--

DROP TABLE IF EXISTS `lms_student`;
CREATE TABLE `lms_student` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `no_peserta` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `kewarganegaraan` smallint(6) NOT NULL COMMENT '1 = WNI, 2 = WNA',
  `ktp_passport` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_student`
--

INSERT INTO `lms_student` (`id`, `uc`, `no_peserta`, `full_name`, `kewarganegaraan`, `ktp_passport`) VALUES
(1, '60fa05c8d3bdc', 'BST001', 'Student 1', 0, ''),
(2, '60fa05c8d3d1a', 'BST002', 'Student 2', 0, ''),
(3, '60fa05c8d3df8', 'BST003', 'Student 3', 0, ''),
(4, '60fa05c8d3e57', 'BST004', 'Student 4', 0, ''),
(5, '60fa05c8d4008', 'BST005', 'Student 5', 0, ''),
(6, '60fa05c8d4053', 'BST006', 'Student 6', 0, ''),
(7, '60fa05c8d40c5', 'BST007', 'Student 7', 0, ''),
(8, '60fa05c8d410e', 'BST008', 'Student 8', 0, ''),
(9, '60fa950b306b3', 'BST009', 'Student 9', 0, ''),
(10, '60fa950b30702', 'BST010', 'Student 10', 0, ''),
(11, '60fa950b3073d', 'BST011', 'Student 11', 0, ''),
(12, '60fa950b3076c', 'BST012', 'Student 12', 0, ''),
(13, '60fa950b30798', 'BST013', 'Student 13', 0, ''),
(14, '60fa950b307c3', 'BST014', 'Student 14', 0, ''),
(15, '60fa950b307ed', 'BST015', 'Student 15', 0, ''),
(16, '60fa950b30817', 'BST016', 'Student 16', 0, ''),
(17, '60fb8529585dd', 'NT.SM2.A', 'Student 1', 0, ''),
(18, '60fb865ad1e68', 'NT.SM2.001A', 'Student 1', 0, ''),
(19, '60fb865ad1f05', 'NT.SM2.002A', 'Student 2', 0, ''),
(20, '60fb865ad225a', 'NT.SM2.003A', 'Student 3', 0, ''),
(21, '612de07992b41', 'TRIAL001', 'Student 1', 0, ''),
(22, '612de07992c4b', 'TRIAL002', 'Student 2', 0, ''),
(23, '612de07992d02', 'TRIAL003', 'Student 3', 0, ''),
(24, '612de07992db4', 'TRIAL004', 'Student 4', 0, ''),
(25, '612de07992e43', 'TRIAL005', 'Student 5', 0, ''),
(26, '612de07992ed7', 'TRIAL006', 'Student 6', 0, ''),
(27, '612de07992f99', 'TRIAL007', 'Student 7', 0, ''),
(28, '612de0799305d', 'TRIAL008', 'Student 8', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `lms_student_temp`
--

DROP TABLE IF EXISTS `lms_student_temp`;
CREATE TABLE `lms_student_temp` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `no_peserta` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `kewarganegaraan` smallint(6) NOT NULL COMMENT '1 = WNI, 2 = WNA',
  `ktp_passport` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_subject`
--

DROP TABLE IF EXISTS `lms_subject`;
CREATE TABLE `lms_subject` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `subject_code` varchar(15) NOT NULL,
  `subject_title` varchar(100) NOT NULL,
  `uc_diklat` varchar(15) DEFAULT NULL,
  `uc_diklat_dkp` varchar(15) DEFAULT NULL,
  `uc_prodi` varchar(15) DEFAULT NULL,
  `category` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_subject`
--

INSERT INTO `lms_subject` (`id`, `uc`, `subject_code`, `subject_title`, `uc_diklat`, `uc_diklat_dkp`, `uc_prodi`, `category`) VALUES
(1, '60fa03de067c3', 'T31012', 'Pendidikan Agama', '61023127f3502', NULL, '60fa032a04886', 1),
(2, '60fa0418894b6', 'T31022', 'Pancasila', '61023127f3502', NULL, '60fa032a04886', 1),
(3, '60fa04f729144', 'T31032', 'Pendidikan Kewarganegaraan', '61023127f3502', NULL, '60fa032a04886', 1),
(4, '60fa0515edd69', 'T31042', 'Bahasa Indonesia', '61023127f3502', NULL, '60fa032a04886', 1),
(5, '60fc0f0fedc39', 'T31111', 'Budaya Keselamatan, Keamanan & Pelayanan', '61023127f3502', NULL, '60fa032a04886', 1),
(6, '60fc0f71a8fec', 'T31062', 'Fisika Terapan', '61023127f3502', NULL, '60fa032a04886', 1),
(7, '60fc0facd8a8c', 'T31052', 'Matematika Terapan', '61023127f3502', NULL, '60fa032a04886', 1),
(8, '60fc0fd62ca8e', 'T31072', 'Mekanika Terapan', '61023127f3502', NULL, '60fa032a04886', 1),
(9, '60fc101d9af1a', 'T31082', 'Kimia Industri', '61023127f3502', NULL, '60fa032a04886', 1),
(10, '60fc105c6ac62', 'T31092', 'Teknologi Informatika', '61023127f3502', NULL, '60fa032a04886', 1),
(11, '60fc10787fdb7', 'T31103', 'Mesin Penggerak Utama', '61023127f3502', NULL, '60fa032a04886', 1),
(12, '60fc10aa093ed', 'T321123', 'Thermodinamika', '61023127f3502', NULL, '60fa032a04886', 1),
(13, '60fc10c784bee', 'T32133', 'Mesin Penggerak Utama', '61023127f3502', NULL, '60fa032a04886', 1),
(14, '60fc10ea372be', 'T32142', 'Bahasa Inggris Maritim', '61023127f3502', NULL, '60fa032a04886', 1),
(15, '60fc11171b023', 'T32153', 'Sistem Perawatan Permesinan', '61023127f3502', NULL, '60fa032a04886', 1),
(16, '60fc113861acb', 'T32173', 'Sistem Kelistrikan Kapal', '61023127f3502', NULL, '60fa032a04886', 1),
(17, '60fc1164c6ba8', 'T32182', 'Undang-Undang Pelayaran ', '61023127f3502', NULL, '60fa032a04886', 1),
(18, '60fc1190c866e', 'T32193', 'Ilmu Bahan', '61023127f3502', NULL, '60fa032a04886', 1),
(19, '60fc11b74e102', 'T32201', 'Kontruksi dan Stabilitas Kapal', '61023127f3502', NULL, '60fa032a04886', 1),
(20, '60fc11d9b832f', 'T33211', 'Thermodinamika', '61023127f3502', NULL, '60fa032a04886', 1),
(21, '60fc11f90e2fa', 'T33223', 'Mesin Penggerak Utama', '61023127f3502', '', '60fa032a04886', 1),
(22, '60fc1212b4de3', 'T33232', 'Bahasa Inggris Maritim', '60fa02d4782ca', NULL, '60fa032a04886', 1),
(23, '60fc122b3c0ed', 'T33243', 'Sistem Perawatan Permesinan', '60fa02d4782ca', NULL, '60fa032a04886', 1),
(24, '60fc12412e007', 'T33253', 'Sistem Kelistrikan Kapal', '60fa02d4782ca', NULL, '60fa032a04886', 1),
(25, '60fc12638e782', 'T33261', 'Kepemimpinan ,Etos Kerja dan Keterampilan Kerja Tim', '61023127f3502', NULL, '60fa032a04886', 1),
(26, '60fc128ab1b97', 'T33273', 'Sistem Kontrol', '61023127f3502', NULL, '60fa032a04886', 1),
(27, '60fc12ae53aa5', 'T33283', 'Elektronika', '61023127f3502', NULL, '60fa032a04886', 1),
(28, '60fc12cfa51c2', 'T33293', 'Konstruksi dan Prinsip Kerja Permesinan Bantu', '61023127f3502', NULL, '60fa032a04886', 1),
(29, '60fc12efea149', 'T33301', 'Mesin Perkakas', '61023127f3502', NULL, '60fa032a04886', 1),
(30, '60fc130891a32', 'T34312', 'Mesin Penggerak Utama', '61023127f3502', NULL, '60fa032a04886', 1),
(31, '60fc13245b395', 'T34323', 'Sistem Perawatan Permesinan', '61023127f3502', NULL, '60fa032a04886', 1),
(32, '60fc134830a7a', 'T34332', 'Sistem Kelistrikan Kapal', '61023127f3502', NULL, '60fa032a04886', 1),
(33, '60fc135e44ad0', 'T34342', 'Sistem Kontrol', '61023127f3502', NULL, '60fa032a04886', 1),
(34, '60fc137bb2e73', 'T34353', 'Konstruksi dan Prinsip Kerja Permesinan Bantu', '61023127f3502', NULL, '60fa032a04886', 1),
(35, '60fc13a04f919', 'T34363', 'Penggunaan Peralatan Kerja Manual & Bertenaga', '61023127f3502', NULL, '60fa032a04886', 1),
(36, '60fc13c21c359', 'T34371', 'Metodelogi Penelitian dan Tugas akhir', '61023127f3502', NULL, '60fa032a04886', 1),
(37, '60fc13e02ffed', 'T34382', 'Dinas Jaga Mesin, Keselamatan & Prosedur Darurat', '61023127f3502', NULL, '60fa032a04886', 1),
(38, '60fc13fd7be79', 'T34392', 'Kepedulian Lingkungan & Pencegahan Polusi', '61023127f3502', NULL, '60fa032a04886', 1),
(39, '60fc142b30c61', 'T35408', ' Fungsi Permesinan Kapal ', '61023127f3502', NULL, '60fa032a04886', 1),
(40, '60fc144756858', 'T35418', 'Fungsi Listrik, Elektronika dan Sistem Kontrol ', '61023127f3502', NULL, '60fa032a04886', 1),
(41, '60fc146abcd6c', 'T36427', 'Fungsi Pemeliharaan dan Perbaikan', '61023127f3502', NULL, '60fa032a04886', 1),
(42, '60fc148971dc0', 'T36437', 'Fungsi Pengendalian Operasi Kapal dan Penanganan Personil di Kapal Fungsi Pengendalian Operasi Kapal', '61023127f3502', NULL, '60fa032a04886', 1),
(45, '61023717597c5', 'IPD 1', 'ILMU PELAYARAN DATAR', '61023127f3502', NULL, '60fa03323e658', 1),
(46, '61023a8fc0f89', 'DP-III T II A', 'TEKNIKA II A', '61023127f3502', NULL, '60fa032a04886', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_tpack`
--

DROP TABLE IF EXISTS `lms_tpack`;
CREATE TABLE `lms_tpack` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `package_title` varchar(100) NOT NULL,
  `uc_subject` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_tpack`
--

INSERT INTO `lms_tpack` (`id`, `uc`, `package_title`, `uc_subject`) VALUES
(1, 'p01', 'CBT Pesawat Bantu', '6049849edd95c');

-- --------------------------------------------------------

--
-- Table structure for table `lms_tpack_page`
--

DROP TABLE IF EXISTS `lms_tpack_page`;
CREATE TABLE `lms_tpack_page` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_tpack_section` varchar(15) NOT NULL,
  `page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_tpack_page`
--

INSERT INTO `lms_tpack_page` (`id`, `uc`, `uc_tpack_section`, `page`) VALUES
(1, '6054c83977671', 'ps0101', 1),
(2, '6054c83977f3d', 'ps0101', 2),
(3, '6054c83978346', 'ps0101', 3),
(4, '6054c8397874c', 'ps0101', 4),
(5, '6054c861b82f3', 'ps0102', 1),
(6, '6054c861b8ba0', 'ps0102', 2),
(7, '6054c861b9038', 'ps0102', 3),
(8, '6054c861b9607', 'ps0102', 4),
(9, '6054c861b9a43', 'ps0102', 5),
(10, '6054c861b9d51', 'ps0102', 6),
(11, '6054c861ba073', 'ps0102', 7),
(12, '6054c861ba364', 'ps0102', 8),
(13, '6054c861ba68e', 'ps0102', 9),
(14, '6054c861ba98f', 'ps0102', 10),
(15, '6054c861bac7a', 'ps0102', 11),
(16, '6054c861bafb8', 'ps0102', 12),
(17, '6054c861bb4cd', 'ps0102', 13),
(18, '6054c861bb873', 'ps0102', 14),
(19, '6054c861bbbfd', 'ps0102', 15),
(20, '6054c861bbedb', 'ps0102', 16),
(21, '6054c861bc335', 'ps0102', 17),
(22, '6054c861bc6a9', 'ps0102', 18),
(23, '6054c861bc95d', 'ps0102', 19),
(24, '6054c861bcd0f', 'ps0102', 20),
(25, '6054c861bd048', 'ps0102', 21),
(26, '6054c861bd3ae', 'ps0102', 22),
(27, '6054c861bd792', 'ps0102', 23),
(28, '6054c861bdae6', 'ps0102', 24),
(29, '6054c861bde02', 'ps0102', 25),
(30, '6054c861be144', 'ps0102', 26),
(31, '6054c861be451', 'ps0102', 27),
(32, '6054c886f115f', 'ps0103', 1),
(33, '6054c886f1641', 'ps0103', 2),
(34, '6054c886f1f8b', 'ps0103', 3),
(35, '6054c886f25b4', 'ps0103', 4),
(36, '6054c886f289f', 'ps0103', 5),
(37, '6054c886f2bf1', 'ps0103', 6),
(38, '6054c886f3055', 'ps0103', 7),
(39, '6054c886f347e', 'ps0103', 8),
(40, '6054c886f384b', 'ps0103', 9),
(41, '6054c886f3b57', 'ps0103', 10),
(42, '6054c886f3e0a', 'ps0103', 11),
(43, '6054c886f40f8', 'ps0103', 12),
(44, '6054c887001aa', 'ps0103', 13),
(45, '6054c887004da', 'ps0103', 14),
(46, '6054c88700abd', 'ps0103', 15),
(47, '6054c887010e0', 'ps0103', 16),
(48, '6054c8870142b', 'ps0103', 17),
(49, '6054c887017f9', 'ps0103', 18),
(50, '6054c88701abc', 'ps0103', 19),
(51, '6054c88701d2e', 'ps0103', 20),
(52, '6054c88701f6c', 'ps0103', 21),
(53, '6054c887021df', 'ps0103', 22),
(54, '6054c8a5d223c', 'ps0104', 1),
(55, '6054c8a5d2a1d', 'ps0104', 2),
(56, '6054c8a5d2d8f', 'ps0104', 3),
(57, '6054c8a5d30e7', 'ps0104', 4),
(58, '6054c8a5d34ed', 'ps0104', 5),
(59, '6054c8a5d38ed', 'ps0104', 6),
(60, '6054c8a5d3d58', 'ps0104', 7),
(61, '6054c8a5d4077', 'ps0104', 8),
(62, '6054c8a5d43be', 'ps0104', 9),
(63, '6054c8a5d47ac', 'ps0104', 10),
(64, '6054c8a5d4ae2', 'ps0104', 11),
(65, '6054c8a5d4e13', 'ps0104', 12),
(66, '6054c8a5d51b4', 'ps0104', 13),
(67, '6054c8a5d5576', 'ps0104', 14),
(68, '6054c8a5d58c6', 'ps0104', 15),
(69, '6054c8a5d5bdb', 'ps0104', 16),
(70, '6054c8a5d5f9a', 'ps0104', 17),
(71, '6054c8a5d635a', 'ps0104', 18),
(72, '6054c8a5d67b0', 'ps0104', 19),
(73, '6054c8a5d6b6c', 'ps0104', 20),
(74, '6054c8a5d6f36', 'ps0104', 21),
(75, '6054c8a5d7318', 'ps0104', 22),
(76, '6054c8a5d76b7', 'ps0104', 23),
(77, '6054c8a5d7a94', 'ps0104', 24),
(78, '6054c8a5d7e62', 'ps0104', 25),
(79, '6054c8a5d8344', 'ps0104', 26),
(80, '6054c8a5d8782', 'ps0104', 27),
(81, '6054c8a5d8c81', 'ps0104', 28),
(82, '6054c8a5d905d', 'ps0104', 29),
(83, '6054c8a5d93dc', 'ps0104', 30),
(84, '6054c8a5d97cf', 'ps0104', 31),
(85, '6054c8a5d9c3b', 'ps0104', 32),
(86, '6054c8a5d9fd8', 'ps0104', 33),
(87, '6054c8a5da3ab', 'ps0104', 34),
(88, '6054c8a5da784', 'ps0104', 35),
(89, '6054c8a5dabe6', 'ps0104', 36),
(90, '6054c8a5db06a', 'ps0104', 37),
(91, '6054c8a5db52c', 'ps0104', 38),
(92, '6054c8a5dba2b', 'ps0104', 39),
(93, '6054c8a5dbde9', 'ps0104', 40),
(94, '6054c8a5dc0d5', 'ps0104', 41),
(95, '6054c8a5dc3ec', 'ps0104', 42),
(96, '6054c8a5dc762', 'ps0104', 43),
(97, '6054c8a5dcb83', 'ps0104', 44),
(98, '6054c8a5dd00e', 'ps0104', 45),
(99, '6054c8a5dd41c', 'ps0104', 46),
(100, '6054c8a5dd7b5', 'ps0104', 47),
(101, '6054c8a5ddb9f', 'ps0104', 48),
(102, '6054c8a5ddf5c', 'ps0104', 49),
(103, '6054c8a5de39f', 'ps0104', 50),
(104, '6054c8a5de7d3', 'ps0104', 51),
(105, '6054c8a5dec62', 'ps0104', 52),
(106, '6054c8a5df070', 'ps0104', 53),
(107, '6054c8a5df459', 'ps0104', 54),
(108, '6054c8a5df71a', 'ps0104', 55),
(109, '6054c8a5df9b6', 'ps0104', 56),
(110, '6054c8a5dfd4c', 'ps0104', 57),
(111, '6054c8a5e00fa', 'ps0104', 58),
(112, '6054c8a5e049d', 'ps0104', 59),
(113, '6054c8a5e0937', 'ps0104', 60),
(114, '6054c8a5e0d47', 'ps0104', 61),
(115, '6054c8a5e110d', 'ps0104', 62),
(116, '6054c8a5e14b0', 'ps0104', 63),
(117, '6054c8a5e18ae', 'ps0104', 64),
(118, '6054c8a5e1c70', 'ps0104', 65),
(119, '6054c8a5e208b', 'ps0104', 66),
(120, '6054c8a5e24c1', 'ps0104', 67),
(121, '6054c8a5e28d3', 'ps0104', 68),
(122, '6054c8a5e2d01', 'ps0104', 69),
(123, '6054c8a5e3069', 'ps0104', 70),
(124, '6054c8a5e33b2', 'ps0104', 71),
(125, '6054c8a5e3809', 'ps0104', 72),
(126, '6054c8a5e3b3a', 'ps0104', 73),
(127, '6054c8a5e3df0', 'ps0104', 74),
(128, '6054c8a5e4149', 'ps0104', 75),
(129, '6054c8a5e44f4', 'ps0104', 76),
(130, '6054c8a5e47e6', 'ps0104', 77),
(131, '6054c8a5e4bc5', 'ps0104', 78),
(132, '6054c8a5e4ffb', 'ps0104', 79),
(133, '6054c8a5e539a', 'ps0104', 80),
(134, '6054c8a5e572d', 'ps0104', 81),
(135, '6054c8a5e5ab2', 'ps0104', 82),
(136, '6054c8a5e5e44', 'ps0104', 83),
(137, '6054c8a5e6156', 'ps0104', 84),
(138, '6054c8a5e63f7', 'ps0104', 85),
(139, '6054c8a5e666f', 'ps0104', 86),
(140, '6054c8a5e68ed', 'ps0104', 87),
(141, '6054c8a5e6b79', 'ps0104', 88),
(142, '6054c8a5e6e44', 'ps0104', 89),
(143, '6054c8a5e719b', 'ps0104', 90),
(144, '6054c8a5e7537', 'ps0104', 91),
(145, '6054c8c611618', 'ps0105', 1),
(146, '6054c8c611d63', 'ps0105', 2),
(147, '6054c8c612085', 'ps0105', 3),
(148, '6054c8c612476', 'ps0105', 4),
(149, '6054c8c6127b1', 'ps0105', 5),
(150, '6054c8c612ac8', 'ps0105', 6),
(151, '6054c8c612f28', 'ps0105', 7),
(152, '6054c8c6133b0', 'ps0105', 8),
(153, '6054c8c6137af', 'ps0105', 9),
(154, '6054c8c613b80', 'ps0105', 10),
(155, '6054c8c613e0c', 'ps0105', 11),
(156, '6054c8c614178', 'ps0105', 12),
(157, '6054c8c6144ba', 'ps0105', 13),
(158, '6054c8c614796', 'ps0105', 14),
(159, '6054c8c614a45', 'ps0105', 15),
(160, '6054c8c614d3b', 'ps0105', 16),
(161, '6054c8c615210', 'ps0105', 17),
(162, '6054c8c61559d', 'ps0105', 18),
(163, '6054c8c6159b2', 'ps0105', 19),
(164, '6054c8c615e23', 'ps0105', 20),
(165, '6054c8c6162b1', 'ps0105', 21),
(166, '6054c8c6165c7', 'ps0105', 22),
(167, '6054c8c616982', 'ps0105', 23),
(168, '6054c8c616c63', 'ps0105', 24),
(169, '6054c8c616ee6', 'ps0105', 25),
(170, '6054c8c6171f4', 'ps0105', 26),
(171, '6054c8c61742a', 'ps0105', 27),
(172, '6054c8c61764a', 'ps0105', 28),
(173, '6054c8c6178bd', 'ps0105', 29),
(174, '6054c8c617b9f', 'ps0105', 30);

-- --------------------------------------------------------

--
-- Table structure for table `lms_tpack_section`
--

DROP TABLE IF EXISTS `lms_tpack_section`;
CREATE TABLE `lms_tpack_section` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_tpack` varchar(15) NOT NULL,
  `section_title` varchar(100) NOT NULL,
  `sequence` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_tpack_section`
--

INSERT INTO `lms_tpack_section` (`id`, `uc`, `uc_tpack`, `section_title`, `sequence`) VALUES
(1, 'ps0101', 'p01', 'Pendahuluan', 1),
(2, 'ps0102', 'p01', 'Air Compressor System', 2),
(3, 'ps0103', 'p01', 'Fresh Water Generator', 3),
(4, 'ps0104', 'p01', 'Introducing of Pump', 4),
(5, 'ps0105', 'p01', 'Valve System', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lms_user`
--

DROP TABLE IF EXISTS `lms_user`;
CREATE TABLE `lms_user` (
  `id` int(11) NOT NULL,
  `uc` varchar(15) NOT NULL,
  `uc_person` varchar(15) NOT NULL COMMENT '= lms_student/lms_instructor.uc',
  `uc_prodi` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(350) NOT NULL,
  `category` smallint(6) NOT NULL COMMENT '0 = super, 1 = administrator, 2 = instructor, 3 = student',
  `email` varchar(200) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_user`
--

INSERT INTO `lms_user` (`id`, `uc`, `uc_person`, `uc_prodi`, `username`, `password`, `category`, `email`, `photo`, `is_active`, `is_online`, `last_login`) VALUES
(1, 'ADM0001', '', '', 'admin', '$2y$10$TvDpqvVKO8atqtSfzHjMuO0YaDXwPuW.YH5bAKnsN6CAHZZ4AgHhO', 1, 'admin@admin.com', '', 1, 0, '0000-00-00 00:00:00'),
(2, '60fa0701adb29', '60fa05a935986', '', 'tigor', '$2y$10$L9n75ctLiAKvuOTyov7lKu.tjAsRsqQFWROlxYZeedzVWYk/Elppu', 2, 'dyordhanideri@gmail.com', '', 1, 0, '2021-07-23 07:02:16'),
(3, '60fa8f4176440', '', '60fa032a04886', 'prodimesin', '$2y$10$yJJW3KJLrwu0y5lm5DQk..nm1nTBtaLMlSkM3jLMQjM1sy6g2BDpG', 4, 'prodimesin@admin.com', '', 1, 0, '2021-07-23 16:43:29'),
(4, '60fa940fc4d0a', '60fa05c8d3bdc', '', 'nadira', '$2y$10$qqbPB4/LUGMKuYj3yDnSF.DBmsLhEL1M/Wy.gMiqG4ztoP2JiJAhu', 3, 'dyordhanideri@gmail.com', '', 1, 0, '2021-07-23 17:04:06'),
(5, '60fa9548b594b', '60fa950b306b3', '', 'galih', '$2y$10$ttFkCKlwaxgM1MHEynT3yuxj/Lo12tXWZs0OB93tNcc2xViO3kf0S', 3, 'dyordhanideri@gmail.com', '', 1, 0, '2021-07-23 17:09:19'),
(6, '60fb8c261ec42', '60fb865ad1e68', '', 'tono', '$2y$10$xFAXw13LTF2xbJDWC8SSquZOZahgncMULP8AMlceJFNUe6hZbY0zq', 3, 'dyordhanideri@gmail.com', '', 1, 0, '2021-07-24 10:42:36'),
(7, '60fb8fcc52507', '60fb848b0e5a1', '', 'sovia', '$2y$10$0ILjK..tZ2kgCg5IBVSYBuHsAdbpWSqyrntShvY2zxxD5i.5VlJIy', 2, 'dyordhanideri@gmail.com', '', 1, 0, '2021-07-24 10:58:10'),
(8, '60fd20aeca956', '60fa05c8d3d1a', '', 'karyo', '$2y$10$/YoMm.OnkwJ1yhabh15jjefkTUDHvIbeWRRb2u47YtcE0IhshGr4q', 3, 'dyordhanideri@gmail.com', '', 0, 0, '2021-07-25 15:28:37'),
(9, '61020e09e15a6', '', '60fa03323e658', 'prodinautika', '$2y$10$4wGFWHDJgTocboGJ8jf78OrCgqyNGiYZ6KiVzYJsfaGxi4OoSzEIy', 4, 'prodinautika@admin.com', '', 1, 0, '2021-07-28 22:10:17'),
(10, '61020e432fc83', '', '60fa033e4f484', 'proditransla', '$2y$10$QQJWHM5P18B3F.vv0NsYNu2VWmcKswfpEAGygrU/6bO/uMck.Cb26', 4, 'proditransla@admin.com', '', 1, 0, '2021-07-28 22:11:15'),
(11, '61022fbac4f42', '60fb848b0e4b3', '', 'dellfadel', '$2y$10$nObBtnqv26XYEx84gfpIFugBrLIb68GpArOy2gsrDztmyzf8yo5Te', 2, 'dell.fadel86@gmail.com', '', 1, 0, '2021-07-29 00:34:09'),
(12, '61023030a705e', '60fa05a9358d7', '', 'FIRDAUS, S. Tr. Pel', '$2y$10$BOnxL7.nkdaNtJVGwW8eBu4ZnqAERX25wJzlQpklM9OEb9x5b3qFi', 2, 'firdaussaputra23@gmail.com', '', 1, 0, '2021-07-29 00:36:06'),
(13, '61023038329b0', '60fa05a935707', '', 'SUROYO', '$2y$10$Jnp/21g1nzBoIIfwg/ChpevDNkBoGT05v98ND.0jSE//IpZgGrSNa', 2, 'suroyoop6040@gmail.com', '', 1, 0, '2021-07-29 00:36:13'),
(14, '610231744bb98', '60fb865ad1e68', '', 'ian', '$2y$10$Gy38o1tfoCTTPTB.1sFwf..S.SHwet4VTFb8H7sFNf1.cHWtcR8KC', 3, 'dell.fadel86@gmail.com', '', 1, 0, '2021-07-29 00:41:30'),
(15, '612de0ad3b059', '612de0799305d', '', 'TRIAL008', '$2y$10$lUSqCuozhcXXo16m0Kl7BeIU1B1hQTizmrVNtbVW7zeSIQHsMmdeG', 3, 'macderi1996@icloud.com', '', 1, 0, '2021-08-31 03:56:34'),
(16, '612de32d690e1', '612de0799305d', '', 'macderi', '$2y$10$ItXy6cBKii2l8f2/5BiL7Ojskz1dkE...mHdysRsBfSOVJoTxDn.q', 3, 'dyordhanideri@gmail.com', '', 1, 0, '2021-08-31 04:07:15'),
(17, '612de74b8d069', '612de07992db4', '', 'TRIAL004', '$2y$10$VaTQCXkqeBM0Lpye7Mn11.oLKUo4QSNd.BjYNmjhB5xNTKnyI1BTu', 3, 'macderi1996@icloud.com', '', 1, 0, '2021-08-31 04:24:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lms_assessment`
--
ALTER TABLE `lms_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_assignment_score`
--
ALTER TABLE `lms_assignment_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_ass_attempt`
--
ALTER TABLE `lms_ass_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_ass_essay_answer`
--
ALTER TABLE `lms_ass_essay_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_ass_options`
--
ALTER TABLE `lms_ass_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_ass_question`
--
ALTER TABLE `lms_ass_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_chats_messages`
--
ALTER TABLE `lms_chats_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_classroom`
--
ALTER TABLE `lms_classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_comment`
--
ALTER TABLE `lms_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_content`
--
ALTER TABLE `lms_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_content_files`
--
ALTER TABLE `lms_content_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_diklat`
--
ALTER TABLE `lms_diklat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_diklat_class`
--
ALTER TABLE `lms_diklat_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_diklat_dkp`
--
ALTER TABLE `lms_diklat_dkp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_diklat_participant`
--
ALTER TABLE `lms_diklat_participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_diklat_participant_temp`
--
ALTER TABLE `lms_diklat_participant_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_diklat_period`
--
ALTER TABLE `lms_diklat_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_fgroup`
--
ALTER TABLE `lms_fgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_fgroup_participant`
--
ALTER TABLE `lms_fgroup_participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_forum`
--
ALTER TABLE `lms_forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_forum_comment`
--
ALTER TABLE `lms_forum_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_groups_chats`
--
ALTER TABLE `lms_groups_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_groups_members`
--
ALTER TABLE `lms_groups_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_instructor`
--
ALTER TABLE `lms_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_instructor_temp`
--
ALTER TABLE `lms_instructor_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_kehadiran`
--
ALTER TABLE `lms_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_level`
--
ALTER TABLE `lms_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_prodi`
--
ALTER TABLE `lms_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_question`
--
ALTER TABLE `lms_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_question_options`
--
ALTER TABLE `lms_question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_schedule`
--
ALTER TABLE `lms_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_sched_plot`
--
ALTER TABLE `lms_sched_plot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_sched_week`
--
ALTER TABLE `lms_sched_week`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_section`
--
ALTER TABLE `lms_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_student`
--
ALTER TABLE `lms_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_student_temp`
--
ALTER TABLE `lms_student_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_subject`
--
ALTER TABLE `lms_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_tpack`
--
ALTER TABLE `lms_tpack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_tpack_page`
--
ALTER TABLE `lms_tpack_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_tpack_section`
--
ALTER TABLE `lms_tpack_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_user`
--
ALTER TABLE `lms_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lms_assessment`
--
ALTER TABLE `lms_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_assignment_score`
--
ALTER TABLE `lms_assignment_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_ass_attempt`
--
ALTER TABLE `lms_ass_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_ass_essay_answer`
--
ALTER TABLE `lms_ass_essay_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_ass_options`
--
ALTER TABLE `lms_ass_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_ass_question`
--
ALTER TABLE `lms_ass_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_chats_messages`
--
ALTER TABLE `lms_chats_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_classroom`
--
ALTER TABLE `lms_classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lms_comment`
--
ALTER TABLE `lms_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_content`
--
ALTER TABLE `lms_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lms_content_files`
--
ALTER TABLE `lms_content_files`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `lms_diklat`
--
ALTER TABLE `lms_diklat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lms_diklat_class`
--
ALTER TABLE `lms_diklat_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lms_diklat_dkp`
--
ALTER TABLE `lms_diklat_dkp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `lms_diklat_participant`
--
ALTER TABLE `lms_diklat_participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `lms_diklat_participant_temp`
--
ALTER TABLE `lms_diklat_participant_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_diklat_period`
--
ALTER TABLE `lms_diklat_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `lms_fgroup`
--
ALTER TABLE `lms_fgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_fgroup_participant`
--
ALTER TABLE `lms_fgroup_participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_forum`
--
ALTER TABLE `lms_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_forum_comment`
--
ALTER TABLE `lms_forum_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_groups_members`
--
ALTER TABLE `lms_groups_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_instructor`
--
ALTER TABLE `lms_instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `lms_instructor_temp`
--
ALTER TABLE `lms_instructor_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_kehadiran`
--
ALTER TABLE `lms_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lms_level`
--
ALTER TABLE `lms_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_prodi`
--
ALTER TABLE `lms_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lms_question`
--
ALTER TABLE `lms_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_question_options`
--
ALTER TABLE `lms_question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_schedule`
--
ALTER TABLE `lms_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lms_sched_plot`
--
ALTER TABLE `lms_sched_plot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_sched_week`
--
ALTER TABLE `lms_sched_week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lms_section`
--
ALTER TABLE `lms_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `lms_student`
--
ALTER TABLE `lms_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `lms_student_temp`
--
ALTER TABLE `lms_student_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_subject`
--
ALTER TABLE `lms_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `lms_tpack`
--
ALTER TABLE `lms_tpack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lms_tpack_page`
--
ALTER TABLE `lms_tpack_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `lms_tpack_section`
--
ALTER TABLE `lms_tpack_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lms_user`
--
ALTER TABLE `lms_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
