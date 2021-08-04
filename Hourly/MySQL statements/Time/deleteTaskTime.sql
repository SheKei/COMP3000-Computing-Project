DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_task_time(IN timeId INT)
	BEGIN
		DELETE FROM COMP3000_STong.time_log
		WHERE
		time_id = timeId;
	END //
DELIMITER
	