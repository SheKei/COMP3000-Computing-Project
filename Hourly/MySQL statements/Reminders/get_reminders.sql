DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_reminders(IN username VARCHAR(20))
	BEGIN
	
	SELECT
	reminder_id,
	description
	FROM COMP3000_STong.reminder
	WHERE reminder.user_id = username;
	
	END	//
	
DELIMITER ;
	