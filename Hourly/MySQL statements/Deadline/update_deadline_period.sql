DELIMITER //

CREATE PROCEDURE COMP3000_STong.update_deadline_period(IN username VARCHAR(20), IN deadlinePeriod INT)
	BEGIN
		UPDATE COMP3000_STong.user
			SET
			deadline_period = deadlinePeriod;
			WHERE
			user_id = username;
	END //
	
DELIMITER