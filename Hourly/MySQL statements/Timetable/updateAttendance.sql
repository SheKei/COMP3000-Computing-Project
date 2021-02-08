DELIMITER //

CREATE PROCEDURE COMP3000_STong.update_attendance(IN username VARCHAR(20), IN classId INT)
	BEGIN
		UPDATE COMP3000_STong.class
			SET
			last_attendance = CURDATE(),
			times_attended = times_attended + 1
		
		WHERE
			user_id = username
			AND
			class_id = classId;
	
	END	//
	
DELIMITER ;
	