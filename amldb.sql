-- aml stands for AAA Movie Library
drop database if exists aml;
create database aml;
use aml;

create table admin_data (
    admin_id varchar(7) not null primary key,
    password_hash varchar(80) -- hash of the admin password
) engine = InnoDB;

insert into admin_data values("admin", "$2y$10$gmvUlKSALDqtvnoAhDrpn.F/XvTS.6pQPO37vfWl3EukVNc7yfGVG");

create table movie (
    movie_id int not null auto_increment primary key,
    title varchar(100) not null,
    year int not null,
    genre varchar(100) not null,
    img_path varchar(300) not null,
    synopsis varchar(1000),
    ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine = InnoDB;
