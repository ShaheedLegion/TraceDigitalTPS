<?php
$page_name = 'TPS Login';
	session_start();	//start the session, whether the user logged in or not.

	include_once "pages/header.php";
	include_once "pages/slideshow.php";
	include_once "pages/iecompat.php";
    include_once "pages/tpsusers.php";
	include_once "pages/navigation.php";
	include_once "tps_projects.php";
	include_once "tps_clients.php";

	$projects = new TPSProjects();
	if (!empty($_GET['project_type']))
	{
		echo $projects->fetchProjectFields($_GET['project_type']);
	}
	else if (!empty($_POST['projectname']))
	{
		#do something useful here... Not sure what the result will be when the project is added...
		#Perhaps we will print out a success message to the user.
		$projects->addProject();
	}
	else
	{
		$clients = new TPSClients();
		$users = new TPSUsers();

		if ($users->checkLogin())
		{
			$navigation = new TPSNavigation();
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
    <h2 class="centered">Please fill in project details</h2>

	<div class="formdiv" id="registerdiv">
	<form action="tps_addproject.php" method="POST" id="add_project"> 
		<div>
		<span>
			<h3>Project Type:</h3>
			<?php echo $clients->fetchTypeSelection(); ?>
		</span><br/>

<!--
		 <span>
			<h3>Client:</h3>
			< ?php $clients->fetchClientList(); ? >
		 </span><br/>
		 <span>
			<h3>Project Name:</h3>
			<input type="text" id="projectname" name="projectname" class="biginput" />
		 </span><br/>
		 <span>
			<h3>ISBN:</h3>
			<input type="text" id="projectisbn" name="projectisbn" class="biginput" />
		 </span><br/>
		 <span>
			<h3>Page Count:</h3>
			<input type="text" id="projectpages" name="projectpages" class="biginput" />
		 </span><br/>
		 <span>
			<h3>Complexity:</h3>
			<input type="text" id="projectcomplexity" name="projectcomplexity" class="biginput" />
		 </span><br/>
		 <span>
			<h3>Due Date:</h3>
			<input type="date" id="projectdue" name="projectdue" class="biginput" />
		 </span><br/>
-->
		<div id="formfields"></div>
		 <input type="submit" id="registersubmit" value="Register" class="button" />
	   </div>
	</form>
	</div>


    </div>
  </div>
</div>

<?php
include_once 'pages/footer.php';
?>