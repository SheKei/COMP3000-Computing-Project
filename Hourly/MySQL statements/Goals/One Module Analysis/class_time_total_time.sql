DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_class_time_overall_hours(IN moduleCode VARCHAR(50), IN username VARCHAR(20))
	BEGIN
		SELECT
			SEC_TO_TIME(SUM(TIME_TO_SEC(class_duration * times_attended))) AS class_time
		FROM
			COMP3000_STong.class
		WHERE
			module_code = moduleCode
			AND
			class.user_id = username;
	END //
DELIMITER