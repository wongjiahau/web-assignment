-- aml stands for AAA Movie Library
drop database aml;
create database aml;
use aml;

create table admin_data (
    admin_id varchar(7) not null primary key,
    password_hash varchar(50) -- hash of the admin password
) engine = InnoDB;

insert into admin_data values("admin", "1234");

create table video (
    video_id int not null auto_increment primary key,
    title varchar(100) not null,
    year int not null,
    genre varchar(100) not null,
    img_path varchar(300) not null,
    synopsis varchar(1000)
) engine = InnoDB;

-- optional table
create table customer (
    customer_id int not null auto_increment primary key,
    uname varchar(50) not null
) engine = InnoDB;

-- optional table
create table rent (
    rent_id int not null auto_increment primary key,
    video_id int not null,
    customer_id int not null,
    date datetime, 
    constraint `rent_ref_video_id` foreign key (video_id) references video(video_id),
    constraint `rent_ref_customer_id` foreign key (customer_id) references customer(customer_id)
) engine = InnoDB;

show tables;