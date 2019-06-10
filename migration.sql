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

select * from publish

create user 'jorge'@'localhost' identified with mysql_native_password by 'teste'
grant all privileges on simple_email_subscribe.* to 'jorge'@'localhost' with grant option;