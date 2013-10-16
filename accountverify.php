<?php
$page_name = 'TPS Verify Account';
	include_once 'pages/header.php';
	include_once 'pages/slideshow.php';
	include_once 'pages/iecompat.php';
    include_once "pages/tpsusers.php";

    if (isset($_POST['v']) and isset($_POST['e']))
	{
        $users = new TPSUsers();
        echo $users->verifyAccount($_POST['v'], $_POST['e']);
	}
	elseif (isset($_POST['v']))
	{
		if (isset($_POST['p']) and isset($_POST['r']))
		{
			$users = new TPSUsers();
			$users->updatePassword($_POST['p'], $_POST['r'], $_POST['v']);
		}
	}
/*
    if (isset($ret[0])):
        echo isset($ret[1]) ? $ret[1] : NULL;

        if ($ret[0]<3):
*/
?>
    <div class="section1">
    <div class="sectionrule"></div>

  
   <div class="intro">
        <h2>Choose a Password</h2>

        <form method="post" action="accountverify.php">
            <div>
                <label for="p">Choose a Password:</label>
                <input type="password" name="p" id="p" class="biginput"/><br />
                <label for="r">Re-Type Password:</label>
                <input type="password" name="r" id="r" class="biginput"/><br />
                <input type="hidden" name="v" value="<?php echo $_GET['v'] ?>" />
                <input type="submit" name="verify" id="verify" value="Verify Your Account" />
            </div>
        </form>
	</div>
	</div>

<?php
/*
        endif;
    else:
        echo '<meta http-equiv="refresh" content="0;/">';
    endif;
*/
	include_once 'pages/footer.php';
?>
