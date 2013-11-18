<?php
	include_once 'database.php';
	include_once 'globals.php';
	include_once 'debug.php';
	include_once 'clients.php';

/**
 * Handles display/edit of projects.
 *
 * PHP version 5
 *
 * @author Shaheed Abdol
 * @copyright 2013 Shaheed Abdol
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 */
class TPSProjects
{
	private $_db;
	private $_clients;
	public $_navopen = "<div class=\"section1\"><div class=\"sectionrule\"></div><div class=\"intro\">";
	public $_listopen = "<table class=\"projects\"><ul id=\"navo\" class=\"bigitem\">";
	public $_listclose = "</ul></table>";
	public $_navclose = "</div></div><hr/>";

	public function __construct($db=NULL)
    {
        if (is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $this->_db = connectDatabase();
        }
		$this->_clients = new TPSUsers();
    }

/********************
	The following interface deals with displaying data in HTML pages.
*********************/
	public function formatProjectData($name, $isbn, $spent, $left, $owner)
	{
		$value = 
		"
		<tr><td><li class=\"project\">
			<img src=\"icondata/e-pub.png\">
			<!-- We will determine the type of project to set correct icon for it. -->
			<h4 class=\"projects\">Title: $name</h4>
			<h4 class=\"projects\">ISBN: $isbn</h4>
			<p>
				<span>Owner: $owner</span>
				<span>Status: Active</span>
				<span>Hours spent: $spent</span>
				<span>Hours left: $left</span>
			</p>
		</li></td></tr>
		";
		
		return $value;
	}

	public function displayAllProjects()
	{
		$navmain="
		$this->_navopen
		<h2>Overview of current projects</h2>
		$this->_listopen
		";
		//need to select all projects and display them here.
		//select projects etc...
		$navmid = 
		$this->formatProjectData('Project 1', '9786453125864', '22', '46', 'Shaheed')
		.$this->formatProjectData('Project 2', '9786453125864', '12', '26', 'Wouter')
		.$this->formatProjectData('Project 3', '9786453125864', '17', '31', 'Shaheed')
		.$this->formatProjectData('Project 4', '9786453125864', '30', '10', 'Wouter')
		.$this->formatProjectData('Project 5', '9786453125864', '7', '33', 'Shaheed')
		.$this->formatProjectData('Project 6', '9786453125864', '9', '21', 'Wouter')
		.$this->formatProjectData('Project 7', '9786453125864', '1', '2', 'Wouter')
		.$this->formatProjectData('Project 8', '9786453125864', '31', '1', 'Shaheed')
		.$this->formatProjectData('Project 9', '9786453125864', '43', '12', 'Wouter')
		.$this->formatProjectData('Project 10', '9786453125864', '12', '22', 'Shaheed')
		.$this->formatProjectData('Project 11', '9786453125864', '17', '9', 'Shaheed')
		.$this->formatProjectData('Project 12', '9786453125864', '23', '40', 'Shaheed')
		.$this->formatProjectData('Project 13', '9786453125864', '6', '22', 'Wouter')
		.$this->formatProjectData('Project 14', '9786453125864', '18', '8', 'Wouter')
		.$this->formatProjectData('Project 15', '9786453125864', '28', '13', 'Shaheed')
		.$this->formatProjectData('Project 16', '9786453125864', '37', '31', 'Shaheed')
		.$this->formatProjectData('Project 17', '9786453125864', '1', '23', 'Shaheed')
		.$this->formatProjectData('Project 18', '9786453125864', '4', '17', 'Wouter')
		.$this->formatProjectData('Project 19', '9786453125864', '9', '12', 'Wouter')
		.$this->formatProjectData('Project 20', '9786453125864', '3', '46', 'Shaheed')
		.$this->formatProjectData('Project 21', '9786453125864', '43', '1', 'Wouter');
		
		$navend="
		$this->_listclose
		$this->_navclose
		";
		echo $navmain.$navmid.$navend;
	}
	
	public function displayPendingProjects()
	{
		$navmain="
		$this->_navopen
		<h2>My Pending projects</h2>
		$this->_listopen
		";

		$navmid = 
		$this->formatProjectData('Project 1', '9786453125864', '22', '46', 'Shaheed')
		.$this->formatProjectData('Project 3', '9786453125864', '17', '31', 'Shaheed')
		.$this->formatProjectData('Project 5', '9786453125864', '7', '33', 'Shaheed')
		.$this->formatProjectData('Project 8', '9786453125864', '31', '1', 'Shaheed')
		.$this->formatProjectData('Project 15', '9786453125864', '28', '13', 'Shaheed')
		.$this->formatProjectData('Project 16', '9786453125864', '37', '31', 'Shaheed')
		.$this->formatProjectData('Project 17', '9786453125864', '1', '23', 'Shaheed')
		.$this->formatProjectData('Project 20', '9786453125864', '3', '46', 'Shaheed');
		
		$navend="
		$this->_listclose
		$this->_navclose
		";
		echo $navmain.$navmid.$navend;
	}
	
	public function displayProjects()
	{
		$navmain="
		$this->_navopen
		<h2>All My projects</h2>
		$this->_listopen
		";

		$navmid = 
		$this->formatProjectData('Project 1', '9786453125864', '22', '46', 'Shaheed')
		.$this->formatProjectData('Project 3', '9786453125864', '17', '31', 'Shaheed')
		.$this->formatProjectData('Project 5', '9786453125864', '7', '33', 'Shaheed')
		.$this->formatProjectData('Project 8', '9786453125864', '31', '1', 'Shaheed')
		.$this->formatProjectData('Project 10', '9786453125864', '12', '22', 'Shaheed')
		.$this->formatProjectData('Project 11', '9786453125864', '17', '9', 'Shaheed')
		.$this->formatProjectData('Project 12', '9786453125864', '23', '40', 'Shaheed')
		.$this->formatProjectData('Project 15', '9786453125864', '28', '13', 'Shaheed')
		.$this->formatProjectData('Project 16', '9786453125864', '37', '31', 'Shaheed')
		.$this->formatProjectData('Project 17', '9786453125864', '1', '23', 'Shaheed')
		.$this->formatProjectData('Project 20', '9786453125864', '3', '46', 'Shaheed');
		
		$navend="
		$this->_listclose
		$this->_navclose
		";
		echo $navmain.$navmid.$navend;
	}

	function fetchTypeCount()
	{
		$query = "SELECT Count(ID) As theCount FROM Types";
		$row = $this->_db->query($query)->fetch();
		
		$count = $row['theCount'];
		return $count;
	}

	function fetchTypeSelection()
	{
		//<input type="text" id="projectname" name="projectname" class="biginput" />
		$query = "SELECT ID, TypeName FROM Types";
		$stmt = $this->_db->query($query);
		$rowset = $stmt->fetchall();

		$options = '';
		
		foreach ($rowset as $column)
		{
			$id = $column[0];
			$name = $column[1];
			$options .= "<option name=\"$name\" value=\"$id\" id=\"$id\" class=\"biginput\" >$name</option>";
		}
		$select = "<select class=\"biginput\" name=\"Project Type\" onchange=\"javascript:fetchFields();\" id=\"project_type\">
		$options
		</select>";
		
		return $select;

	}

	/*
	displays a field of the appropriate type based on the type of the Field in DB.
	*/
	public function formatField($fieldId)
	{
		//fetch field type from database, spit out form component...
		$fieldTypeName = $this->fetchFieldTypeName($fieldId);
		$result = "<span><h3>$fieldName</h3><input type=\"$fieldTypeName\" id=\"$fieldValue\"></input></span><br/>";
		return $result;
	}

	/*
	Fetches the editable form fields associated with each project.
	Fetch the fields associated with each project type
	Format the form fields based on the Field type.
	Return a partial HTML form containing the fields.
	*/
	function fetchProjectFields($typeid)
	{
		$query = "Select FieldID FROM ProjectTypeFields WHERE ProjectTypeID = $typeid";
		if ($stmt = $this->_db->query($query))
		{
			$rowset = $stmt->fetchall();
			$result = $this->_clients->fetchClientList();	//this is how we deal with compulsory/programmatic fields.
			foreach ($rowset as $value)
			{
				$result .= $this->formatField($value[0]);
			}
			return $result;
		}
		return '';
	}
/**********************
	The following interface is used to add projects to the database...
***********************/
	
	/*
	Add a Project to the database:
	Fetches the next available ProjectID, inserts into DB.
	Adds Fields, with empty values, to the DB.
	Updates Fields with values which the user has submitted.
	*/
	public function addProject()
	{
		/*
		The following field names/ids will have to be dynamically generated from the database
		We will select the fields to show for this project type
		Then generate the form
		Iterate through the result set, or select which fields to show - iterate through that result
		Update fields on a per-field basis
		*/
		$client = $_POST['projectclient'];
		$name = $_POST['projectname'];
		$isbn = $_POST['projectisbn'];
		$pages = $_POST['projectpages'];
		$comp = $_POST['projectcomplexity'];
		$dued = $_POST['projectdue'];
		
		//perform query here to add project name to db ... or to add project ID to db... one of the two lol!
		$projecttype = $_POST['projecttype'];
		$projectid = $this->addProjectID($projecttype);	//fetch a new ID for this project.

		foreach ($_POST as $key => $value)
		{ 
			if (strpos( 'project', $key ))
			{ 
				echo "$key: $value 
				\n"; 
				$this->updateFieldValue($projectid, $key, $value);
			} 
		} 
	}
	
	/*
	Add a new Project Type to the Database. Automatically assigns the next available ID
	to the new field type. Does not check for duplicates.
	*/
	public function addProjectType($fieldName)
	{
		$id = getNextID($this->_db, 'Types', 'ID');
		
		$query = "INSERT INTO Types (ID, TypeName) VALUES ($id, '$fieldName')";
		if ($this->_db->query($query) == false)
		{
			echo "Could not add Type to Database at this time.";	//signal an error to the caller.
			return;
		}
	}
	
	public function displayTypes()
	{
		if ($this->fetchTypeCount() == 0)
		{
			echo "No Types have been configured.";
			return;
		}

		$query = "SELECT TypeName FROM Types";
		$stmt = $this->_db->query($query);
		$rowset = $stmt->fetchall();

		$result = "<ul class=\"typelist\">";
		$list = "";
		
		foreach ($rowset as $column)
		{
			$value = $column[0];
			$list .= "<li> $value </li>";
		}
		$result .= "$list</ul>";
		echo $result;
	}

	/*
	Add a project ID to the database. This function does a little bit more and associates the fields of this project,
	based on project type, with the current project. So if projects of this type should have an 'xyz' field, then this function will associate that field with this project - and add a blank value.
	
	returns:
	-1  failure to add project ID
	-2  failure to fetch Fields to associate with this project.
	ProjectID upon partial success.
	*/
	public function addProjectID($projecttype)
	{
		$id = getNextID($this->_db, 'Projects', 'ProjectID');
		
		$query = "INSERT INTO Projects (ProjectID, Deleted) VALUES ($id, 0)";
		if ($this->_db->query($query) == false)
			return -1;	//signal an error to the caller.

		//Next we select the ProjectType field IDs and add those to the FieldValues table
		$rowset = $this->_db->query("SELECT FieldID FROM ProjectTypeFields WHERE ProjectTypeID = $projecttype")->fetch();
		if ($this->db->query($query) == false)
			return -2;	//signal an error to the caller.
		
		//now insert fields into ProjectTypeFields
		foreach ($rowset as $key => $value)
		{
			if ($this->addFieldValue($id, $value, '') == false)
			{
				//could log if something went wrong.
				//This will definitely cause problems later down the line since we will
				//be updating these fields further down the line.
			}
		}
		return $id;
	}

	/*
	Fetch the ID of an existing field, based on the name of the field.
	Which means that Field names must be unique across the system.
	Fields can be shared between projects (used by all project types), but never duplicated.
	
	returns the ID of the field, or -1 on failure [eg. FieldName is invalid]
	*/
	public function fetchFieldID($fieldName)
	{
		$query = "SELECT FieldID AS theID FROM Fields WHERE FieldName = '$fieldName'";
		$row = $this->_db->query($query)->fetch();
		
		$id = $row['theID'];
		if ($id == NULL)
			return -1;

		return $id;
	}

	/*
	Fetch the Type of the field from the DB based on the Field ID.
	returns:
	-1 on failure
	FieldType name on success
	*/
	public function fetchFieldTypeName($fieldID)
	{
		$query = "SELECT FieldType AS theID FROM Fields WHERE FieldID = '$fieldID'";
		$row = $this->_db->query($query)->fetch();
		
		$id = $row['theID'];
		if ($id == NULL)
			return -1;

		return $id;
	}
	/*
	Inserts a field ID into the FieldValues table with the given projectID as the key.
	This is done automatically when we add a new project to the system, making field selection
	automatic based on the type of project.
	
	returns true/false.
	*/
	public function addFieldValue($projectid, $fieldID, $fieldValue)
	{
		if ($fieldID != -1)
		{	//make sure the ProjectFields are added to FieldValues when the ProjectID is fetched
			$id = getNextID($this->_db, 'FieldValues', 'ID');
			$query = "INSERT INTO FieldValues ($id, ProjectID, FieldID, FieldValue) VALUES ($projectid, $fieldID, '$fieldValue')";
			return $this->_db->query($query);	//return the result of the query (true/false)
		}
		return false;
	}

	/*
	Updates the value of a project field which exists in the database. Performs lookup of FieldID based on the FieldName, so preserving the case is important.
	
	returns:
	result of query [true/false]
	false is FieldID cannot be found in the database.
	*/
	public function updateFieldValue($projectid, $fieldName, $fieldValue)
	{
		$fieldID = $this->fetchFieldID($fieldName);
		if ($fieldID == -1)
		{
			//Log that something went wrong ... error report or error DIV.
			return false;
		}

		//make sure the ProjectFields are added to FieldValues when the ProjectID is fetched
		$query = "UPDATE FieldValues SET FieldValue = '$fieldValue' WHERE ProjectID = $projectid AND FieldID = $fieldID";
		return $this->_db->query($query);	//return the result of the query (true/false if id is not found)
	}
}