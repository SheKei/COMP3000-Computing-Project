DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_task_time(IN taskId INT)
	BEGIN
		SELECT
			time_id,
			duration,
			description,
			time_stamp
		FROM
			COMP3000_STong.time_log
		WHERE
			task_id = taskId;
	END //
DELIMITER