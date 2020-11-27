DELIMITER //

CREATE PROCEDURE COMP3000_STong.test_get_task(IN taskName VARCHAR(150))
	BEGIN
		SELECT
			task_id,
			task_name,
			task_status,
			task_category,
			due_date,
			due_time, 
			priority_level
		FROM
			COMP3000_STong.task
		WHERE
			task_name = taskName;
	END //
DELIMITER