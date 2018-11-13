<?php 

class User extends model {
	protected $tableName = 'users';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;

	private $rule = array(
		'username' => array(
			'required' => true,
			'min' 	   => 6,
			'unique'   => 'users|username',
			'label'    => 'User Name',
		),
		'password' => array(
			'required' => true,
			'min'      => 8,
			'label'    => 'Password',
		),
		'f_name' => array(
			'required' => true,
			'min' 	   => 4,
			'label'	   => 'First Name',
			'regex'	   => 'word',
		),
		'l_name' => array(
			'required' => true,
			'min' 	   => 4,
			'label'	   => 'Last Name',
			'regex'	   => 'word',
		),
		'confirm' => array(
			'required' => true,
			'min'	   => 8,
			'matches'  => 'password',
			'label'    => 'Confirm Password',
		),
		'sub_cat_id' => array(
			'required' => true,
			'label'	   => 'Sub Category',
		),
		'slug' => array(
			'required' => true,
			'unique'   => 'user_detail|slug',
			'label'	   => 'Slug'
		),
		'email' => array (
			'valid_email' => true,
			'label' => 'Email'
		),
	);

	public function __construct($user = NULL)
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	/**
	 * This function is used to register photographer only if the input data is valid.
	 * @return [type] [description]
	 */
	public function register() {
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
				'username'   => Input::post('username'),
				'password'   => Hash::passwordEncrypt(Input::post('password')),
				'email'      => Input::post('email'),
				'joined'     => date('Y-m-d H:i:s'),
				'user_group' => 2,
				'status' 	 => 0, 
			];
			$id = $this->save($data);
			$slug = slugify(Input::post('f_name').Input::post('l_name')).'-'.$id;
			$user_info = [
				'first_name'     => Input::post('f_name'),
				'last_name'      => Input::post('l_name'),
				'subcategory_id' => Input::post('sub_cat_id'),
				'slug' 			 => $slug,
				'user_id' 	     => $id,
				'created_at' 	 => date('Y-m-d H:i:s'),
			];
			$save = $this->savebytable('user_detail', $user_info);
			if($id && $save) {
				Session::set('success', 'Your account has been registered an is in the process of activation. You will get an email after it has been activated. Thank You!');
				Redirect::to(URL . 'user/login.php');			}
		}else{
        	session::set('validationErrors',$this->_validate->getErrors());
    	}
	}

	public function login() {
		unset($this->rule['username']['unique']);
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$user = $this->selectBy('username=?',[Input::post('username')],true);
			if(count($user)) {
				if(Hash::passwordVerify(Input::post('password'), $user->password)) {
					if($user->status == 1){
						$userData['id'] = $user->id;
						$userData['username'] = $user->username;
						$userData['email'] = $user->email;	
						$userData['is_logged_in'] = true;
						Session::userData($userData);
						Redirect::to(URL . 'user/dashboard');
						
					}else{
						Session::set('error', 'Your account has not been activated please contact the admin');
					}
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

	public function getUserDetail() {
		$id = Session::get('id');
		if(isset($id)) {
			$user = $this->dbRaw("
				SELECT * FROM user_detail
				JOIN sub_category ON(sub_category.id = user_detail.subcategory_id)
				WHERE user_id='{$id}'");
			if(count($user)) {
				return $user[0];
			} else {
				return [];
			}
		}
	}

	public function getAllSubCategory() {
		$detail = $this->get(1, 'sub_category', 'category_id');
		if(count($detail)) {
			return $detail;
		} else {
			return [];
		}
	}

	public function getAllCategory() {
		$detail = $this->dbRaw("SELECT * FROM category");
		if(count($detail)) {
			return $detail;
		} else {
			return [];
		}
	}

	public function editProfile() {
		unset($this->rule['slug']['unique']);
		$this->_validate->validate($this->rule);
		$id = Session::get('id');
		$this->_validate->validate($this->rule);
		$data = [
			'subcategory_id' => Input::post('subcategory'),
			'first_name' 	 => Input::post('f_name'),
			'last_name'  	 => Input::post('l_name'),
			'gender' 	 	 => Input::post('gender'),
			'slug'		 	 => Input::post('slug'),
		];
		if($this->_validate->isValid()) {
			if(!empty($_FILES['profile']['name']) || $_FILES['cover']['name']) {
				$upload = [
				'max_size'  => '5242880',
				'location'  => ROOT . 'public_html/image/portfolio/',
				'valid_ext' => 'jpg|jpeg|png|gif',
				'height'    => 200,
				'width'		=> 200,
				];
				Upload::initialize($upload);
				$profile = Upload::doUpload($_FILES['profile']);
				$cover = Upload::doUpload($_FILES['cover']);
				if($profile && $cover) {
					$data = array_merge($data,["profile_pic" => $profile, "cover_pic" => $cover]);
					$update = $this->update($data, $id, 'user_detail', 'user_id');	
				}elseif($profile){
					$data = array_merge($data, ["profile_pic" => $profile]);
					$update = $this->update($data, $id, 'user_detail', 'user_id');
				}elseif($cover){
					$data = array_merge($data, ["cover_pic" => $cover]);
					$update = $this->update($data, $id, 'user_detail', 'user_id' );
				}else {
					Session::set('uploadErrors', upload::getUploadErrors());
				}
				if($update) {
					Session::set('success', 'User Detail Updated Successfully');
					Redirect::to(URL . 'user/dashboard.php');
				}
			}else{
				$update = $this->update($data, $id, 'user_detail', 'user_id');
				if($update) {
					Session::set('success', 'Profile has been updated Successfully');
					Redirect::to(URL . 'user/dashboard.php');
				}
			}
		}else{
        	session::set('validationErrors',$this->_validate->getErrors());
    	}
	}

	/**
	 * This function takes te email from the user checks if the user with the same email exist
	 * if the email exist it checks if the password reset token has been set in the email if its already set
	 * it uses that token to send verification email otherwise create new token and send email
	 * @return [type] [description]
	 */
	public function passwordResetMail() {
		$email = Input::post('email');
		$checkEmail = $this->selectBy('email=?',[Input::post('email')],true);
		if(count($checkEmail)) {
			$id = $checkEmail->id;
			$checkToken = $this->dbRaw("SELECT * FROM email_verification WHERE user_id='{$id}'");

			if(count($checkToken)) {
				$to = $email;
				$token = $checkToken[0]->token;
				$subject = "Password Reset";
				$body = "Please Click this link to reset password "  . URL . "user/verify_email.php?"."u=".Secure::encrypt($id)."&key=".$token;
				if(mail($to, $subject, $body)) {
					Session::set('success', 'A verification email has been sent to ' .$email);
				}else{
					Session::set('error', 'An error occured while sending email, Please Try again');	
				}
			}else {
				$token = md5(uniqid());
				$data = [
					'email' => $email,
					'user_id' => $checkEmail->id,
					'token'	  => $token,
				];
				if($this->create($data, 'email_verification')) {
					$to = $email;
					$subject = "Password Reset";
					$body = "Please Click this link to reset password " . URL . "user/verify_email.php?"."u=".Secure::encrypt($id)."&key=".$token;
					if(mail($to, $subject, $body)) {
						Session::set('success', 'A verification email has been sent to ' .$email);
					}else{
						Session::set('error', 'An error occured while sending email, Please Try again');
					}
				}
			}
		}else{
			Session::set('error', 'Please Provide a valid email address');
		}
	}

	public function verifyEmail($token, $id) {
		$token = $token;
		$decryptid = Secure::decrypt($id);
		$checkToken = $this->dbRaw("SELECT * FROM email_verification WHERE token='{$token}' AND user_id='{$decryptid}'");
		if(count($checkToken)) {
			$this->delete($checkToken[0]->id, 'email_verification');
			Redirect::to(URL .'user/change_password.php?u='.$id);
		}else{
			Session::set('warning', 'Invalid Token, Please try again');
			Redirect::to(URL .'user/login');
		}
	}

	public function changePassword() {
		$this->_validate->validate($this->rule);
		$id = Secure::decrypt(Input::get('u'));
		if($this->_validate->isValid()) {
			$data = [
				'password' => Hash::passwordEncrypt(Input::post('password')),
			];

			if($this->update($data, $id)) {
				Session::set('success', 'Password change successfully');
				Redirect::to(URL .'user/login');
			}else{
				Session::set('success', 'Unable to change password please try again');	
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}
} 