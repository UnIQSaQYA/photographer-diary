<?php

class Token {
	/**
	 * This function is used to generate token in session which is used to prevent csrf token
	 * @return [type] generated token
	 */
	private static function generateToken() {
		return Session::set(Config::getConfig('session/token_name'),  md5(uniqid()));
	}

	/**
	 * use to check token
	 * @param  [type] $csrf_token [description]
	 * @return [type]             [description]
	 */
    public static function checkToken($csrf_token)
    {

        if(Session::exists(Config::getConfig('session/token_name')) && $csrf_token===Session::get(Config::getConfig('session/token_name'))){
            Session::delete(Config::getConfig('session/token_name'));
            return true;
        }
       return false;

    }

    /**
     * use to generate csrf token
     * @return [type] [description]
     */
    public static function inputToken()
    {
        return "<input type='hidden' name='csrf_token' value='".self::generateToken()."' >";
    }

}