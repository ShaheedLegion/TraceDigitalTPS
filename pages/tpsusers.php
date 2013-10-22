<?php
	require_once('mailer/class.phpmailer.php');
	include_once 'database.php';
	include_once 'globals.php';
	include_once 'debug.php';

/**
 * Handles user interactions within the app
 *
 * PHP version 5
 *
 * @author Shaheed Abdol
 * @copyright 2013 Shaheed Abdol
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 */
class TPSUsers
{
	private $_db;
	public $_open = "<div class=\"section1\"><div class=\"sectionrule\"></div><div class=\"intro\">";
	public $_close = "</div></div>";

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

	public function sendVerificationEmail($uname, $umail, $ver)
	{
        $e = sha1($umail); // For verification purposes
        $to = trim($umail);
		$_website = WEBSITE;
		$_mailname = MAIL_NAME;
		$_mailpass = MAIL_PASS;

        $subject = "[TPS] Account Verification Email";

        $headers = <<<MESSAGE
From: Trace Production System <trace.production.system@gmail.com>
Content-Type: text/plain;
MESSAGE;

        $msg = <<<EMAIL
		You have created a new account at $_website!

		To get started, please activate your account and choose a password by following the link below.
	
		Your Username: $uname

		Activate your account: http://$_website/tps_accountverify.php?v=$ver&e=$e

		If you have any questions, please contact info@$_website.

		--
		Thanks!

		Trace Production System
		$_website
EMAIL;

		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->Username = $_mailname;
		$mail->Password = $_mailpass;
		$mail->SetFrom($_mailname);
		$mail->Subject = $subject;
		$mail->Body = $msg;
		$mail->AddAddress($to);
		if (!$mail->Send())
		{
			echo "Mailer Error: ".$mail->ErrorInfo;
			return false;
		}

		return true;
	}

	public function displayLoginLink()
	{
		echo $this->_open."<h2>Please Login to access this portion of the TPS</h2><p>go to the <a href=\"login.php\">Login Page</a> to gain access to this portion of the site".$this->_close;
	}

	public function checkLogin()
	{
		$_l = $_SESSION['LoggedIn'];
		
		if ($_l == 1)	//someone is logged in.
			return true;
		
		return false;	//nobody islogged in
	}

	public function verifyAccount($v, $e)
	{
		$_v = trim($v);	//original verification code
		$_e = trim($e);	//sha1 of user email
		$sql = "SELECT UserName FROM Users WHERE ver_code=':ver' AND SHA1(UserName)=':user' AND verified = 0";

        if ($stmt = $this->_db->prepare($sql))
        {
            $stmt->bindParam(':ver', $v, PDO::PARAM_STR);
            $stmt->bindParam(':user', $e, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if (isset($row['UserName']))
            {
                // Logs the user in if verification is successful
                $_SESSION['UserName'] = $row['UserName'];
                $_SESSION['LoggedIn'] = 1;
            }
            else
            {
                return array(4, $this->_open."<h2>Verification Error</h2>"
                    . "<p>This account has already been verified. "
                    . "Did you <a href=\"login.php\">forget "
                    . "your password?</a>".$this->_close);
            }
            $stmt->closeCursor();

            // No error message is required if verification is successful
            return array(0, NULL);
        }
        else
        {
            return array(2, $this->_open."<h2>Error</h2>"
			."<p>Database error.</p>".$this->_close);
        }
	}

	public function updatePassword($pwd, $cpwd, $ver)
	{
		if ($pwd == $cpwd)
		{
			$_p = trim($pwd);
			$_v = trim($ver);
			$_p5 = md5($_p);
			$sql = "UPDATE Users SET Password = '$_p5', verified = 1 WHERE ver_code='$_v'";

            try
            {
                if ($this->_db->query($sql))
				{
					echo $this->_open."<h2>Success - Password updated!</h2><p>Use the \"Sign In\" button above to log into your account.</p>".$this->_close;
					return TRUE;
				}
				else
				{
					$_err = $this->_db->errorInfo();
					print_r($_err);
					echo $this->_open."<h2>Failure - Could not update password</h2><p>Database Error</p>".$this->_close;
					return FALSE;
				}
            }
            catch (PDOException $e)
            {
				print_debug("Could not execute query: ".$sql, $this->_db->errorInfo());
                return FALSE;
            }
        }
        else
		{
			echo $this->_open."<h2>Failure - Passwords do not match</h2><p>Please make sure you typed the passwords correctly.</p>".$this->_close;
            return FALSE;
		}
	}

	public function loginAccount($user, $pass)
	{
		$_u = trim($user);
		$_p = trim($pass);
		$_p5 = md5($_p);

		$sql = "SELECT UserName FROM Users WHERE UserName='$_u' AND Password='$_p5'";
		try
		{
			if ($stmt = $this->_db->query($sql))
			{
				$row = $stmt->fetch();
				$result = $row['UserName'];
				if ($result == $_u)
				{
					$_SESSION['UserName'] = $_u;
					$_SESSION['LoggedIn'] = 1;
					echo $this->_open."<h2> You have successfully logged in to the TPS </h2><p> Now that you have logged in, use the navigational buttons to access the system.</p>".$this->_close;
					//print out nav buttons
					return TRUE;
				}
				else
				{
					print_debug("Returned higher or lower rowcount for user: ".$stmt->rowCount()." : ".$sql, $this->_db->errorInfo());
					return FALSE;
				}
			}
			else
			{
				print_debug("Could not execute query: ".$sql, $this->_db->errorInfo());
				return FALSE;
			}
		}
		catch(PDOException $e)
		{
			print_debug("Could not execute query: ".$sql, $this->_db->errorInfo());
			return FALSE;
		}
	}
	
	public function forgotAccount()
	{
		return 'the user forgot their account';
	}
	
	public function createAccount()
	{
		$u = trim($_POST['registername']);
		$e = trim($_POST['registeremail']);
        $v = sha1(time());
		
		$sql = "SELECT COUNT(UserName) AS theCount FROM users WHERE UserName=':uname'";

		if ($stmt = $this->_db->prepare($sql))
		{
            $stmt->bindParam(":uname", $u, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['theCount'] != 0)
                return $this->_open."<h2> Error </h2><p> Sorry, that UserName is already in use. Please try again.</p>".$this->_close;
			
			$sql = "SELECT COUNT(UserEmail) AS theCount FROM users WHERE UserEmail=':umail'";
			if ($stmt = $this->_db->prepare($sql))
			{
				$stmt->bindParam(":umail", $e, PDO::PARAM_STR);
				$stmt->execute();
				$row = $stmt->fetch();
				if ($row['theCount'] != 0)
					return $this->_open."<h2> Error </h2><p> Sorry, that Email address is already in use. Please try again.</p>".$this->_close;
			}

			if (!$this->sendVerificationEmail($u, $e, $v))
			{
                return $this->_open."<h2> Error </h2><p> There was an error sending your verification email. Please <a href=\"mailto:admin@tracedigital.co.za\">contact us</a> for support, or try again. We apologize for the inconvenience. </p>".$this->_close;
			}
			$stmt->closeCursor();
		}
		
		try
		{
			$id = getNextID($this->_db, 'Users', 'UserID');
			
			//$sql = "INSERT INTO Users(UserID, UserName, UserEmail, ver_code, verified) VALUES($id, ':uname', ':umail', ':ver', 0)";
			$sql = "INSERT INTO Users (UserID, UserName, UserEmail, ver_code, verified) VALUES($id, '$u', '$e', '$v', 0)";
			print_debug("Trying to execute query: ".$sql);
			
			if ($this->_db->query($sql))
			{
				print_debug("Inserted user into DB");
				return $this->_open."<h2> Success! </h2><p> Your account was successfully created with the username <strong>$u</strong>. Check your email for the verification code!".$this->_close;
			}
			else
			{
				return $this->_open."<h2> Error </h2><p> Couldn't insert the user information into the database. </p>".$this->_close;
				print_debug("Could not create query: ".$sql, $this->_db->errorInfo());
			}
		}
		catch (PDOException $e)
		{
			print_debug("Could not execute query: ".$sql, $this->_db->errorInfo());
			return FALSE;
		}
	}
}


?>