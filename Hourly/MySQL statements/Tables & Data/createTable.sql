CREATE TABLE COMP3000_STong.user(
	user_id VARCHAR(20) NOT NULL PRIMARY KEY,
	password VARCHAR(300) NOT NULL,
	email VARCHAR(100) NOT NULL,
	birth_date DATE NOT NULL,
	daily_goal BOOLEAN NOT NULL DEFAULT False,
	weekly_goal BOOLEAN NOT NULL DEFAULT False,
	weekly_hours INT NOT NULL DEFAULT 36,
	daily_hours INT NOT NULL DEFAULT 7,
	report_subscription BOOLEAN NOT NULL DEFAULT False
);

CREATE TABLE COMP3000_STong.module(
	user_id VARCHAR(20) NOT NULL,
	module_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	module_name VARCHAR(50) NOT NULL,
	module_code VARCHAR(50) NOT NULL,
	colour_key VARCHAR(7) NOT NULL,
	expected_hours INT(3),
	FOREIGN KEY (user_id) REFERENCES COMP3000_STong.user(user_id)
);

CREATE TABLE COMP3000_STong.reminder(
	user_id VARCHAR(20) NOT NULL,
	reminder_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	description VARCHAR(150) NOT NULL,
	datestamp DATE,
	FOREIGN KEY (user_id) REFERENCES COMP3000_STong.user(user_id)
);

CREATE TABLE COMP3000_STong.class(
	user_id VARCHAR(20) NOT NULL,
	module_id INT NOT NULL,
	class_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	class_name VARCHAR(100) NOT NULL,
	class_room VARCHAR(10),
	class_day VARCHAR(8) NOT NULL,
	start_time TIME NOT NULL,
	class_duration TIME NOT NULL,
	FOREIGN KEY (user_id) REFERENCES COMP3000_STong.user(user_id),
	FOREIGN KEY (module_id) REFERENCES COMP3000_STong.module(module_id)
);

CREATE TABLE COMP3000_STong.task(
	module_id INT NOT NULL,
	task_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	task_name VARCHAR(150) NOT NULL,
	task_status VARCHAR(10) NOT NULL,
	task_category VARCHAR(10) NOT NULL DEFAULT 'Ongoing',
	due_date DATE,
	due_time TIME,
	priority_level VARCHAR(6),
	FOREIGN KEY (module_id) REFERENCES COMP3000_STong.module(module_id)
);

CREATE TABLE COMP3000_STong.time_log(
	user_id VARCHAR(20) NOT NULL,
	task_id INT NOT NULL,
	time_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	duration TIME NOT NULL,
	description VARCHAR(150),
	time_stamp DATE NOT NULL,
	FOREIGN KEY (task_id) REFERENCES COMP3000_STong.task(task_id),
	FOREIGN KEY (user_id) REFERENCES COMP3000_STong.user(user_id)
);

INSERT INTO `user` (`user_id`, `password`, `email`, `birth_date`, `daily_goal`, `weekly_goal`, `weekly_hours`, `daily_hours`, `report_subscription`) 
VALUES ('dummy', 'password', 'email@email.com', '1999-10-12', '0', '0', '36', '7', '0');

CREATE TABLE COMP3000_STong.archive_task like COMP3000_STong.task
CREATE TABLE COMP3000_STong.archive_time_log LIKE COMP3000_STong.time_log
CREATE TABLE COMP3000_STong.archive_class LIKE COMP3000_STong.class
CREATE TABLE COMP3000_STong.archive_reminder LIKE COMP3000_STong
