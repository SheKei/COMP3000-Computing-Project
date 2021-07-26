DELIMITER //

CREATE PROCEDURE COMP3000_STong.edit_reminder(IN reminderID INT,IN theDesc VARCHAR(150), IN theDatestamp DATE)
	BEGIN
		UPDATE COMP3000_STong.reminder
			SET
			description = theDesc,
			datestamp = theDatestamp
			
			WHERE
			
			reminder_id = reminderID;
			
	END //
DELIMITER 
		