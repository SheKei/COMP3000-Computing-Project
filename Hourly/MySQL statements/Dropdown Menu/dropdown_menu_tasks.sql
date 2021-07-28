DELIMITER //
CREATE PROCEDURE COMP3000_STong.dropdown_menu_tasks(IN userID VARCHAR(20), IN moduleCode VARCHAR(50))
	BEGIN
	SELECT 
	module.module_code,
	task.task_id,
	task.task_name
	FROM
	COMP3000_STong.module,
	COMP3000_STong.task
	WHERE
    module.user_id = userID AND task.user_id = userID
    AND
	module.moduleCode = moduleCode AND task.module_code = moduleCode AND module.module_code = task.module_code
	AND
	task.task_status = "Ongoing";
END //
DELIMITER