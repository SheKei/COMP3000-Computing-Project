DELIMITER //
CREATE PROCEDURE COMP3000_STong.check_archive_class(IN classID INT)
	BEGIN
		SELECT * FROM COMP3000_STong.archive_class
		WHERE archive_class.class_id = classID;
	END //
DELIMITER