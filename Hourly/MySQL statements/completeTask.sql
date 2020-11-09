DELIMITER //

CREATE PROCEDURE COMP3000_STong.complete_task(IN username VARCHAR(20), IN moduleCode VARCHAR(50))
	BEGIN
		UPDATE COMP3000_STong.task
		SET task_category = 'Complete'
		WHERE
		user_id = username
		AND
		module_code = moduleCode
	END
	
DELIMITER