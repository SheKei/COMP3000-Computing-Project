DELIMITER //
CREATE PROCEDURE COMP3000_STong.archive_task(IN taskID INT)
	BEGIN
		INSERT INTO COMP3000_STong.archive_task
		SELECT * FROM COMP3000_STong.task
		WHERE task.task_id = taskID;
	END //
DELIMITER