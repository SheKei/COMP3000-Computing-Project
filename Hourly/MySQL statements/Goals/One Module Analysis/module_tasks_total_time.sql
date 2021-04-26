DELIMITER //

CREATE PROCEDURE COMP3000_STong.get_module_tasks_overall_hours(IN moduleCode VARCHAR(50), IN username VARCHAR(20))
	BEGIN
		SELECT
			SEC_TO_TIME(SUM(TIME_TO_SEC(time_log.duration))) AS total_task_time
		FROM
			COMP3000_STong.module,
			COMP3000_STong.task,
			COMP3000_STong.time_log
		WHERE
			module.module_code = moduleCode
			AND
			module.module_code = task.module_code
			AND
			task.task_id = time_log.task_id
            AND
			module.user_id = username;
	END //
DELIMITER