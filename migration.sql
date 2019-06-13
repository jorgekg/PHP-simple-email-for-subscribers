create database simple_email_subscribe
use simple_email_subscribe

create table publish(
id int auto_increment not null,
title varchar(255),
description text,
video text,
mime varchar(255),
primary key (id)
)

create table subscribe(
id int auto_increment not null,
name varchar(255) not null,
email varchar(255) not null,
primary key (id)
)

create table publish_subscribe(
id int auto_increment not null,
publish_id int,
subscribe_id int,
create_at datetime,
primary key (id),
foreign key (publish_id) references publish(id),
foreign key (subscribe_id) references subscribe(id)
)

create table layout_email (
id int auto_increment not null,
publish_id int,
message text,
primary key (id),
foreign key (publish_id) references publish(id)
)

select * from layout_email

select * from subscribe t1
	where not exists (
		select 1 from publish_subscribe t2
		 where t2.subscribe_id = t1.id
         and t2.publish_id = 1
         
         or (
         t2.create_at > DATE_SUB(now(), INTERVAL 1 DAY)
         and t2.subscribe_id = t1.id
         )
    )
    
select    DATE_SUB(now(), INTERVAL 1 DAY)

select * from publish_subscribe 



create user 'jorge'@'localhost' identified with mysql_native_password by 'teste'
grant all privileges on simple_email_subscribe.* to 'jorge'@'localhost' with grant option;