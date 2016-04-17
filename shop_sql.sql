create database if not exists shop27 charset=utf8;
-- 增加一个独立管理shop27库的mysql服务器用户
create user 'shop27'@'%' identified by '1234abcd';
grant all privileges on shop27.* to 'shop27'@'%';

use `shop27`;

-- 管理员表
create table if not exists `it_admin` (
admin_id int unsigned primary key auto_increment,
admin_name varchar(20) not null unique key,
admin_pass char(32),
login_time int,
login_ip int,
login_num tinyint,
email varchar(255)
) charset=utf8;

insert into `it_admin` values 
(23, 'admin', md5('1234abcd'), 1234567890, 1234567890, 0, 'admin@kang.com'),
(34, '王力', md5('1234abcd'), 1234567890, 1234567890, 0, 'liwang@kang.com');

/*创建session表*/
create table if not exists `it_session` (
sess_id varchar(32)  primary key,
sess_data text ,
expires int(11)
) charset=utf8;


create table if not exists `it_category`(
cat_id int unsigned primary key auto_increment,
cat_name varchar(20) not null ,
sort_order int not null default 100,
parent_id int unsigned not null default 0 comment '父分类ID，顶级分类的parent_id为0'
)charset=utf8;

insert into it_category values
	(23,'电脑办公',default,0),
	(12,'手机数码',default,0),
	(56,'户外运动',default,0),
	(9,'外设产品',default,23),
	(99,'电脑整机',default,23),
	(66,'健身训练',default,56),
	(57,'户外装备',default,56),
	(13,'平板电脑',default,99),
	(7,'笔记本',default,99),
	(10,'跑步机',default,66);