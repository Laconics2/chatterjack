/*
 Navicat MySQL Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : localhost:3306
 Source Schema         : chatterjack

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 20/03/2022 14:37:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for CLASS
-- ----------------------------
DROP TABLE IF EXISTS `CLASS`;
CREATE TABLE `CLASS` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_name` varchar(80) NOT NULL,
  `_where` varchar(3000) NOT NULL,
  `_who` varchar(3000) NOT NULL,
  `_what` varchar(3000) NOT NULL,
  `_when` varchar(3000) NOT NULL,
  `author` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of CLASS
-- ----------------------------
BEGIN;
INSERT INTO `CLASS` VALUES (1, 'cs480', 'Room 104 in SBS West', 'Dr. Michael', 'Operating System', '2 pm every Monday and Wednesday', 'Michael');
INSERT INTO `CLASS` VALUES (2, 'cs421', 'Room 204 in SBS West', 'Dr. Otte', 'Algorithm', '12:45 pm every Monday and Wednesday', 'Otte');
COMMIT;

-- ----------------------------
-- Table structure for ORG
-- ----------------------------
DROP TABLE IF EXISTS `ORG`;
CREATE TABLE `ORG` (
  `id` int NOT NULL AUTO_INCREMENT,
  `org_name` varchar(200) NOT NULL,
  `_where` varchar(5000) NOT NULL,
  `_what` varchar(5000) NOT NULL,
  `_who` varchar(5000) NOT NULL,
  `_how` varchar(5000) NOT NULL,
  `author` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ORG
-- ----------------------------
BEGIN;
INSERT INTO `ORG` VALUES (1, 'engineering building', 'Engineering Building', 'College of Engineering, Informatics, and Applied Sciences is NAU’s newest college', 'Dr. Andy Wang', 'Mountain 10 or LOUIE Bus', 'Andy Wang');
INSERT INTO `ORG` VALUES (2, 'ceias', 'Engineering Building', 'College of Engineering, Informatics, and Applied Sciences is NAU’s newest college', 'Dr. Andy Wang', 'Mountain 10 or LOUIE Bus', 'Andy Wang');
COMMIT;

-- ----------------------------
-- Table structure for PERSON
-- ----------------------------
DROP TABLE IF EXISTS `PERSON`;
CREATE TABLE `PERSON` (
  `id` int NOT NULL AUTO_INCREMENT,
  `person_name` varchar(3000) NOT NULL,
  `person_spe_name` varchar(3000) NOT NULL,
  `_where` varchar(3000) NOT NULL,
  `_who` varchar(3000) NOT NULL,
  `_when` varchar(3000) NOT NULL,
  `author` varchar(500) NOT NULL,
  `sex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PERSON
-- ----------------------------
BEGIN;
INSERT INTO `PERSON` VALUES (1, 'Kyle Nathan Winfree', 'Winfree', 'Room 315 in SICCS Building', 'associate director for Undergraduate Programs, SICCS', '3pm on every Wednesday', 'Kyle N Winfree', 'Male');
INSERT INTO `PERSON` VALUES (2, 'Doery E', 'D', 'Room 215 in SICCS Building', 'professor of the CEIAS', '2pm on every Wednesday', 'Doery', 'Male');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
