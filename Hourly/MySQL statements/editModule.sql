DELIMITER //

CREATE PROCEDURE COMP3000_STong.edit_module(IN username VARCHAR(20), IN moduleCode VARCHAR(50), IN moduleName VARCHAR(50), IN colour VARCHAR(18), IN expectedHours INT(3), IN currentModule VARCHAR(50))
	BEGIN
		UPDATE COMP3000_STong.module
			SET
			module_code = moduleCode,
			module_name = moduleName,
			colour_key = colour,
			expected_hours = expectedHours
			
			WHERE
			
			user_id = username
			AND 
			module_code = currentModule
			
	END //
DELIMITER 
		