<?php

class Portfolio extends model {
	protected $tableName = 'gallery';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	private $_validate;
	protected $_sessionName;
	private $rule = array(
		'caption' => array (
			'min' => 10,
			'label' => 'Caption'
		),
	);

	public function __construct($user = NULL)
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function getPhotographerType(){
		$type = $this->dbRaw("SELECT A.subcategory_name, A.id FROM sub_category A INNER JOIN category B ON(A.category_id = B.id) WHERE B.category_name = 'photographer type'");
		if(count($type))
		{
			return $type;
		}else{
			return [];
		}
	}

	public function getPhotographerUserType()
	{
		$id = Session::get('id');
		$obj = $this->dbRaw("SELECT user_type FROM user_detail WHERE user_id='{$id}'");

		if(count($obj))
		{
			return $obj;
		}else{
			return [];
		}
	}


	public function createGallery() {
		$this->_validate->validate($this->rule);
		$id = Session::get('id'); 
		$obj = $this->dbRaw("SELECT id FROM user_detail WHERE user_id='{$id}'");
		$gallery = $this->dbRaw("SELECT * FROM gallery WHERE user_id='{$obj[0]->id}'");
		$i = 0;
		$success = false;
		if(count($gallery <= 20)) {
			if($this->_validate->isValid()) {
				if(!empty($_FILES['gallery']['name'])) {
					$upload = [
					'max_size'  => '5242880',
					'location'  => ROOT . 'public_html/image/gallery/',
					'valid_ext' => 'jpg|jpeg|png|gif',
					];
					foreach($_FILES['gallery']['name'] as $key => $file) {
						$uploadInfo['name'] = $file;
						$uploadInfo['error'] = $_FILES['gallery']['error'][$key];
						$uploadInfo['tmp_name'] = $_FILES['gallery']['tmp_name'][$key];
						$uploadInfo['size'] = $_FILES['gallery']['size'][$key];
						$caption = Input::post('caption')[$key];
						$type = Input::post('type')[$key];
						Upload::initialize($upload);
						$gallery = Upload::doUpload($uploadInfo);
						if($gallery) {
							$data = array(
								"photo" => $gallery,
								'user_id' => $obj[0]->id,
								'caption' => $caption,
								'type'	  => $type,
								);
							if($this->create($data, 'gallery')) {
								$i++;
								Session::set('success', 'Image Added Successfully');
								$success = true;
							}
						}else{
							Session::set('uploadErrors', Upload::getUploadErrors());
						}				
					}
					if($success == true) {
						Redirect::to(URL . 'user/portfolio/view_portfolio.php');
					}else{
						Session::set('error', 'Portfolio cannot be created');
					}
				}else{
					Session::set('error', 'Please provide an image');
					Redirect::to(URL . 'user/dashboard');	
				}
			}else {
				Session::set('validationErrors',$this->_validate->getErrors());
			}
		}else {
			Session::set('errot', 'You need to be a premium user to add more Portfolio image');
		}
	}

	public function getAllGallery() {
		$id = Session::get('id');
		$obj = $this->dbRaw("SELECT id FROM user_detail WHERE user_id='{$id}'");
		if(count($obj)) {
			$objId = $obj[0]->id;
			$detail = $this->dbRaw("SELECT * FROM gallery WHERE user_id = '{$objId}'");
			if(count($detail)) {
				return $detail;
			} else {
				return [];
			}
		}else{
			return [];
		}
	}

	public function getGallery() {
		$id = Secure::decrypt(Input::get('id'));
		$authId = Session::get('id');
		$obj = $this->dbRaw("SELECT id FROM user_detail WHERE user_id='{$authId}'");
		$objId = $obj[0]->id;
		if(isset($id)) {
			$gallery = $this->dbRaw("SELECT A.id, A.caption, A.user_id, A.photo, A.type, B.subcategory_name, B.id FROM gallery A LEFT JOIN sub_category B ON(A.type = B.id) WHERE A.id = '{$id}'");
			if(count($gallery)) {
				return $gallery[0];
			}else {
				Redirect::to(URL . 'user/errors/404.php');
				return [];
			}
		}
	}

	public function editGallery() {
		$id = Secure::decrypt(Input::get('id'));
		$this->primaryKey = 'id';
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = array(
				'caption' => Input::post('caption'),
				'type' => Input::post('type'),
				);
			if(!empty($_FILES['gallery']['name'])) {
				$upload = [
				'max_size'  => '5242880',
				'location'  => ROOT . 'public_html/image/gallery/',
				'valid_ext' => 'jpg|jpeg|png|gif',
				];
				Upload::initialize($upload);
				$gallery = Upload::doUpload($_FILES['gallery']);
				if($gallery) {
					$data = array_merge($data,["photo" => $gallery]);
					Upload::deleteFiles(Asset . 'image/gallery' . $this->getGallery()->photo);
					$update = $this->update($data, $id, 'gallery');
				}else{
					Session::set('uploadErrors', Upload::getUploadErrors());
				}
			}else{
				$update = $this->update($data, $id, 'gallery');
			}

			if($update) {
				Session::set('success', 'Gallery created successfully');
				Redirect::to(URL . 'user/dashboard');	
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}	
	}


	public function deleteGallery($id) {
		if($this->delete($id)) {
			Session::set('success', 'Event has been successfully deleted');
			Redirect::to(URL . 'user/dashboard');
		}else{
			Session::set('warning', 'could not delete event');
			Redirect::to(URL . 'user/event/detail.php');
		}
	}
}