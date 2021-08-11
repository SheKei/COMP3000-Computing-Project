DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_overall_task_weekly_hours(IN username VARCHAR(20))
	BEGIN
		SELECT
            SEC_TO_TIME(SUM(TIME_TO_SEC(time_log.duration))) AS total_task_time
		FROM
			COMP3000_STong.time_log
		WHERE
        	WEEK(time_log.time_stamp) = WEEK(CURRENT_TIMESTAMP)
			AND
			time_log.user_id = username;
	END //
DELIMITER