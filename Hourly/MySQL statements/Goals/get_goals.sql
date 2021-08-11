DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_goals(IN username VARCHAR(20))
	BEGIN
		SELECT
		weekly_hours,
		daily_hours
		FROM
		COMP3000_STong.user
		WHERE
		user_id = username;
	END //
	
DELIMITER