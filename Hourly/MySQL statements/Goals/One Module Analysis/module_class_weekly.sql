DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_module_class_weekly_hours(IN moduleCode VARCHAR(50), IN username VARCHAR(20))
	BEGIN
		SELECT
			SEC_TO_TIME(SUM(TIME_TO_SEC(class_duration))) AS total_class_time
		FROM
			COMP3000_STong.class
		WHERE
			WEEK(class.last_attendance) = WEEK(CURRENT_TIMESTAMP)
			AND
			class.user_id = username
			AND
			class.module_code = moduleCode;
	END //
DELIMITER