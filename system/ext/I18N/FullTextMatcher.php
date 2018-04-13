<?php


class FullTextMatcher
{
	function setQuery($query)
	{
		$this->query_tokens = preg_split("/\s+/", $query);
	}
	
	function match($subject)
	{
		foreach ($this->query_tokens as $token)
		{
			if (!preg_match("/\b".$token."/i", $subject))
			{
				return false;
			}
		}
		return true;
	}
}

?>