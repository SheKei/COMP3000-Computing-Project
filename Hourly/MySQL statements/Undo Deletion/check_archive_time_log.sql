DELIMITER //
CREATE PROCEDURE COMP3000_STong.check_archive_class(IN taskID INT)
	BEGIN
		SELECT * FROM COMP3000_STong.archive_time_log
		WHERE archive_time_log.class_id = taskID;
	END //
DELIMITER