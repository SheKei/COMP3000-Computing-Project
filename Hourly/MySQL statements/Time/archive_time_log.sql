DELIMITER //
CREATE PROCEDURE COMP3000_STong.archive_time_log(IN timeId INT)
	BEGIN
		INSERT INTO COMP3000_STong.archive_time_log
		SELECT * FROM COMP3000_STong.time_log
		WHERE time_log.time_id = timeId;
	END //
DELIMITER
	