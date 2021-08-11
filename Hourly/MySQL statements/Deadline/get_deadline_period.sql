DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_deadline_period(IN username VARCHAR(20))
	BEGIN
		SELECT
		deadline_period
		FROM
		COMP3000_STong.user
		WHERE
		user_id = username;
	END //
	
DELIMITER