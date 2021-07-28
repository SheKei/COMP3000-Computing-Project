DELIMITER //
CREATE PROCEDURE COMP3000_STong.undo_delete_reminder(IN reminderID INT)
	BEGIN
		INSERT INTO COMP3000_STong.reminder
		SELECT * FROM COMP3000_STong.reminder
		WHERE archive_reminder.reminder_id = reminderID;
		DELETE FROM 
		COMP3000_STong.archive_reminder
		WHERE
		archive_reminder.reminder_id = reminderID;
	END //
DELIMITER