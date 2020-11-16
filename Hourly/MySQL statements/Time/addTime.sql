DELIMITER //

CREATE PROCEDURE COMP3000_STong.add_time(IN taskId INT,IN theDuration TIME,IN theDescription VARCHAR(150), IN theTimeStamp DATE)
	BEGIN
		INSERT INTO COMP3000_STong.time_log(task_id, duration, description, time_stamp)
		VALUES(taskId, theDuration, theDescription, theTimeStamp);
		
	END //
	
DELIMITER	