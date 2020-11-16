DELIMITER //

CREATE PROCEDURE COMP3000_STong.add_module(IN username VARCHAR(20), IN moduleCode VARCHAR(50), IN moduleName VARCHAR(50), IN colour VARCHAR(18), IN expHours INT(3) )
	BEGIN
	
	INSERT INTO COMP3000_STong.module(user_id, module_code, module_name, colour_key, expected_hours)
	VALUES(username, moduleCode, moduleName, colour, expHours);
	
	END	//
	
DELIMITER ;
	