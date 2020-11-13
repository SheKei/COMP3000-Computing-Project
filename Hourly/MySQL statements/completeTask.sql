DELIMITER //

CREATE PROCEDURE COMP3000_STong.complete_task(IN username VARCHAR(20), IN taskId INT)
	BEGIN
		UPDATE COMP3000_STong.task
		SET task_category = 'Complete'
		WHERE
		user_id = username
		AND
		task_id = taskId;
	END //
	
DELIMITER