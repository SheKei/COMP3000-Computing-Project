DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_modules(IN username VARCHAR(20))
BEGIN
	
	SELECT
	module_code,
	module_name
	FROM
	COMP3000_STong.module
	WHERE
	user_id = username;

    
END//
DELIMITER ;