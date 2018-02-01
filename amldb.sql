-- aml stands for AAA Movie Library
create database aml;
use aml;

create table admin_data (
    password_hash varchar(50), -- hash of the admin password
);

create table video (
    video_id int not null auto_increment primary key,
    title varchar(100) not null,
    year int not null,
    genre varchar(20) not null,
    img_path varchar(100) not null
    synopsis varchar(1000),
);

-- optional table
create table customer (
    customer_id int not null auto_increment primary key,
    uname varchar(50) not null
);

-- optional table
create table rent (
    rent_id int not null auto_increment primary key,
    video_id int,
    customer_id int,
    date datetime, 
    foreign key (video_id) references video(video_id),
    foreign key (customer_id) references video(customer_id)
);