DELIMITER //

CREATE PROCEDURE COMP3000_STong.update_daily_goal(IN username VARCHAR(20), IN newGoal INT)
	BEGIN
		UPDATE COMP3000_STong.user
			SET
			daily_hours = newGoal
			WHERE
			user_id = username
			
	END //
DELIMITER 
		