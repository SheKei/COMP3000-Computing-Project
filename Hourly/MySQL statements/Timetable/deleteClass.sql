DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_class(IN classId INT)
	BEGIN
		DELETE FROM 
		COMP3000_STong.class
		WHERE
		class_id = classId;
	END //
DELIMITER