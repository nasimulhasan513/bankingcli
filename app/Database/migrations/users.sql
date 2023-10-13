DROP TABLE IF EXISTS users;
CREATE TABLE users (
id int primary key, 
name varchar(255),
email varchar(255),
password varchar(255),
balance int,
role varchar(255)
);