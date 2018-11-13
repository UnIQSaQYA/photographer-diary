<?php

class Config {

	/**
	 * @param  [type] $path
	 * @return [type] $config
	 * This function is used to fetch data from global config variables
	 */
	
	public static function getConfig($path = null)
	{
		if($path) {
			$config = $GLOBALS['CONFIG'];
			$path = explode('/', $path);
			foreach($path as $bit) {
				if(isset($config[$bit])) {
					$config = $config[$bit];
				}
			}

			return $config;
		}
		return false;
	}
}