<?php 
include_once('classes.php');

$ct1= 'create table roles(
id	int not null auto_increment primary key,
rolename varchar (20) not null unique) default charset="utf8"';	

$ct2= 'create table groups(
id	int not null auto_increment primary key,
groupname varchar (20) not null unique) default charset="utf8"';	

$ct3= 'create table users(
id	int not null auto_increment primary key,
username varchar (30) not null unique,
pass varchar (255) not null,
email varchar (255),
discount int default 0,
roleid int,
foreign key (roleid) references roles (id)
on delete cascade on update cascade) default charset="utf8"';	

$ct4= 'create table products(
id	int not null auto_increment primary key,
productname varchar (100) not null,
groupid int,
foreign key (groupid) references groups (id)
on delete cascade,
country varchar (50),
price int,
datein date,
info varchar (2048)
)default charset="utf8"';	 



$ct5= 'create table images(
id	int not null auto_increment primary key,
productid int,
foreign key (productid)references groups (id)
on delete cascade,
imagepath varchar (255)
)default charset="utf8"';

$ct6= 'create table sales(
id	int not null auto_increment primary key,
product varchar(100),
price int,
country varchar (50),
datein date,
datesale date,
groupid int,
foreign key (groupid)references groups (id)
on delete cascade
)default charset="utf8"';



$ct7 = 'create table image(
id	int not null auto_increment primary key,
imagepath varchar (255)
)default charset="utf8"';



// вызывать  запросы по очереди
//Tools::CreateTable($ct1);

//Tools::CreateTable($ct2);

//Tools::CreateTable($ct3);

//Tools::CreateTable($ct4);

//Tools::CreateTable($ct5);

//Tools::CreateTable($ct6);

Tools::CreateTable($ct7);

 ?>