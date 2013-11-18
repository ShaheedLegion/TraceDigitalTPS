<?php
$page_name = 'TPS Add Fields';
	session_start();	//start the session, whether the user logged in or not.

	include_once "pages/header.php";
	include_once "pages/slideshow.php";
	include_once "pages/iecompat.php";
    include_once "pages/tpsusers.php";
	include_once "pages/navigation.php";
	include_once "pages/projects.php";
	include_once "pages/clients.php";

	$projects = new TPSProjects();
	$navigation = new TPSNavigation();
	if (!empty($_POST['field_name']))
	{
		#Adds project type to db, automatically increments the Type ID.
		$projects->addProjectType($_POST['field_name']);
		$navigation->renderNavButtons();
	}
	else
	{
		$clients = new TPSClients();
		$users = new TPSUsers();

		if ($users->checkLogin())
		{
			$navigation->renderNavButtons();
		}
		else
		{
			$users->displayLoginLink();
		}
	}
?>

<!--
Here we add the code which will allow the user to add a project to the database...
This obviously depends on the type of user ... which we will have to deal with at some point.
-->

<div class="content">
  <div class="sectionrule"></div>
  <div class="board">
    <div class="">
    <hr/>
    <h2 class="centered">Please fill in project Field Details</h2>

	<h4 class="centered">Current Fields</h4>
	<?php
		$projects->displayTypes();
	?>

	<div class="formdiv" id="registerdiv">
	<form action="tps_addfields.php" method="POST" id="add_field"> 
		<div id="formfields">
		<h3 class="bm0">Field Name:</h3>
		<input type="text" length="35" name="field_name" id="field_name" />
		<input type="submit" id="field_submit" value="Add Field" class="button" />
		</div>
	</form>
	</div>

    </div>
  </div>
</div>

<?php
include_once 'pages/footer.php';
?>