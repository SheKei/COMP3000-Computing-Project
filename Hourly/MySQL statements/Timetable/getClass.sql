DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_class(IN classId INT)
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
	COMP3000_STong.class.class_id = classId
	AND
	COMP3000_STong.class.module_code = COMP3000_STong.module.module_code;
	
	END //
	
DELIMITER ;