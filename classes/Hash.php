<?php

class Hash {

	/**
	 * Encrypts the password in the field
	 * @param  string $password [description]
	 * @return [type]           [description]
	 */
	public static function passwordEncrypt($password = "")
	{
		if(empty($password)) {
			return false;
		}

		return password_hash($password, PASSWORD_DEFAULT);
	}

	/**
	 * This function is used to verify the password
	 * @param  [type] $password [description]
	 * @param  [type] $hash     [description]
	 * @return [type]           [description]
	 */
	public static function passwordVerify($password, $hash) {
		return password_verify($password, $hash);
	}
}