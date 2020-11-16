DELIMITER //

CREATE PROCEDURE COMP3000_STong.view_module(IN username VARCHAR(20), IN moduleCode VARCHAR(50))
BEGIN
	
	SELECT
	module_code,
	module_name,
	colour_key,
	expected_hours
	FROM
	COMP3000_STong.module
	WHERE
	user_id = username
	AND
	module_code = moduleCode;

    
END//
DELIMITER ;