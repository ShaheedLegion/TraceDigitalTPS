<?php
$page_name = 'TPS Login';
	session_start();	//start the session, whether the user logged in or not.

	include_once "pages/header.php";
	include_once "pages/slideshow.php";
	include_once "pages/iecompat.php";
    include_once "pages/tpsusers.php";
	include_once "pages/navigation.php";

    if (!empty($_POST['username']) and !empty($_POST['password']))
	{
        $users = new TPSUsers();
        if ($users->loginAccount($_POST['username'], $_POST['password']))
		{
			$navigation = new TPSNavigation();
			$navigation->renderNavButtons();
		}
	}
	else if(!empty($_POST['forgotusername']) or !empty($_POST['forgotemail']))
	{
        $users = new TPSUsers();
        echo $users->forgotAccount();
	}
	if (!empty($_POST['registername']))
	{
        $users = new TPSUsers();
        echo $users->createAccount();
	}
?>

<!--
<div class="section1">
<div class="sectionrule"></div>

    <div class="board">
    </div>
</div>
-->

    <div class="content">
    <div class="sectionrule"></div>

  
   <div class="intro">
   <h1>Welcome to the Trace Production System</h1>   
    <p>In 2013 Trace Digital Services discovered that there was a better way to manage digital production ... that it was easier than having mountains of paperwork and constantly missed deadlines. Trace Digital Services discovered that with a little bit of elbow grease and a lot of magic, it was possible to eliminate the hassle and get on with the business of producing stunning digital content. In short, they discovered the power of a production management system. Written by their sole programmer <a href="traceteam.php#shaheed">Shaheed Abdol</a> - the system eliminates the gruntwork of managing a dynamic production cycle, and gives users a clear path to efficiency.<br/>

	The Trace Production System is entirely online and collaborative, which allows users to share information and resources from anywhere on the planet.<br/>
We think you will enjoy using the system as much as we have enjoyed building and refining it. Take a moment to register, or sign in with your credentials
      </p>
    </div>
    </div><!--content-->


<div class="section1">
  <div class="sectionrule"></div>
    <div class="intro">
    <h2 class="centered">Sign In to continue to the TPS</h2>

	<div class="formdiv">
	<form action="tps_login.php" method="POST" id="login"> 
	   <div>
		 <span><h3>UserName:</h3><input type="text" id="username" name="username" class="biginput" /></span><br/>
		 <span><h3>Password:</h3><input type="password" id="password" name="password" class="biginput" /></span><br/>
		 <input type="submit" id="loginsubmit" value="Login" class="button" /><br/><br/>
		 <a href="javascript:shownode('forgotten');" class="button">Forgot Password</a>
	   </div>
	</form>
	
	<div class="hiddenformdiv" id="forgotten">
	<form action="tps_login.php" method="POST" id="login"> 
	   <div>
		 <span><h3>Email Address:</h3><input type="text" id="forgotemail" name="forgotemail" class="biginput" /></span><br/>
		 <span><h3>Or UserName:</h3><input type="text" id="forgotusername" name="forgotusername" class="biginput" /></span><br/>
		 <input type="submit" id="forgotsubmit" value="Continue" class="button" />
	   </div>
	</form>
	</div>

	</div>

  </div>
</div>

<div class="content">
  <div class="sectionrule"></div>
  <div class="board">
    <div class="">
    <hr/>
    <h2 class="centered">Or take a moment to register</h2>

	<div class="formdiv" id="registerdiv">
	<form action="tps_login.php" method="POST" id="register"> 
	   <div>
		 <span><h3>Name:</h3><input type="text" id="registername" name="registername" class="biginput" /></span><br/>
		 <span><h3>Email Address:</h3><input type="text" id="registeremail" name="registeremail" class="biginput" /></span><br/>
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