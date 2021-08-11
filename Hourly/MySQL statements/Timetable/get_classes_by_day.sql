DELIMITER //
CREATE PROCEDURE COMP3000_STong.get_classes_by_day(IN userID VARCHAR(20))
	BEGIN
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
		class.user_id = userID
        AND
        module.user_id = userID
        AND 
        module.module_code = class.module_code
		ORDER BY class_day, start_time;
	END //
DELIMITER