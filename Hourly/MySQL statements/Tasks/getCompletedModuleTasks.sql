DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_completed_module_tasks(IN username VARCHAR(20), IN moduleCode VARCHAR(50))
	BEGIN
		SELECT
		task_id,
		task_name,
		task_category
		FROM
		COMP3000_STong.task
		WHERE
		user_id = username
        AND
        task_status = "Completed"
		AND
		module_code = moduleCode
		ORDER BY task_category;
		
	END //
	
DELIMITER