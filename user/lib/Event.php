<?php
class Event extends model {
	protected $tableName = 'event';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	private $_validate;
	protected $_sessionName;

	private $rule = array (
		'name' => array (
			'required' =>true,
			'min' => 4,
			'max' => 80,
			'label' => 'Event Name'
			),
		'date' => array (

			'label' => 'Event Date',
			),
		'venue' => array (
			'min' => 4,
			'max' => 80,
			'label' => 'Event Venue',
			),
		'organized' => array (
			'min' => 4,
			'max' => 80,
			'regex' => 'word',
			'label' => 'Event Organized by'
			),
		'about' => array (
			'required' => true,
			'min' => 50,
			'label' => 'Event Detail'
			),
		'caption' => array(
			'required' => true,
			'label'	   => 'caption'
			)
		);

	public function __construct() {
		parent::__construct();
		$this->_validate = new Validation();
	}


	public function getEvent() {
		$authId = Session::get('id');
		$userId = $this->dbRaw('SELECT id FROM user_detail where user_id='.$authId);
		if(count($userId)) {
			$event = $this->dbRaw(
				"SELECT A.id, A.name, A.description, A.date, A.venue, A.organize_by, A.user_id, B.image FROM event A
				LEFT JOIN event_picture B ON (A.id = B.event_id AND B.is_cover = 1)
				WHERE A.user_id='{$userId[0]->id}'
				");
			if(count($event)) {
				return $event;
			}else{
				return [];
			}
		}else{
			return [];
		}
	}
	
	public function createEvent() {
		$id = Session::get('id');
		$obj = $this->dbRaw('SELECT * FROM user_detail where user_id='.$id);
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'name' 		  => Input::post('name'),
			'description' => Input::post('about'),
			'date' 		  => Input::post('date'),
			'venue' 	  => Input::post('venue'),
			'organize_by' => Input::post('organized'),
			'user_id' 	  => $obj[0]->id,
			];
			$create = $this->create($data);
			if($create) {
				Session::set('success', 'Event has been successfully created');
				Redirect::to(URL . 'user/dashboard');		
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function getEventData() {
		$id = Secure::decrypt(Input::get('id'));
		$authId = Session::get('id');
		$obj = $this->get($authId, 'user_detail');
		$objId = $obj[0]->id;
		if(isset($id)) {
			$event = $this->dbRaw("SELECT * FROM event WHERE id = '{$id}' AND user_id = '{$objId}' ");
			if(count($event)) {
				return $event[0];
			}else {
				Redirect::to(URL . 'user/errors/404.php');
				return [];
			}
		}
	}

	public function updateEvent() {
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
				$data = [
					'name' 		  => Input::post('name'),
					'description' => Input::post('about'),
					'date' 		  => Input::post('date'),
					'venue' 	  => Input::post('venue'),
					'organize_by' => Input::post('organized'),
					];
				;
			if($this->update($data, $id)) {
				Session::set('success', 'Event has been successfully updated');
				Redirect::to(URL . 'user/event/view_event.php');		
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());	
		}
	}

	public function deleteEvent($id) {
		if($this->delete($id)) {
			Session::set('success', 'Event has been successfully deleted');
			Redirect::to(URL . 'user/dashboard');
		}else{
			Session::set('warning', 'could not delete event');
			Redirect::to(URL . 'user/event/detail.php');
		}
	}

	public function getEventById() {
		$eventId = Secure::decrypt(Input::get('id'));
		$authId = Session::get('id');
		$obj = $this->dbRaw("SELECT id FROM user_detail where user_id='{$authId}'");
		if(count($obj)) {
			if(!empty($eventId)) {
				$event = $this->dbRaw(
					"SELECT A.id, A.name, A.description, A.date, A.venue, A.organize_by, A.user_id, B.image FROM event A
					LEFT JOIN event_picture B ON (A.id = B.event_id AND B.is_cover = 1)
					WHERE A.id='{$eventId}'
					");
				if(count($event)) {
					return $event[0];
				}else{
					return [];
				}
			}else {
				return [];
			}
		}
	}

	public function getEventGallery() {
		$eventId = Secure::decrypt(Input::get('id'));
		$authId = Session::get('id');
		if(!empty($eventId)) {
			$gallery = $this->dbRaw("SELECT * FROM event_picture WHERE event_id='{$eventId}'");

			if(count($gallery)) {
				return $gallery;
			}else{
				return [];
			}
		}	
	}

	public function createEventImage() {
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$event_id = Secure::decrypt(Input::get('id'));
			$i = 0;
			$success = false;
			$eventImage = $this->dbRaw("SELECT id FROM event_picture WHERE event_id='{$event_id}'");
			if(count($eventImage) <= 4) {

				if(!empty($_FILES['image']['name'])) {
					$upload = [
					'max_size'  => '5242880',
					'location'  => ROOT . 'public_html/image/event/',
					'valid_ext' => 'jpg|jpeg|png|gif',
					];
					foreach ($_FILES['image']['name'] as $key => $file) {
						$uploadInfo['name'] = $file;
						$uploadInfo['error'] = $_FILES['image']['error'][$key];
						$uploadInfo['tmp_name'] = $_FILES['image']['tmp_name'][$key];
						$uploadInfo['size'] = $_FILES['image']['size'][$key];
						$caption = Input::post('caption')[$key];
						$is_cover = Input::post('cover')[$key];
						if($is_cover == 1) {
							$cover = $this->dbRaw("SELECT id FROM event_picture WHERE event_id='{$event_id}' AND is_cover=1");
							if(count($cover)) {
								$update = array(
									'is_cover' => 0,
									);
								$this->update($update, $cover[0]->id, 'event_picture');
							}
						}
						Upload::initialize($upload);
						$gallery = Upload::doUpload($uploadInfo);
						if($gallery) {
							$data = array(
								'image'	   => $gallery,
								'caption'  => $caption,
								'event_id' => $event_id,
								'is_cover' => $is_cover,
								);
							if($this->create($data, 'event_picture')) {
								$i++;
								Session::set('success', $i . 'Event Image Added Successfully');
								$success = true;
							}
						}else{
							Session::set('uploadErrors', Upload::getUploadErrors());					
						}
					}
					if($success == true){
						Redirect::to(URL . 'user/event/view_event.php');
					}
				}else {
					Session::set('error', 'Please Choose an image');
				}
			}else {
				Session::set('error', 'You need to be a Premium user to add more event picture');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function getEventGalleryById() {
		$eventId = Secure::decrypt(Input::get('id'));
		$authId = Session::get('id');
		if(!empty($eventId)) {
			$gallery = $this->dbRaw("SELECT * FROM event_picture WHERE id='{$eventId}'");
			if(count($gallery)) {
				return $gallery[0];
			}else{
				return [];
			}
		}

	}

	public function editEventImage() {
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$event_id = Secure::decrypt(Input::get('id'));
			$eventImage = $this->dbRaw("SELECT id, event_id FROM event_picture WHERE id='{$event_id}'");
			if(count($eventImage) <= 4) {
				if(Input::post('cover') == 1) {
					$id = $eventImage[0]->event_id;
					$cover = $this->dbRaw("SELECT id FROM event_picture WHERE event_id='{$id}' AND is_cover=1");
					if(count($cover)) {
						$update = array(
							'is_cover' => 0,
							);
						$this->update($update, $cover[0]->id, 'event_picture');
					}
				}
				$data = array(
					'caption'  => Input::post('caption'),
					'is_cover' => Input::post('cover'),
					);
				if(!empty($_FILES['image']['name'])) {
					$upload = [
					'max_size'  => '5242880',
					'location'  => ROOT . 'public_html/image/event/',
					'valid_ext' => 'jpg|jpeg|png|gif',
					];
					Upload::initialize($upload);
					$gallery = Upload::doUpload($_FILES['image']);
					if($gallery) {
						$data = array_merge($data,["image" => $gallery]);
						$update = $this->update($data, $event_id, 'event_picture');
						Session::set('success', 'Event Image Added Successfully');
						Redirect::to(URL . 'user/event/event_gallery.php?id=' . Secure::encrypt($eventImage[0]->event_id));
					}else{
						Session::set('uploadErrors', Upload::getUploadErrors());					
					}
				}else {
					$data = array_merge($data,["image" => $this->getEventGalleryById()->image]);
					$update = $this->update($data, $event_id, 'event_picture');
					Session::set('success', 'Event Image Added Successfully');
					Redirect::to(URL . 'user/event/event_gallery.php?id=' . Secure::encrypt($eventImage[0]->event_id));
				}
			}else {
				Session::set('error', 'You need to be a Premium user to add more event picture');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteEventGallery($id) {
		if($this->delete($id, 'event_picture')) {
			Session::set('success', 'Event has been successfully deleted');
			Redirect::to(URL . 'user/dashboard');
		}else{
			Session::set('warning', 'could not delete event');
			Redirect::to(URL . 'user/event/detail.php');
		}
	}
}