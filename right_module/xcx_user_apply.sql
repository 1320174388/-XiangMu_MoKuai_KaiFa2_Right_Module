/*
 Navicat MySQL Data Transfer

 Source Server         : 1
 Source Server Type    : MySQL
 Source Server Version : 50547
 Source Host           : localhost:3306
 Source Schema         : xcx_test

 Target Server Type    : MySQL
 Target Server Version : 50547
 File Encoding         : 65001

 Date: 21/06/2018 09:42:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for xcx_user_apply
-- ----------------------------
DROP TABLE IF EXISTS `xcx_user_apply`;
CREATE TABLE `xcx_user_apply`  (
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `user_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'token',
  `time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '时间'
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for xcx_user_info
-- ----------------------------
DROP TABLE IF EXISTS `xcx_user_info`;
CREATE TABLE `xcx_user_info`  (
  `user_level` tinyint(2) NULL DEFAULT NULL COMMENT '级别',
  `user_token` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户标识',
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称'
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for xcx_user_power
-- ----------------------------
DROP TABLE IF EXISTS `xcx_user_power`;
CREATE TABLE `xcx_user_power`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level` tinyint(2) NULL DEFAULT NULL COMMENT '级别',
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
