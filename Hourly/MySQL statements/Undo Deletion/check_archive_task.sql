DELIMITER //
CREATE PROCEDURE COMP3000_STong.check_archive_task(IN taskID INT)
	BEGIN
		SELECT * FROM COMP3000_STong.archive_task
		WHERE archive_task.task_id = taskID;
	END //
DELIMITER