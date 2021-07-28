DELIMITER //
CREATE PROCEDURE COMP3000_STong.dropdown_menu_modules(IN userID VARCHAR(20))
	BEGIN
	SELECT 
	DISTINCT(module.module_code)
	FROM
	COMP3000_STong.module,
	COMP3000_STong.task
	WHERE
    module.user_id = userID
    AND
    task.user_id = userID
    AND
	module.module_code = task.module_code
	AND
	task.task_status = "Ongoing";
END //
DELIMITER