DELIMITER //

CREATE PROCEDURE COMP3000_STong.create_account(IN username VARCHAR(20), IN thePassword VARCHAR(300), IN theEmail VARCHAR(100), IN birthdate DATE)
	BEGIN
	
	INSERT INTO COMP3000_STong.user(user_id, password, email, birth_date)
	VALUES(username, thePassword, theEmail, birthdate);
	
	END	//
	
DELIMITER ;
	