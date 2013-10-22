<?php
$page_name = 'TPS Login';
	session_start();	//start the session, whether the user logged in or not.

	include_once "pages/header.php";
	include_once "pages/slideshow.php";
	include_once "pages/iecompat.php";
    include_once "pages/tpsusers.php";
	include_once "pages/navigation.php";
	include_once "tps_projects.php";

    $users = new TPSUsers();
	
    if ($users->checkLogin())
	{
		$navigation = new TPSNavigation();
		$navigation->renderNavButtons();
		
		$projects = new TPSProjects();
		$projects->displayPendingProjects();
	}
	else
	{
		$users->displayLoginLink();
	}
?>

<?php
include_once 'pages/footer.php';
?>