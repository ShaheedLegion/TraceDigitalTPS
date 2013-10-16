<?php
include_once 'globals.php';
include_once 'debug.php';

	// Check that all the relevant tables have been created.
	function checkTables($db)
	{
		$createusers_q = 'CREATE TABLE IF NOT EXISTS Users (UserID PRIMARY KEY, UserName VARCHAR(150) NOT NULL, UserEmail VARCHAR(100), Password VARCHAR(150), ver_code VARCHAR(150), verified TINYINT)';
		$_result = $db->query($createusers_q);
		if ($_result == false)
			print_debug("Creating users table:", $db->errorInfo());

		$createprojects_q = 'CREATE TABLE IF NOT EXISTS Projects (ProjectID PRIMARY KEY, Deleted BOOLEAN)';
		$_result = $db->query($createprojects_q);
		if ($_result == false)
			print_debug("Creating Projects table:", $db->errorInfo());

		$createprofile_q = 'CREATE TABLE IF NOT EXISTS UserProfiles (UserID PRIMARY KEY, ThemeChoice VARCHAR (150), UserEmail VARCHAR (150))';
		$_result = $db->query($createprofile_q);
		if ($_result == false)
			print_debug("Creating UserProfiles table:", $db->errorInfo());

		$createtypes_q = 'CREATE TABLE IF NOT EXISTS Types (ID PRIMARY KEY, TypeName VARCHAR (150))';
		$_result = $db->query($createtypes_q);
		if ($_result == false)
			print_debug("Creating Types table:", $db->errorInfo());

		$createphases_q = 'CREATE TABLE IF NOT EXISTS Phases (PhaseID PRIMARY KEY, TypeID INT, PhaseName VARCHAR (150))';
		$_result = $db->query($createphases_q);
		if ($_result == false)
			print_debug("Creating Phases table:", $db->errorInfo());

		$createtimes_q = 'CREATE TABLE IF NOT EXISTS PhaseTimes (ID PRIMARY KEY, ProjectID INT, PhaseID INT, StartTime DATETIME, StopTime DATETIME, Notes VARCHAR (400))';
		$_result = $db->query($createtimes_q);
		if ($_result == false)
			print_debug("Creating PhaseTimes table:", $db->errorInfo());

		$createsession_q = 'CREATE TABLE IF NOT EXISTS Sessions (ID PRIMARY KEY, SessionID INT, SessionIdentifier VARCHAR (200))';
		$_result = $db->query($createsession_q);
		if ($_result == false)
			print_debug("Creating Sessions table:", $db->errorInfo());

		$createsessionusers_q = 'CREATE TABLE IF NOT EXISTS SessionUsers (ID PRIMARY KEY, SessionID INT, UserID VARCHAR (200), SessionStart DATETIME, SessionEnd DATETIME)';
		$_result = $db->query($createsessionusers_q);
		if ($_result == false)
			print_debug("Creating SessionUsers table:", $db->errorInfo());

		$createmessage_q = 'CREATE TABLE IF NOT EXISTS Messages (MessageID PRIMARY KEY, SessionID INT, SessionUserID INT, MessageText VARCHAR (400))';
		$_result = $db->query($createmessage_q);
		if ($_result == false)
			print_debug("Creating Messages table:", $db->errorInfo());

		$createusermessage_q = 'CREATE TABLE IF NOT EXISTS UserMessages (ID PRIMARY KEY, MessageID INT, ReceivedDate DATETIME, ReadDate DATETIME, IsRead BOOLEAN)';
		$_result = $db->query($createusermessage_q);
		if ($_result == false)
			print_debug("Creating UserMessages table:", $db->errorInfo());

		$createuserroles = 'CREATE TABLE IF NOT EXISTS UserRole (ID PRIMARY KEY, UserID INT, UserRoleID INT)';
		$_result = $db->query($createuserroles);
		if ($_result == false)
			print_debug("Creating UserRole table:", $db->errorInfo());

		$createroles = 'CREATE TABLE IF NOT EXISTS Roles (RoleID PRIMARY KEY, RoleName VARCHAR(100))';
		$_result = $db->query($createroles);
		if ($_result == false)
			print_debug("Creating Roles table:", $db->errorInfo());

		$createsysperms = 'CREATE TABLE IF NOT EXISTS SystemPermissions (ID PRIMARY KEY, PermissionID INT, PermissionName VARCHAR(200), PermissionParent INT, PermissionChild INT)';
		$_result = $db->query($createsysperms);
		if ($_result == false)
			print_debug("Creating SystemPermissions table:", $db->errorInfo());

		$createroleperms = 'CREATE TABLE IF NOT EXISTS RolePermissions (ID PRIMARY KEY, RoleID INT,PermissionID INT)';
		$_result = $db->query($createroleperms);
		if ($_result == false)
			print_debug("Creating RolePermissions table:", $db->errorInfo());
	}

	//Ideally, this function is only called once at the beginning of a session
	function connectDatabase()
	{
		// Set the error reporting level
		error_reporting(E_ALL);
		ini_set("display_errors", 1);

		try
		{
			if (DB_TYPE == 'sqlite')
			{
				$db = new PDO("sqlite:".DB_NAME);
				checkTables($db);
				return $db;
			}
			else
			{
				$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
				$db = new PDO($dsn, DB_USER, DB_PASS);
				checkTables($db);
				return $db;
			}
		}
		catch (PDOException $e)
		{
			print_debug("Connection failed to ".DB_TYPE.": ".$e->getMessage());
			return NULL;
		}
	}
	
	function getNextID($base, $table, $column)
	{
		//get the highest id, insert that + 1
		$row = $base->query("SELECT MAX($column) AS theCount FROM $table")->fetch();
		$id = $row['theCount'];
		
		if ($id == NULL)
			$id = 0;
		$id++;	//increment ID so that we have a new record ID to insert.
		return $id;
	}
?>