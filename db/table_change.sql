
ALTER TABLE `admin_check`
MODIFY COLUMN `admin_names`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `admin_id`
