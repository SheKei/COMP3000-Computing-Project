DELIMITER //

CREATE PROCEDURE COMP3000_STong.add_reminder(IN username VARCHAR(20), IN theDescription VARCHAR(150))
	BEGIN
	
	INSERT INTO COMP3000_STong.reminder(user_id, description)
	VALUES(username, theDescription);
	
	END	//
	
DELIMITER ;
	