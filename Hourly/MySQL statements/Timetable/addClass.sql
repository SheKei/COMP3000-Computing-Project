DELIMITER //

CREATE PROCEDURE COMP3000_STong.add_class(IN username VARCHAR(20), IN moduleCode VARCHAR(50), IN className VARCHAR(100), IN classRoom VARCHAR(20), IN classDay VARCHAR(8), IN startTime TIME, classDuration TIME)
	BEGIN
	
	INSERT INTO COMP3000_STong.class(user_id, module_code, class_name, class_room, class_day, start_time, class_duration)
	VALUES(username, moduleCode, className, classRoom, classDay, startTime, classDuration);
	
	END	//
	
DELIMITER ;