DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_upcoming_class(IN userId VARCHAR(20))
	BEGIN
	
	SELECT
    class.module_code,
	module.module_name,
	class_id,
	class_name,
	class_room,
	class_day,
	start_time,
	class_duration
	FROM
	COMP3000_STong.class,
	COMP3000_STong.module
	WHERE
	COMP3000_STong.class.user_id = userId
	AND
	COMP3000_STong.class.module_code = COMP3000_STong.module.module_code
	AND 
	class.class_day = WEEKDAY(CURDATE())
	ORDER BY
	class.class_day,
	class.start_time;
	
	END //
	
DELIMITER ;