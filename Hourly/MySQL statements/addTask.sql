DELIMITER //

CREATE PROCEDURE COMP3000_STong.add_task(IN username VARCHAR(20), IN moduleCode VARCHAR(50), IN taskName VARCHAR(150), IN taskCategory VARCHAR(10), IN dueDate DATE, IN dueTime TIME, priorityLevel VARCHAR(6))
	BEGIN
	
	INSERT INTO COMP3000_STong.task(user_id, module_code, task_name, task_category, due_date, due_time, priority_level)
	VALUES(username, moduleCode, taskName, taskCategory, dueDate, dueTime, priorityLevel);
	
	END	//
	
DELIMITER ;
	