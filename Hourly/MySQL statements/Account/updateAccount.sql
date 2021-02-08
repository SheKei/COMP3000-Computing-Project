DELIMITER //

CREATE PROCEDURE COMP3000_STong.update_account(IN username VARCHAR(20), IN emailAddress VARCHAR(100), IN birthDate DATE)
	BEGIN
		UPDATE COMP3000_STong.user
			SET
			email = emailAddress,
			birth_date = birthDate
		
		WHERE
			user_id = username;
	END //
DELIMITER