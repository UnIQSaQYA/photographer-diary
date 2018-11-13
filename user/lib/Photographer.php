<?php
class Photographer extends model {
	protected $tableName = 'user_detail';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	private $_validate;
	protected $_sessionName;

	private $rule = array(
		'description' => array(
			'min'     => 1,
			'label'   => 'Description',
		),
		'facebook'   => array(
			'url'    => true,
			'label'  => 'Facebook',
		),
		'instagram' => array(
			'url'   => true,
			'label' => 'Instagram',
		),
		'linkedin'  => array (
			'url'   => true,
			'label' => 'Linkedin',
		),
		'twitter'   => array (
			'url'   => true,
			'label' =>'Twitter',
		),
		'google'    => array (
			'url'   => true,
			'label' => 'Google Plus',
		),
		'number' => array (
			'unique' => 'about|contact_num',
			'regex'  => 'number',
			'label'  => 'Contact Number'
		),
		'about' => array (
			'required' => true,
			'min'	   => 100,	
			'label'    => 'Detail',
		),
		'caption' => array (
			'min' => 10,
			'label' => 'Caption'
		),
		'password' => array(
			'required' => true,
			'min'      => 8,
			'label'    => 'Password',
		),
		'newpassword' => array(
			'required' => true,
			'min'      => 8,
			'label'    => 'New Password',
		),
		'confirmpassword' => array(
			'required' => true,
			'min'	   => 8,
			'matches'  => 'newpassword',
			'label'    => 'Confirm Password',
		),
	);

	public function __construct($user = NULL)
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function getPhotographerDetail() {
		$id = Session::get('id');
		if(isset($id)) {
			$user_id = $this->dbRaw("SELECT id FROM user_detail WHERE user_id='{$id}'");
			
			$detail = $this->dbRaw("SELECT * FROM about WHERE user_id='{$user_id[0]->id}'");
		
			if(count($detail)) {
				return $detail[0];
			} else {
				return [];
			}
		}
	}

	public function createAbout() {
		$id = Session::get('id');
		$user_id = $this->dbRaw("SELECT id FROM user_detail WHERE user_id='{$id}'");
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			if(isset($id)) {
				$data = [
					'facebook'    => Input::post('facebook'),
					'instagram'   => Input::post('instagram'),
					'twitter'     => Input::post('twitter'),
					'google'      => Input::post('google'),
					'linkedin'    => Input::post('linkedin'),
					'contact_num' => Input::post('number'),
					'detail' 	  => Input::post('about'),
					'user_id'	  => $user_id[0]->id,
					'address'	  => Input::post('address'),
					'show_contact' => ((Input::post('show') == 1) ? 1 : 0),
				];

				if($this->create($data, 'about')) {
					Session::set('success', 'Profile has been successfully created');
					Redirect::to(URL . 'user/dashboard');	
				}
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function updateAbout() {
		$id = Session::get('id');
		$user_id = $this->dbRaw("SELECT id FROM user_detail WHERE user_id='{$id}'");
		unset($this->rule['number']['unique']);
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			if(isset($id)) {
				$data = [
					'facebook'    => Input::post('facebook'),
					'instagram'   => Input::post('instagram'),
					'twitter'     => Input::post('twitter'),
					'google'      => Input::post('google'),
					'linkedin'    => Input::post('linkedin'),
					'contact_num' => Input::post('number'),
					'detail' 	  => Input::post('about'),
					'address'	  => Input::post('address'),
					'show_contact' => ((Input::post('show') == 1) ? 1 : 0),
				];

				if($this->update($data, $user_id[0]->id, 'about', 'user_id')) {
					Session::set('success', 'Profile has been successfully updated');
					Redirect::to(URL . 'user/dashboard');	
				}
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());	
		}
	}

	public function changePassword() {
		$id = Session::get('id');
		$user = $this->dbRaw("SELECT password FROM users where id='{$id}'");
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
				'password' => Hash::passwordEncrypt(Input::post('confirmpassword')),
			];
			if(Hash::passwordVerify(Input::post('password'), $user[0]->password)) {
				if($this->update($data, $id, 'users')) {
					Session::set('success', 'Password has been successfully changed');
					Redirect::to(URL . 'user/dashboard');
				}
			}else{
				Session::set('Please provide the correct old password');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());	
		}
	}
}