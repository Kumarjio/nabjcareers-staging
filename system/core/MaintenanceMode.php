<?php

class SJB_MaintenanceMode
{

	private $remoteIP;
	private $allowedIP = null;
	private $allowed = true;

	public function checkByPattern()
	{
		$aIPParts = explode('.', $this->allowedIP);

		$aNewParts = array();

		foreach ($aIPParts as $part)
		{
			if (strstr($part, '*'))
			{
				$asteriskPosition = strpos($part, '*');
				if ($asteriskPosition === 0)
				{
					$count = 3;
				}
				else
				{
					$count = 3 - $asteriskPosition;
				}
				array_push($aNewParts, str_replace('*', '[\\d]{1,' . $count . '}', $part));
			}
			else
			{
				array_push($aNewParts, $part);
			}
		}

		$pattern = '/^' . implode('\.', $aNewParts) . '$/';
		
		if (preg_match($pattern, $this->remoteIP))
		{
			return true;
		}
		return false;
	}

	public function checkIfSiteIsAvailable()
	{
		if (empty($this->allowedIP))
		{
			// turn off site for all visitors
			$this->allowed = false;
		}
		elseif (strstr($this->allowedIP, '*'))
		{
			$this->allowed = $this->checkByPattern();
		}
		elseif (strcmp($this->allowedIP, $this->remoteIP) !== 0)
		{
			$this->allowed = false;
		}
	}

	function __construct($remoteIP)
	{
		if (SJB_Settings::getValue('maintenance_mode'))
		{
			$this->allowedIP = SJB_Settings::getValue('maintenance_mode_ip');
			$this->remoteIP = $remoteIP;
			$this->checkIfSiteIsAvailable();
		}
	}

	public function getAllowed()
	{
		return $this->allowed;
	}

}

?>
