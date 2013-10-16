<?php
	include_once 'database.php';
	include_once 'globals.php';
	include_once 'debug.php';

/**
 * Handles navigation within the application
 *
 * PHP version 5
 *
 * @author Shaheed Abdol
 * @copyright 2013 Shaheed Abdol
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 */
class TPSNavigation
{
	private $_db;
	public $_navopen = "<div class=\"usernavdiv\">";
	public $_listopen = "<ul id=\"nav\" class=\"dropdownlist\">";
	public $_listclose = "</ul>";
	public $_navclose = "</div>";

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
    }
	
	public function renderNavButtons()
	{
		$_u = $_SESSION['UserName'];
		$_l = $_SESSION['LoggedIn'];
		
		if ($_l == 1)	//someone is logged in.
		{
			$nav = "
			$this->_navopen
			$this->_listopen
			
			<li><a href=\"#\" class=\"dropdown\">Projects +</a></li>
				<li class=\"sublinks\">
					<span><a href=\"tps_overview.php\">All Projects</a></span>
					<span><a href=\"tps_mypending.php\">Pending Projects</a></span>
					<span><a href=\"tps_mycurrent.php\">My Projects</a></span>
				</li>
			
			$this->_listclose
			$this->_listopen

			<li><a href=\"#\" class=\"dropdown\">Manage +</a></li>
				<li class=\"sublinks\">
					<span><a href=\"tps_myprofile.php\">Edit Profile</a></span>
					<span><a href=\"tps_addproject.php\">Add Project</a></span>
					<span><a href=\"tps_editproject.php\">Edit Project</a></span>
				</li>
			<li><a href=\"#\" class=\"dropdown\">TPS Help +</a></li>
			<li class=\"sublinks\">
					<span><a href=\"tps_faq.php\">F.A.Q.</a></span>
					<span><a href=\"tps_projhelp.php\">Projects Help</a></span>
					<span><a href=\"tps_profhelp.php\">Profile Help</a></span>
					<span><a href=\"tps_mailhelp.php\">Email Help</a></span>
					<span><a href=\"tps_mischelp.php\">Misc Help</a></span>
				</li>
			<li><span><a href=\"pages/logout.php\">Logout $_u</a></span></li>

			$this->_listclose
			$this->_navclose
			";
			echo $nav;
		}
	}
	
}