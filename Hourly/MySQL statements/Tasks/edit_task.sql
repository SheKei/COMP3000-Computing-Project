DELIMITER //

CREATE PROCEDURE COMP3000_STong.edit_task(IN taskId INT, IN moduleCode VARCHAR(50), IN taskName VARCHAR(150), IN taskCategory VARCHAR(10), IN dueDate DATE, IN dueTime TIME, IN priorityLevel VARCHAR(6))
	BEGIN
		UPDATE COMP3000_STong.task
		SET
		module_code = moduleCode,
		task_name = taskName,
		task_category = taskCategory,
		due_date = dueDate,
		due_time = dueTime,
		priority_level = priorityLevel
		WHERE
		task_id = taskId
	END //
	
DELIMITER
		