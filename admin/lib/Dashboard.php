<?php
class Dashboard extends model {
	protected $primaryKey = 'id';
	protected $columnName = '*';
	public function registeredUser() {
		$user = $this->dbRaw("SELECT * FROM  users WHERE status=0");
		if(count($user)) {
			return $user;
		}else {
			return [];
		}
	}
	
	public function activate() {
		$userId = Input::get('id');
		$user = $this->dbRaw("SELECT * FROM  users WHERE id='{$userId}'");
		$to = $user[0]->email;
		$subject = 'Account activated';
		$headers = "From: uniqsaqya@gmail.com";
		$txt = "Dear users your account has been activated. Click on the following link to login ". URL ."user/login";
		$data = [
			'status'=> 1,
		];

		if($this->update($data, $userId, 'users')) {
			Session::set('success', 'Account activated');
			mail($to, $subject, $txt, $headers);
			Redirect::to(URL . 'admin/dashboard.php');
		}		
	}
}