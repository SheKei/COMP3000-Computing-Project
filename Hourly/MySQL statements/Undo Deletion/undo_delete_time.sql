DELIMITER //
CREATE PROCEDURE COMP3000_STong.undo_delete_time(IN timeID INT)
	BEGIN
		INSERT INTO COMP3000_STong.time_log
		SELECT * FROM COMP3000_STong.archive_time_log
		WHERE archive_time.time_id = timeID;
		DELETE FROM 
		COMP3000_STong.archive_time_log
		WHERE
		archive_time.time_id = reminderID;
	END //
DELIMITER