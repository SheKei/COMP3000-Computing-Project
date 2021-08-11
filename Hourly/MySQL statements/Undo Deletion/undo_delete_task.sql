DELIMITER //
CREATE PROCEDURE COMP3000_STong.undo_delete_task(IN taskID INT)
	BEGIN
		INSERT INTO COMP3000_STong.task
		SELECT * FROM COMP3000_STong.archive_task
		WHERE archive_task.task_id = taskID;
	END //
DELIMITER