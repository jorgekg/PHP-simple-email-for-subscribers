create database simple_email_subscribe
use simple_email_subscribe

create table publish(
id int auto_increment not null,
title varchar(255),
description text,
video text,
primary key (id)
)
