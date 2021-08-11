DELIMITER //
CREATE PROCEDURE COMP3000_STong.get_reminder(IN reminderID INT)
BEGIN
	SELECT
    reminder.reminder_id,
    reminder.description,
    reminder.datestamp
    FROM
    COMP3000_STong.reminder
    WHERE
    reminder.reminder_id = reminderID;
END//
DELIMITER ;