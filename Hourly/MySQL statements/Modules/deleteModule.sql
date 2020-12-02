DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_module(IN moduleCode VARCHAR(50))
	BEGIN
		DELETE FROM 
		COMP3000_STong.module
		WHERE
		module_code = moduleCode;
	END //
DELIMITER