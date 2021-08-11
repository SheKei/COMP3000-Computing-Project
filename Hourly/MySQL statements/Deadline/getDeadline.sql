DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_deadlines(IN username VARCHAR(20))
	BEGIN
		SELECT
		module_code,
		task_id,
		task_name,
		due_date,
		due_time,
		priority_level
		FROM
		COMP3000_STong.task,
		COMP3000_STong.user
		WHERE
		user_id = username
		AND
		due_date BETWEEN CURDATE() AND ADDDATE(CURDATE(), INTERVAL user.deadline_period DAY)
        AND
        task_status = "Ongoing";
	END //
	
DELIMITER