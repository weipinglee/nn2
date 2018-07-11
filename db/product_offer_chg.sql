ALTER TABLE `product_offer`  ADD COLUMN `accept_area_code`  varchar(6) NOT NULL COMMENT '交收地址代码' ;
ALTER TABLE `product_offer`
MODIFY COLUMN `accept_day`  varchar(20) NOT NULL COMMENT '交收时间' AFTER `accept_area`;

ALTER TABLE `products`
ADD COLUMN `produce_address`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '产地地址' ;

ALTER TABLE `product_offer`
ADD COLUMN `jingjia_deposit`  decimal(12,2) NOT NULL DEFAULT 0 COMMENT '竞价保证金' AFTER `accept_area_code`;

ALTER TABLE `user_pay_log`
MODIFY COLUMN `acc_bank`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '银行名称' AFTER `subject`;
ALTER TABLE `user_pay_log`
MODIFY COLUMN `acc_name`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '开户人的名字' AFTER `acc_no`;
