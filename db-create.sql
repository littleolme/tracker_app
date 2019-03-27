-- CREATE DATABASE epiz_23648161_tracker_app;

use  epiz_23648161_tracker_app;


CREATE TABLE tasks (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	taskname VARCHAR(50) NOT NULL,
	taskdate VARCHAR(30) NOT NULL,
	tasktime VARCHAR(30),
    tasknotes VARCHAR(200),
	date TIMESTAMP
);