DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
id int primary key, 
name varchar(255),
email varchar(255),
transaction_type varchar(255),
amount int,
date varchar(255)
);