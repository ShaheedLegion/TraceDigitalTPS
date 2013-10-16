<?php
	include_once 'pages/database.php';
	include_once 'pages/globals.php';
	include_once 'pages/debug.php';

/**
 * Handles display/edit of client profiles.
 *
 * PHP version 5
 *
 * @author Shaheed Abdol
 * @copyright 2013 Shaheed Abdol
 *
 */
class TPSClients
{
	private $_db;
	public $_clientopen = "<span><h3>Client</h3><select name=\"projectclient\" id=\"projectclient\" class=\"biginput\">";
	public $_clientclose = "</select></span><br/>";

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
	
	public function formatOptionData($name, $value, $selected)
	{
		$opt = 
		"
			<option value=\"$value\" $selected>$name</option>
		";
		
		return $opt;
	}

	public function fetchClientList()
	{
		$navmain="
		$this->_clientopen
		";
		#Get all the client data from DB (only relevant to the form, client name and id)
		#Then iterate and call the formatOptionData function to fill out a nice form with the client names available.
		$navmid = 
		$this->formatOptionData('Nb Publishers', '0', '')
		.$this->formatOptionData('Van Schaik Publishers', '1', '')
		.$this->formatOptionData('Lux Verbi Publishers', '2', '')
		.$this->formatOptionData('Future Managers', '3', '')
		.$this->formatOptionData('Tafelberg Publishers', '4', '');
		
		$navend="
		$this->_clientclose
		";
		echo $navmain.$navmid.$navend;
	}
}