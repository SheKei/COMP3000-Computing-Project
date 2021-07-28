DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_task(IN taskId INT)
	BEGIN
		INSERT INTO COMP3000_STong.archive_task
		SELECT * FROM COMP3000_STong.task
		WHERE task.task_id = taskID;
		DELETE FROM 
		COMP3000_STong.task
		WHERE
		task_id = taskId;
	END //
DELIMITER