DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_task_time(IN taskId INT)
	BEGIN
		DELETE FROM COMP3000_STong.time_log
		WHERE
		task_id = taskId;
	END //
DELIMITER
	