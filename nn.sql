create table if not exists `market_stats`(
  `id` int(11) unsigned not null auto_increment comment '主键Id',
  `name` varchar(30) not null default '' comment '统计的名称',
  `cate_id` int(11) not null default 0 comment '所属的分类',
  `status` tinyint(2) not null default 0 comment '0关闭，1开启',
  `is_del` tinyint(2) not null default 0 comment '1删除，0没删除',
  `create_time` datetime not null default now() comment '时间'
  primary key(`id`)
)engine=innodb charset=utf8;
create table if not exists `market_stats_data`(
  `id` int(11) unsigned not null auto_increment comment '主键Id',
  `price` DECIMAL(10,2) not null default 0 comment '价格',
  `market_stats_id` int(11) not null default 0 comment '统计名称的Id',
  `create_time` datetime not null default now() comment '统计的时间',
  primary key(`id`)
)engine=innodb charset=utf8;
create table text2(
  `id` text,
  `name` VARCHAR(20),
  PRIMARY key(`id`)
)engine=innodb charset=utf8;