DELIMITER //
CREATE PROCEDURE COMP3000_STong.check_archive_reminder(IN reminderID INT)
	BEGIN
		SELECT * FROM COMP3000_STong.archive_reminder
		WHERE archive_reminder.reminder_id = reminderID;
	END //
DELIMITER