<?php

class Input {
	/**
	 * checks if the form method is post or get.By default the method is assumed as post method.
	 * @var string POST OR GET method
	 */
	 public static function method($method = 'post')
    {
        if (empty($method)) return false;
        switch ($method) {
            case 'post' :
                if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] = 'post') {
                    return true;
                }
                break;

            case 'get':
                if (!empty($_GET) && $_SERVER['REQUEST_METHOD'] = 'get') {
                    return true;
                }
        }
        return false;
    }

	/**
	 * This method can be used to check if the form has been sunmitted
	 * @param  string $method [description]
	 * @return [type]         [description]
	 */
	public static function exists($type = 'post') {
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;
			case 'get':
				return (!empty($_GET)) ? true : false;
				break;
			default:
				return false;
				break;
		}
	}
	/**
     * @param null $key
     * @return bool|string
     */
    public static function post($key = NULL)
    {
        if (!isset($key)) return false;

        if (isset($_POST[$key])) {
            return $_POST[$key];
        }

    }


    // public static function get($key = NULL)
    // {
    //     if (!isset($key)) return false;

    //     if (isset($_GET[$key])) {
    //         return $_GET[$key];
    //     }
    //     return "";

    // }

    public static function get($item) {
        if(isset($_POST[$item])) {
            return $_POST[$item];
        }else if(isset($_GET[$item])) {
            return $_GET[$item];
        }

        return '';
    }

}