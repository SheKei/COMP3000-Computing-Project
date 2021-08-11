DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_today_class_hours(IN username VARCHAR(20))
	BEGIN
		SELECT
			SEC_TO_TIME(SUM(TIME_TO_SEC(class_duration))) AS total_class_time
		FROM
			COMP3000_STong.class
		WHERE
			class.last_attendance = CURDATE()
			AND
			class.user_id = username;
	END //
DELIMITER