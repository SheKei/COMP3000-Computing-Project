DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_task(IN taskId INT)
	BEGIN
		DELETE FROM 
		COMP3000_STong.task
		WHERE
		task_id = taskId;
	END //
DELIMITER