<?php


class Database
{
    private $username = 'COMP3000_STong';
    private $password = 'SmjU850*';
    private $database = 'COMP3000_STong';
    private $db_server = 'proj-mysql.uopnet.plymouth.ac.uk';
    private $dataSourceName;
    private $connection;
    private $procedure = "CALL COMP3000_STong.";

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        try {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->database . ';host=' . $this->db_server;
                $this->connection = new PDO($this->dataSourceName, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }catch (PDOException $err)
        {
            echo 'Connection failed: ', $err->getMessage();
        }
    }

    //Execute procedures with SELECT statements
    public function executeStatement($sqlStatement)
    {
        $sqlStatement = $this->connection->prepare($sqlStatement);
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    //Execute procedures with INSERT/DELETE/UPDATE statements
    public function executeStatementNoOutput($sqlStatement)
    {
        $sqlStatement = $this->connection->prepare($sqlStatement);
        $sqlStatement->execute();
    }

    //Create a module
    public function addModule($user, $module_code, $module_name, $colour_key, $expected_hours)
    {
        $sql = $this->procedure."add_module('".$user."','".$module_code."','".$module_name."','".$colour_key."',".$expected_hours.")";
        $this->executeStatementNoOutput($sql);
    }

    //Return all modules user has made
    public function getModuleCodes($user){
        $sql = $this->procedure."get_modules('".$user."')";
        return $this->executeStatement($sql);
    }

    //Return all details for one module
    public function getModuleDetails($user, $module_code){
        $sql = $this->procedure."view_module('".$user."','".$module_code."')";
        return $this->executeStatement($sql);
    }

    //Edit Module
    public function editModuleDetails($user, $moduleCode, $moduleName, $colour, $expectedHours, $currentCode){
        $sql = $this->procedure."edit_module('".$user."','".$moduleCode."','".$moduleName."','".$colour."',".$expectedHours.",'".$currentCode."')";
        $this->executeStatementNoOutput($sql);
    }

    //Delete Module
    public function deleteModule($user, $moduleCode){
        $sql = $this->procedure."delete_module('".$user."','".$moduleCode."')";
        $this->executeStatementNoOutput($sql);
    }

    //Assign a task to a module
    public function assignTask($module_code, $user, $task_name, $task_category, $due_date, $due_time, $priority_level)
    {
        $sql = $this->procedure."add_task('".$user."','".$module_code."','".$task_name."','".$task_category."','".$due_date."','".$due_time."','".$priority_level."')";
        $this->executeStatementNoOutput($sql);
    }

    //Edit ongoing task details
    public function editTask($taskId, $moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel){
        $sql = $this->procedure."edit_task('".$taskId."','".$moduleCode."','".$taskName."','".$taskCategory."','".$dueDate."','".$dueTime."','".$priorityLevel."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all ongoing tasks user has made for all modules
    public function getAllOngoingTasks($user){
        $sql = $this->procedure."get_tasks('".$user."')";
        return $this->executeStatement($sql);
    }

    //Get all modules that have tasks assigned to them
    public function getAllModulesWithTasks($user){
        $sql = $this->procedure."dropdown_menu_modules('".$user."')";
        return $this->executeStatement($sql);
    }

    //Get all tasks assigned to one module
    public function getAllModuleTasks($user, $moduleCode){
        $sql = $this->procedure."dropdown_menu_tasks('".$user."','".$moduleCode."')";
        return $this->executeStatement($sql);
    }

    //Insert time for a task
    public function addTime($user,$taskId, $theDuration, $theDescription, $theTimeStamp){
        $sql = $this->procedure."add_time(".$taskId.",'".$theDuration."','".$theDescription."','".$theTimeStamp."','".$user."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all ongoing tasks for one module
    public function getModuleOngoingTasks($user, $module)
    {
        $sql = $this->procedure."get_module_tasks('".$user."','".$module."','Ongoing')";
        return $this->executeStatement($sql);
    }

    //Get all completed tasks for one module
    public function getModuleCompletedTasks($user, $module){
        $sql = $this->procedure."get_module_tasks('".$user."','".$module."', 'Complete')";
        return $this->executeStatement($sql);
    }

    //Mark an ongoing task as complete
    public function completeTask($user, $taskId)
    {
        $sql = $this->procedure."complete_task('".$user."',".$taskId.")";
        $this->executeStatementNoOutput($sql);
    }

    //View further details of an individual task
    public function getTaskDetails($taskId){
        $sql = $this->procedure."get_task_details('".$taskId."')";
        return $this->executeStatement($sql);
    }

    //Get time spent on a selected task
    public function getTaskTime($taskId){
        $sql = $this->procedure."get_task_time(".$taskId.")";
        return $this->executeStatement($sql);
    }

    //Delete a time spent on a task
    public function deleteTime($timeId){
        $sql = $this->procedure."delete_task_time(".$timeId.")";
        $this->executeStatementNoOutput($sql);
    }

    //Delete a task and time spent on it
    public function deleteTask($taskId){
        $sql = $this->procedure."delete_task(".$taskId.")";
        $this->executeStatementNoOutput($this->procedure."delete_task(".$taskId.")");
    }

    //Add class to timetable
    public function addClass($user, $module, $className, $classRoom, $classDay, $startTime, $classDuration){
        $sql = $this->procedure."add_class('".$user."','".$module."','".$className."','".$classRoom."','".$classDay."','".$startTime."','".$classDuration."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all timetabled classes SORTED BY MODULES
    public function getTimetable($user){
        $sql = $this->procedure."get_all_classes('".$user."')";
        return $this->executeStatement($sql);
    }

    //Get all timetabled classes SORTED BY DAY
    public function getTimetableByDays($user){
        $sql = $this->procedure."get_classes_by_day('".$user."')";
        return $this->executeStatement($sql);
    }

    //Get details for a class
    public function getClass($classId){
        $sql = $this->procedure."get_class(".$classId.")";
        return $this->executeStatement($sql);
    }

    //Get today's classes
    public function getTodaysClasses($userId){
        $sql = $this->procedure."get_upcoming_class('".$userId."')";
        return $this->executeStatement($sql);
    }

    //Update class
    public function editClass($classId, $moduleCode, $className, $classRoom, $classDay, $startTime, $classDuration){
        $sql = $this->procedure."edit_class(".$classId.",'".$moduleCode."','".$className."','".$classRoom."','".$classDay."','".$startTime."','".$classDuration."')";
        $this->executeStatementNoOutput($sql);
    }

    //Delete class
    public function deleteClass($classId){
        $sql = $this->procedure."delete_class(".$classId.")";
        $this->executeStatementNoOutput($sql);
    }

    //Update class attendance
    public function updateAttendance($username, $classId){
        $sql = $this->procedure."update_attendance('".$username."',".$classId.")";
        $this->executeStatementNoOutput($sql);
    }

    //Get account details
    public function getAccountDetails($username){
        $sql = $this->procedure."get_account('".$username."')";
        return $this->executeStatement($sql);
    }

    //Update email and date of birth
    public function updateAccount($username, $email, $birthdate){
        $sql = $this->procedure."update_account('".$username."','".$email."','".$birthdate."')";
        $this->executeStatementNoOutput($sql);
    }

    //Create new account
    public function createAccount($username, $password, $email, $birthdate){
        $sql = $this->procedure."create_account('".$username."','".$password."','".$email."','".$birthdate."')";
        $this->executeStatementNoOutput($sql);
    }

    //Add a reminder
    public function addReminder($username, $description, $datestamp){
        $sql = $this->procedure."add_reminder('".$username."','".$description."','".$datestamp."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all reminders from one user
    public function getReminders($username){
        $sql = $this->procedure."get_reminders('".$username."')";
        return $this->executeStatement($sql);
    }

    //Delete reminder
    public function deleteReminder($id){
        $sql = $this->procedure."delete_reminder(".$id.")";
        $this->executeStatementNoOutput($sql);
    }

    //Update contents of existing reminder
    public function editReminder($id, $description, $datestamp){
        $sql = $this->procedure."edit_reminder(".$id.",'".$description."','".$datestamp."')";
        $this->executeStatementNoOutput($sql);
    }

    //Return a reminder using reminder id
    public function getOneReminder($reminderID){
        $sql = $this->procedure."get_reminder(".$reminderID.")";
        return $this->executeStatement($sql);
    }

    //PROCEDURES TO GET TIME CALCULATIONS FOR TIME SPENT ON MODULE/MODULES

    //The total hours spent on ONE module both class and tasks OVERALL
    public function overallModuleClassHours($moduleCode, $username){
        $sql = $this->procedure."get_class_time_overall_hours('".$moduleCode."','".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }
    public function overallModuleTaskHours($moduleCode, $username){
        $sql = $this->procedure."get_module_tasks_overall_hours('".$moduleCode."','".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }

    //The hours spent on ONE module in a WEEK
    public function weeklyModuleClassHours($moduleCode, $username){
        $sql = $this->procedure."get_module_class_weekly_hours('".$moduleCode."','".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }
    public function weeklyModuleTaskHours($moduleCode, $username){
        $sql = $this->procedure."get_module_task_weekly_hours('".$moduleCode."','".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }

    //The OVERALL weekly hours spent attending classes and tasks
    public function weeklyOverallModuleHours($username){
        $sql = $this->procedure."get_overall_task_weekly_hours('".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }
    public function weeklyOverallClassHours($username){
        $sql = $this->procedure."get_overall_class_weekly_hours('".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }

    //The hours spent working TODAY
    public function todayModuleHours($username){
        $sql = $this->procedure."get_today_class_hours('".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }
    public function todayClassHours($username){
        $sql = $this->procedure."get_today_task_hours('".$username."')";
        return $this->extractArray($this->executeStatement($sql));
    }

    //Extract the time result from array
    public function extractArray($result){
        $theTime = "00:00";
        if($result){
            foreach($result as $row){
                $theTime = $row['total_time'];
                if($theTime === null){
                    $theTime = "00:00"; //Set null value to 00:00
                }
            }
        }
        return $theTime;
    }

    //Get the current goal numbers set to achieve per week and day
    public function getGoals($username){
        $sql = $this->procedure."get_goals('".$username."')";
        return $this->executeStatement($sql);
    }


    //Update the goal number of hours to work in a day
    public function updateDailyGoal($username, $newGoal){
        $sql = $this->procedure."update_daily_goal('".$username."',".$newGoal.")";
        $this->executeStatementNoOutput($sql);
    }

    //Update the goal number of hours to work in a week
    public function updateWeeklyGoal($username, $newGoal){
        $sql = $this->procedure."update_weekly_goal('".$username."',".$newGoal.")";
        $this->executeStatementNoOutput($sql);
    }

    //Get the number of days when to alert tasks are due
    public function getDeadlinePeriod($username){
        $sql = $this->procedure.'get_deadline_period("'.$username.'")';
        return $this->executeStatement($sql);
    }

    //Update the timeframe to alert deadlines
    public function updateDeadlinePeriod($username, $newDeadlinePeriod){
        $sql = $this->procedure.'update_deadline_period("'.$username.'",'.$newDeadlinePeriod.')';
        $this->executeStatementNoOutput($sql);
    }

    //Get upcoming deadlines for the next seven days
    public function getDeadlines($username){
        $sql = $this->procedure."get_deadlines('".$username."')";
        return $this->executeStatement($sql);
    }

    //Delete all classes, tasks tied to a module and then module itself
    public function deleteEverythingInModule($moduleCode, $username){
        $this->getTimeLogIdsToDelete($username, $moduleCode);//Delete time logs first

        $sql = $this->procedure."delete_module_tasks('".$moduleCode."','".$username."')";//Delete tasks
        $this->executeStatementNoOutput($sql);

        $sql = $this->procedure."delete_module_classes('".$moduleCode."','".$username."')";//Delete classes
        $this->executeStatementNoOutput($sql);

        $sql = ($this->procedure."delete_module('".$username."','".$moduleCode."')");//Delete module itself
        $this->executeStatementNoOutput($sql);

    }

    //Delete the child records (time logs) of task table first
    public function getTimeLogIdsToDelete($user, $module){
        $sql = $this->procedure."get_time_log_ids('".$module."','".$user."')";
        $result = $this->executeStatement($sql);
        if($result){
            echo "if";
            foreach ($result as $row){
                $sql = $this->procedure."delete_task_time(".$row['time_id'].")"; //Delete time log
                $this->executeStatementNoOutput($sql);
            }
        }
    }

    //Check if archived deleted reminder still exists
    public function checkArchiveReminder($reminderID){
        if(empty($this->executeStatement($this->procedure."check_archive_reminder(".$reminderID.")"))==false){
            $this->undoDeleteReminder($reminderID); //If archived reminder exists, move back to reminder table
        }
    }

    //Undo deleting of a reminder
    public function undoDeleteReminder($reminderID){
        $this->executeStatementNoOutput($this->procedure."undo_delete_reminder(".$reminderID.")");
    }

    //Check if archived deleted reminder still exists
    public function checkArchiveClass($classID){
        if(empty($this->executeStatement($this->procedure."check_archive_class(".$classID.")"))==false){
            $this->undoDeleteClass($classID); //If archived reminder exists, move back to reminder table
        }
    }

    //Undo deleting of a reminder
    public function undoDeleteClass($classID){
        $this->executeStatementNoOutput($this->procedure."undo_delete_class(".$classID.")");
    }
}