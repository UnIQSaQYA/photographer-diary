<?php

class Admin extends model {
	protected $tableName = 'admin';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;
	private $rule = array(
		'username' => array(
			'required' => true,
			'min' => 6,
			'unique' => 'admin|username',
			'label' => 'User Name',
		),
		'password' => array(
			'required' => true,
			'label' => 'Password',
			'min'      => 8,
		),
		'confirm' => array(
			'required' => true,
			'min'	   => 8,
			'matches'  => 'password',
			'label'    => 'Confirm Password',
		),
	);

	public function __construct()
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function login()
	{
		unset($this->rule['username']['unique']);
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$user = $this->selectBy('username=?',[Input::post('username')],true);
			if(count($user)) {
				if(Hash::passwordVerify(Input::post('password'), $user->passwords)) {
					$userData['username'] = $user->username;
					$userData['name'] = $user->name;
					$userData['id'] = $user->id;
					$userData['is_logged_in'] = true;	
					Session::userData($userData);
					Redirect::to('dashboard.php');
				}else {
					Session::set('error', 'Invalid Credentials');
				}
			}else{
				Session::set('error', 'Invalid Credentials');
			}
		}else{
        	Session::set('validationErrors',$this->_validate->getErrors());
    	}
	}

	public function create_login()
	{
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'username' => Input::post('username'),
			'passwords'   => Hash::passwordEncrypt(Input::post('password')),
			'name'  	 => Input::post('name'),
			'joined'	=> date('Y-m-d H:i:s'),
			'user_group'	=> 1,
			'status'	=>Input::post('status')
			];

			if($this->create($data, 'admin'))
			{
				Session::set('success', 'Successfully registered!');
				Redirect::to(URL .'admin/dashboard.php');
			}
		}
	}
}