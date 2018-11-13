<?php

class Background extends model {
	protected $tableName = 'background';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;
	private $rule = array(
		'img_type' => array(
			'required'	=> true,
		),
	);

	public function __construct()
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function createImage()
	{
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			if(!empty($_FILES['image']['name'])){
				$upload = [
				'max_size'  => '5242880',
				'location'  => ROOT . 'public_html/image/background/',
				'valid_ext' => 'jpg|jpeg|png|gif',
				];
				Upload::initialize($upload);
				$fileName = Upload::doUpload($_FILES['image']);
				if($fileName) {
					$data = [
					'image' => $fileName,
					'type'	=> Input::post('img_type'),
					];

					if($this->create($data)){
						Session::set('success', 'Background Image for home successfully added');
						Redirect::to(URL .'admin/home/view_image.php');
					}else{
						Session::set('success', 'Background Image for home successfully added');
						Redirect::to(URL .'admin/home/view_image.php');
					}
				}else{
					Session::set('uploadErrors', upload::getUploadErrors());
				}
			}else{

				Session::set('warning', 'Please Choose an image before uploading');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}

	}

	public function getAllImage()
	{
		$image = $this->get();
		if(count($image)) {
			return $image;
		}else{
			return [];
		}
	}

	public function getImageById()
	{
		$id = Secure::decrypt(Input::get('id'));
		$image = $this->get($id);
		if(count($image)){
			return $image[0];
		}
	}

	public function editImage()
	{
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			if(!empty($_FILES['image']['name'])){
				$upload = [
				'max_size'  => '5242880',
				'location'  => ROOT . 'public_html/image/background/',
				'valid_ext' => 'jpg|jpeg|png|gif',
				];
				Upload::initialize($upload);
				$fileName = Upload::doUpload($_FILES['image']);
				Upload::deletefiles(ROOT . 'public_html/image/background/'. $this->getImageById()->image);
				if($fileName) {
					$data = [
					'image' => $fileName,
					'type'	=> Input::post('img_type'),
					];

					if($this->update($data, $id)){
						Session::set('success', 'Background Image for home successfully added');
						Redirect::to(URL .'admin/home/view_image.php');
					}else{
						Session::set('success', 'Background Image cannot be updated');
						Redirect::to(URL .'admin/home/view_image.php');
					}
				}else{
					
				}
			}else{
				$data = [
				'image' => $this->getImageById()->image,
				'type'	=> Input::post('img_type'),
				];

				if($this->update($data, $id)){
					Session::set('success', 'Background Image successfully added');
					Redirect::to(URL .'admin/home/view_image.php');
				}else{
					Session::set('warning', 'Background Image cannot be updated');
					Redirect::to(URL .'admin/home/view_image.php');
				}
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteImage($id) {
		$id = Secure::decrypt($id);
		$delete = $this->delete($id);

		if($delete) {
			Upload::deletefiles(ROOT . 'public_html/image/background/'. $this->getImageById()->image);
			Session::set('success', 'Image has been successfully deleted');
			Redirect::to(URL .'admin/home/view_image.php');
		}
	}
}