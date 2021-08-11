DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_archive_task(IN taskID INT)
	BEGIN
		DELETE FROM 
		COMP3000_STong.archive_task
		WHERE
		archive_task.task_id = taskID;
	END //
DELIMITER