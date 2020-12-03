DELIMITER //

CREATE PROCEDURE COMP3000_STong.edit_class(IN classId INT, IN moduleCode VARCHAR(50), className VARCHAR(100), classRoom VARCHAR(20), classDay VARCHAR(8), startTime TIME, classDuration TIME)
	BEGIN
	
	UPDATE COMP3000_STong.class
	SET
    module_code = moduleCode,
	class_name = className,
	class_room = classRoom,
	class_day = classDay,
	start_time = startTime,
	class_duration = classDuration
	WHERE
	COMP3000_STong.class.class_id = classId;
	
	END //
	
DELIMITER ;