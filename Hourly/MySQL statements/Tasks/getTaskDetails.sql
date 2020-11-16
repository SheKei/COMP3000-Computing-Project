DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_task_details(IN taskId INT)
	BEGIN
		SELECT
			task_name,
			task_status,
			task_category,
			due_date,
			due_time,
			priority_level
		FROM
			COMP3000_STong.task
		WHERE
			task_id = taskId;
	END //
DELIMITER