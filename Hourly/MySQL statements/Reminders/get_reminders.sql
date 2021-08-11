DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_reminders(IN username VARCHAR(20))
	BEGIN
	
	SELECT
	reminder_id,
	description,
	datestamp
	FROM COMP3000_STong.reminder
	WHERE reminder.user_id = username
	ORDER BY datestamp DESC;
	
	END	//
	
DELIMITER ;
	