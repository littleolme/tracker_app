-- CREATE DATABASE epiz_23648161_register;

use  epiz_23648161_register;


CREATE TABLE users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	username VARCHAR(50) NOT NULL,
	passwords VARCHAR(255) NOT NULL,
    date TIMESTAMP
);