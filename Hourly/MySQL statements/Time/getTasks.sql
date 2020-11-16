DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_tasks(IN username VARCHAR(20))
	BEGIN
		SELECT
		module_code,
		task_id,
		task_name
		FROM
		COMP3000_STong.task
		WHERE
		user_id = username
        AND
        task_status = "Ongoing";
	END //
	
DELIMITER