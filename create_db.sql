/*
 Navicat Premium Data Transfer

 Source Server         : wam
 Source Server Type    : MySQL
 Source Server Version : 50711
 Source Host           : localhost:3306
 Source Schema         : db_dorm

 Target Server Type    : MySQL
 Target Server Version : 50711
 File Encoding         : 65001

 Date: 31/12/2019 20:23:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account`(`account`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES (1, 'cjw', '12345', '林宿管', '男');

-- ----------------------------
-- Table structure for t_class
-- ----------------------------
DROP TABLE IF EXISTS `t_class`;
CREATE TABLE `t_class`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `teacher_id` int(255) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `teacher_id`(`teacher_id`) USING BTREE,
  CONSTRAINT `t_class_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `t_teacher` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_class
-- ----------------------------
INSERT INTO `t_class` VALUES (1, '应用技术学院', '物联网工程', 1);
INSERT INTO `t_class` VALUES (2, '应用技术学院', '网络工程', 1);
INSERT INTO `t_class` VALUES (3, '交通运输学院', '车辆工程', 2);

-- ----------------------------
-- Table structure for t_dorm
-- ----------------------------
DROP TABLE IF EXISTS `t_dorm`;
CREATE TABLE `t_dorm`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `building` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bed` int(2) NULL DEFAULT NULL,
  `sex` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_dorm
-- ----------------------------
INSERT INTO `t_dorm` VALUES (1, 'A', '102', 4, '女');
INSERT INTO `t_dorm` VALUES (2, 'A', '100', 4, '女');
INSERT INTO `t_dorm` VALUES (3, 'A', '101', 4, '女');
INSERT INTO `t_dorm` VALUES (4, 'B', '210', 4, '男');
INSERT INTO `t_dorm` VALUES (5, 'B', '211', 4, '男');
INSERT INTO `t_dorm` VALUES (6, 'C', '310', 6, '男');
INSERT INTO `t_dorm` VALUES (7, 'C', '301', 6, '女');
INSERT INTO `t_dorm` VALUES (8, 'C', '302', 6, '女');
INSERT INTO `t_dorm` VALUES (9, 'B', '202', 4, '男');
INSERT INTO `t_dorm` VALUES (10, 'B', '201', 4, '男');

-- ----------------------------
-- Table structure for t_dorm_maintain
-- ----------------------------
DROP TABLE IF EXISTS `t_dorm_maintain`;
CREATE TABLE `t_dorm_maintain`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dorm_id` int(10) UNSIGNED NOT NULL,
  `request` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_response` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `dorm_id`(`dorm_id`) USING BTREE,
  CONSTRAINT `t_dorm_maintain_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `t_dorm` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_dorm_maintain
-- ----------------------------
INSERT INTO `t_dorm_maintain` VALUES (1, 1, '阳台水龙头漏水', '已修复', '2019-12-25 23:11:57');
INSERT INTO `t_dorm_maintain` VALUES (2, 4, '室内日光灯故障', '已换新的日光灯', '2019-12-25 23:13:15');
INSERT INTO `t_dorm_maintain` VALUES (3, 6, '大门锁芯故障', '已修复！', '2019-12-26 14:57:26');
INSERT INTO `t_dorm_maintain` VALUES (4, 2, '空调异响', '已联系厂家维修', '2019-12-25 23:14:26');
INSERT INTO `t_dorm_maintain` VALUES (5, 1, '浴室灯的开关接触不良', '已维修', '2019-12-25 22:15:19');
INSERT INTO `t_dorm_maintain` VALUES (6, 4, '插座没电', '已修复，请安全用电', '2019-12-26 15:31:23');
INSERT INTO `t_dorm_maintain` VALUES (7, 4, '日光灯接触不良', NULL, '2019-12-26 15:29:09');
INSERT INTO `t_dorm_maintain` VALUES (8, 10, '台灯损坏', 'yixiufu', '2019-12-26 16:38:57');

-- ----------------------------
-- Table structure for t_student
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `sex` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account`(`account`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  CONSTRAINT `t_student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `t_class` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student
-- ----------------------------
INSERT INTO `t_student` VALUES (1, '2188127112', 'password', '杰文', 1, '男');
INSERT INTO `t_student` VALUES (2, '2188127211', 'password', '素尼', 3, '女');
INSERT INTO `t_student` VALUES (3, '2188127137', 'password', '嘉程', 1, '男');
INSERT INTO `t_student` VALUES (4, '2188127141', 'password', '志荣', 1, '男');
INSERT INTO `t_student` VALUES (5, '2188127134', 'password', '跃明', 1, '男');
INSERT INTO `t_student` VALUES (6, '2188127104', 'password', '志航', 2, '男');
INSERT INTO `t_student` VALUES (8, '2188127119', 'password', '英豪', 1, '男');
INSERT INTO `t_student` VALUES (10, '2188127132', 'password', '昌裕', 3, '男');
INSERT INTO `t_student` VALUES (11, '2188127102', 'password', '榕榕', 1, '女');
INSERT INTO `t_student` VALUES (12, '2188127133', 'password', '榆聪', 1, '男');
INSERT INTO `t_student` VALUES (13, '2188127103', 'password', '靖涵', 3, '男');
INSERT INTO `t_student` VALUES (14, '2188127128', 'password', '艳艳', 2, '女');
INSERT INTO `t_student` VALUES (17, '2188127101', 'password', '思婧', 1, '女');
INSERT INTO `t_student` VALUES (18, '2188127116', 'password', '晨曦', 1, '男');
INSERT INTO `t_student` VALUES (19, '2188127121', 'password', '毓铭', 3, '男');

-- ----------------------------
-- Table structure for t_student_dorm
-- ----------------------------
DROP TABLE IF EXISTS `t_student_dorm`;
CREATE TABLE `t_student_dorm`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(11) UNSIGNED NOT NULL,
  `dorm_id` int(11) UNSIGNED NOT NULL,
  `supervisor` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `dorm_id`(`dorm_id`) USING BTREE,
  CONSTRAINT `t_student_dorm_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `t_student` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_student_dorm_ibfk_2` FOREIGN KEY (`dorm_id`) REFERENCES `t_dorm` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student_dorm
-- ----------------------------
INSERT INTO `t_student_dorm` VALUES (2, 2, 1, '否');
INSERT INTO `t_student_dorm` VALUES (50, 8, 5, '否');
INSERT INTO `t_student_dorm` VALUES (51, 19, 5, '否');
INSERT INTO `t_student_dorm` VALUES (53, 6, 6, '否');
INSERT INTO `t_student_dorm` VALUES (58, 10, 6, '否');
INSERT INTO `t_student_dorm` VALUES (66, 17, 1, '否');

-- ----------------------------
-- Table structure for t_student_dorm_exchange
-- ----------------------------
DROP TABLE IF EXISTS `t_student_dorm_exchange`;
CREATE TABLE `t_student_dorm_exchange`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `to_dorm_id` int(10) UNSIGNED NOT NULL,
  `date` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `request` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_response` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `teacher_response` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `to_dorm_id`(`to_dorm_id`) USING BTREE,
  CONSTRAINT `t_student_dorm_exchange_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `t_student` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_student_dorm_exchange_ibfk_2` FOREIGN KEY (`to_dorm_id`) REFERENCES `t_dorm` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student_dorm_exchange
-- ----------------------------
INSERT INTO `t_student_dorm_exchange` VALUES (1, 1, 3, '2019-12-25 22:23:00', '行政调换', '行吧OK！', '同意');
INSERT INTO `t_student_dorm_exchange` VALUES (2, 1, 5, '2019-12-25 23:16:19', '想和朋友去一个宿舍', '同意', '不同意');
INSERT INTO `t_student_dorm_exchange` VALUES (3, 17, 7, '2019-12-26 14:57:37', '申请入住', '同意', '同意');
INSERT INTO `t_student_dorm_exchange` VALUES (4, 17, 8, '2019-12-26 15:33:48', '申请入住', '该宿舍还在装修', '不同意');
INSERT INTO `t_student_dorm_exchange` VALUES (5, 1, 10, '2019-12-26 15:35:38', '想和老乡一个宿舍', '同意', '同意');
INSERT INTO `t_student_dorm_exchange` VALUES (6, 1, 5, '2019-12-26 16:44:08', '想去211', '同意', NULL);

-- ----------------------------
-- Table structure for t_student_leave
-- ----------------------------
DROP TABLE IF EXISTS `t_student_leave`;
CREATE TABLE `t_student_leave`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date_start` datetime(0) NOT NULL,
  `date_end` datetime(0) NOT NULL,
  `request` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `teacher_response` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  CONSTRAINT `t_student_leave_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `t_student` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student_leave
-- ----------------------------
INSERT INTO `t_student_leave` VALUES (1, 1, '2019-12-11 14:00:00', '2019-12-05 16:00:00', '校外兼职', '批准');
INSERT INTO `t_student_leave` VALUES (2, 1, '2019-12-04 11:19:00', '2020-01-23 11:19:00', '校外兼职', '不同意');
INSERT INTO `t_student_leave` VALUES (3, 2, '2019-11-29 00:00:00', '2019-11-30 00:00:00', '发烧就医', '批准');
INSERT INTO `t_student_leave` VALUES (4, 1, '2019-12-26 22:29:00', '2019-12-28 22:29:00', '搬家，回家帮忙', '批准');
INSERT INTO `t_student_leave` VALUES (5, 17, '2019-12-27 14:38:00', '2019-12-31 14:38:00', '家里有事要回去帮忙', '不同意');
INSERT INTO `t_student_leave` VALUES (6, 17, '2019-12-27 15:11:00', '2019-12-29 15:11:00', '校外兼职', NULL);
INSERT INTO `t_student_leave` VALUES (7, 1, '2019-12-27 16:40:00', '2019-12-28 16:40:00', '身体不适', '批准');

-- ----------------------------
-- Table structure for t_student_violation
-- ----------------------------
DROP TABLE IF EXISTS `t_student_violation`;
CREATE TABLE `t_student_violation`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `teacher_response` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  CONSTRAINT `t_student_violation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `t_student` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student_violation
-- ----------------------------
INSERT INTO `t_student_violation` VALUES (1, 1, '使用电磁炉', '2019-12-24 15:26:23', '已读');
INSERT INTO `t_student_violation` VALUES (2, 2, '私搭电线', '2019-12-25 22:36:31', '已读');
INSERT INTO `t_student_violation` VALUES (4, 17, '在宿舍养宠物狗', '2019-12-26 14:59:58', '已读');
INSERT INTO `t_student_violation` VALUES (5, 19, '测试违规', '2019-12-26 16:48:58', '已读');

-- ----------------------------
-- Table structure for t_teacher
-- ----------------------------
DROP TABLE IF EXISTS `t_teacher`;
CREATE TABLE `t_teacher`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account`(`account`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_teacher
-- ----------------------------
INSERT INTO `t_teacher` VALUES (1, '12345', 'password', '林老师', '女');
INSERT INTO `t_teacher` VALUES (2, '11111', 'password', '李老师', '男');

SET FOREIGN_KEY_CHECKS = 1;
