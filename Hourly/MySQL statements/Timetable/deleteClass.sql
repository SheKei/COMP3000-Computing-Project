DELIMITER //
CREATE PROCEDURE COMP3000_STong.delete_class(IN classId INT)
	BEGIN
		INSERT INTO COMP3000_STong.archive_class
		SELECT * FROM COMP3000_STong.class
		WHERE class.class_id = classId;
		DELETE FROM 
		COMP3000_STong.class
		WHERE
		class_id = classId;
	END //
DELIMITER