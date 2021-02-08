DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_account(IN username VARCHAR(20))
	BEGIN
		SELECT
			user_id,
			password,
			email,
			birth_date,
			daily_goal,
			weekly_goal,
			weekly_hours,
			daily_hours,
			report_subscription
		FROM
			COMP3000_STong.user
		WHERE
			user_id = username;
	END //
DELIMITER