<?php

class photographerInfo extends model {
	protected $tableName = 'user_detail';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;

	public $pagination="";
	
	private $rule = array(
		'f_name' => array(
			'required' => true,
			'min' 	   => 3,
			'label'    => 'Full Name',
		),
		'l_name' => array(
			'required' => true,
			'min' 	   => 3,
			'label'    => 'Last Name'
		),
		'caption' => array(
			'min'	=> 5,
			'label' => 'Caption'
		),
		'slug' => array(
			'required' => true,
			'min'	   => '6',
			'label'	   => 'Slug',
			'unique'   => 'user_detail|slug'
		),
		'description' => array(
			'min'	=> 100,
			'label'	=> 'Description',
		),
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
		'organize' => array (
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
		'top' => array(
			'required' => true,
			'label'	   => 'Order By',
			'unique'   => 'top_ten|order_by'
		),
		'contact_num' => array(
			'min'	=> 10,
			'max'	=> 10,
			'label'	=> 'Contact Number'
		),
		'facebook' => array(
			'url'	=> true,
		),
		'twitter'	=> array(
			'url'	=> true,
		),
		'instagram'	=> array(
			'url'	=> true,
		),
		'google'	=> array(
			'url'	=> true,
		),
		'linkedin' => array (
			'url'	=> true,
		),
		'password' => array(
			'required' => true,
			'min'      => 8,
			'label'    => 'Password',
		),
		'confirm' => array(
			'required' => true,
			'min'	   => 8,
			'matches'  => 'password',
			'label'    => 'Confirm Password',
			),
		'subcategory' => array(
			'required' => true,
			'label'	   => 'Sub Category',
			),
		'email' => array (
			'valid_email' => true,
			'label' => 'Email'
		),
	);

	public function __construct()
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function createPhotographer() {
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
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
			$data = [
			'subcategory_id' => Input::post('sub_cat'),
			'first_name' 	 => Input::post('f_name'),
			'last_name'  	 => Input::post('l_name'),
			'user_type' 	 => Input::post('type'),
			'gender' 	 	 => Input::post('gender'),
			'slug'		 	 => Input::post('slug'),
			'profile_pic'	 => $profile,
			'cover_pic'		 => $cover
			];

			$create = $this->create($data, 'user_detail');
			if($create) {
				Session::set('success', 'successfully added photographer');
				Redirect::to(URL. 'admin/photographer/view_photographer.php');
			}
			
		}else{
			session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function createAbout() {
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'contact_num'	=> Input::post('contact'),
			'address'		=> Input::post('address'),
			'facebook'		=> Input::post('facebook'),
			'google'	    => Input::post('google'),
			'twitter'	    => Input::post('twitter'),
			'linkedin'	    => Input::post('linkedin'),
			'instagram'	    => Input::post('instagram'),
			'show_contact'	=> Input::post('show'),
			'detail'	    => Input::post('about'),
			'user_id'		=> $id,
			];

			if($this->create($data, 'about')) {
				Session::set('success', 'successfully added photographer detail');
				Redirect::to(URL. 'admin/photographer/view_photographer.php');
			}
		}
	}
	public function editPhotographer() {
		unset($this->rule['slug']['unique']);
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'subcategory_id' => Input::post('sub_cat'),
			'first_name' 	 => Input::post('f_name'),
			'last_name'  	 => Input::post('l_name'),
			'gender' 	 	 => Input::post('gender'),
			'slug'		 	 => Input::post('slug'),
			];	
			if(!empty($_FILES['profile']['name']) || !empty($_FILES['cover']['name'])) {
				
				$upload = [
				'max_size'  => '5242880',
				'location'  => ROOT . 'public_html/image/portfolio/',
				'valid_ext' => 'jpg|jpeg|png|gif',
				];
				Upload::initialize($upload);
				$profile = Upload::doUpload($_FILES['profile']);
				$cover = Upload::doUpload($_FILES['cover']);

				if($profile && $cover) {
					$data = array_merge($data, ['profile_pic' => $profile, 'cover_pic' => $cover]);
					$update = $this->update($data, $id, 'user_detail');
				}elseif($cover) {
					$data = array_merge($data, ['cover_pic' => $cover]);
					$update = $this->update($data, $id, 'user_detail');
				}elseif($profile) {
					$data = array_merge($data, ['profile_pic' => $profile]);
					$update = $this->update($data, $id, 'user_detail');
				}else {
					Session::set('uploadErrors', upload::getUploadErrors());		
				}
				if($update) {
					Session::set('success', 'Photographer details has been successfully update');
					Redirect::to(URL. 'admin/photographer/view_photographer.php');
				}
			}else {
				$update = $this->update($data, $id, 'user_detail');
				if($update) {
					Session::set('success', 'Photographer details has been successfully update');
					Redirect::to(URL. 'admin/photographer/view_photographer.php');
				}
			}
		}else{
			session::set('validationErrors',$this->_validate->getErrors());
		}	
	}

	public function viewEventGallery() {
		$eventId = Secure::decrypt(Input::get('id'));
		$eventGallery = $this->dbRaw("SELECT * FROM event_picture WHERE event_id={$eventId}");
		if(count($eventGallery)) {
			return $eventGallery;
		}else {
			return $eventId;
		}
	}

	public function viewEventGalleryById() {
		$galleryId = Secure::decrypt(Input::get('id'));
		$eventGallery = $this->dbRaw("SELECT * FROM event_picture WHERE id={$galleryId}");
		if(count($eventGallery)) {
			return $eventGallery[0];
		}else {
			return [];
		}
	}

	public function editAbout() {
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'contact_num'	=> Input::post('contact'),
			'address'		=> Input::post('address'),
			'facebook'		=> Input::post('facebook'),
			'google'	    => Input::post('google'),
			'twitter'	    => Input::post('twitter'),
			'linkedin'	    => Input::post('linkedin'),
			'instagram'	    => Input::post('instagram'),
			'show_contact'	=> Input::post('show'),
			'detail'	    => Input::post('about'),
			];

			if($this->update($data, $id, 'about')) {
				Session::set('success', 'successfully added photographer detail');
				Redirect::to(URL. 'admin/photographer/view_photographer.php');
			}
		}
	}
	public function getAllPhotographer() {
		$this->limit = 4;
	    $config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount();
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
		$photographer = $this->dbRaw(
			'SELECT A.id, A.first_name, A.last_name, A.gender, A.profile_pic, A.cover_pic ,B.id as top_ten
			 FROM user_detail A
			 LEFT JOIN top_ten B ON (B.photographer_id=A.id)'
			 .' LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
		if(count($photographer)) {
			$this->pagination = Pagination::createLinks();
		    return $photographer;
		}else {
			return [];
		}
	}

	public function getAllEvent() {
		$this->limit = 5;
		$photographer = $this->dbRaw('SELECT event.id, event.name, event.date, event.venue, event.organize_by, event.event_image, user_detail.first_name, user_detail.last_name FROM event JOIN user_detail ON(event.user_id = user_detail.id)'.' LIMIT' .' '. $this->limit);
		if(count($photographer)) {
		    return $photographer;
		}else {
			return [];
		}
	}

	public function getEventbyId() {
		$id = Secure::decrypt(Input::get('id'));
		if(isset($id)) {
			$event = $this->get($id, 'event');
			if(count($event)) {
				return $event[0];
			}else{
				return [];
			}
		}
	}

	public function viewEvent() {
		$id = Secure::decrypt(Input::get('id'));
		$this->limit = 10;
		$config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount('event');
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
		$photographer = $this->dbRaw("SELECT * FROM event WHERE user_id='{$id}'");
		if(count($photographer)) {
			$this->pagination = Pagination::createLinks();
		    return $photographer;
		}else {
			return $id;
		}
	}


	public function viewGallery() {
		$this->limit = 10;
		$config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount('gallery');
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
		$photographer = $this->dbRaw('SELECT gallery.id, gallery.photo, gallery.caption, user_detail.first_name, user_detail.last_name FROM gallery JOIN user_detail ON(gallery.user_id = user_detail.id)'.' LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
		if(count($photographer)) {
			$this->pagination = Pagination::createLinks();
		    return $photographer;
		}else {
			return [];
		}
	}
	public function getAllGallery() {
		$id = Secure::decrypt(Input::get('id'));
		$this->limit = 5;
		$photographer = $this->dbRaw("SELECT * FROM gallery WHERE user_id='{$id}'");
		if(count($photographer)) {
		    return $photographer;
		}else {
			return $id;
		}
	}

	public function getGalleryById() {
		$id = Secure::decrypt(Input::get('id'));
		if(isset($id)) {
			$gallery = $this->get($id, 'gallery');
			if(count($gallery)) {
				return $gallery[0];
			}else{
				return [];
			}
		}
	}

	public function getPhotographer() {
		$id = Secure::decrypt(Input::get('id'));
		$photographer = $this->dbRaw("SELECT * FROM user_detail WHERE id = '{$id}'");
		
		if(count($photographer)) {
			return $photographer[0];
		}else {
			return [];
		}
	}

	public function getAboutById() {
		$id = Secure::decrypt(Input::get('id'));
		$photographer = $this->dbRaw("SELECT * FROM about WHERE user_id = '{$id}'");

		if(count($photographer)) {
			return $photographer[0];
		}else {
			return $id;
		}
	}

	public function getAbout() {
		$id = Secure::decrypt(Input::get('id'));
		$photographer = $this->dbRaw("SELECT * FROM about WHERE id = '{$id}'");
		
		if(count($photographer)) {
			return $photographer[0];
		}else {
			return [];
		}
	}
	public function deletePhotographer($id) {
		$id = Secure::decrypt($id);
		$delete = $this->delete($id);

		if($delete) {
			Session::set('success', 'Photographer detail has been successfully deleted');
			Redirect::to(URL .'admin/photographer/view_photographer.php');
		}
	}

	public function createEvent() {
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'name' 		  => Input::post('name'),
			'description' => Input::post('about'),
			'date' 		  => Input::post('date'),
			'venue' 	  => Input::post('venue'),
			'organize_by' => Input::post('organize'),
			'user_id' 	  => $id,
			];
			if($this->create($data, 'event')) {
				Session::set('success', 'Event has been successfully created');
				Redirect::to(URL . 'admin/photographer/view_event.php?id=' . Secure::encrypt($id));		
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
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
						Redirect::to(URL . 'admin/photographer/view_event_gallery.php?id='. Input::get('id'));
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
						Redirect::to(URL . 'admin/photographer/view_event_gallery.php?id=' . Secure::encrypt($eventImage[0]->event_id));
					}else{
						Session::set('uploadErrors', Upload::getUploadErrors());					
					}
				}else {
					$data = array_merge($data,["image" => $this->viewEventGalleryById()->image]);
					$update = $this->update($data, $event_id, 'event_picture');
					Session::set('success', 'Event Image Added Successfully');
					Redirect::to(URL . 'admin/photographer/view_event_gallery.php?id=' . Secure::encrypt($eventImage[0]->event_id));
				}
			}else {
				Session::set('error', 'Cannot upload more than 5 picture');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function editEvent() {
		$id = Secure::decrypt(Input::get('id'));
		$user_id = $this->dbRaw("SELECT user_id from event WHERE id='{$id}'");
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'name' 		  => Input::post('name'),
			'description' => Input::post('about'),
			'date' 		  => Input::post('date'),
			'venue' 	  => Input::post('venue'),
			'organize_by' => Input::post('organize'),
			];
			if($this->update($data, $id, 'event')) {
				Session::set('success', 'Event has been successfully updated');
				Redirect::to(URL . 'admin/photographer/view_event.php?id=' . Secure::encrypt($user_id[0]->user_id));		
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteEvent($id) {
		$id = Secure::decrypt($id);
		$userId = $this->dbRaw("SELECT user_id FROM event WHERE id={$id}");
		$delete = $this->delete($id, 'event');
		if($delete) {
			Session::set('success', 'Event has been successfully deleted');
			Redirect::to(URL .'admin/photographer/view_event.php?id='.Secure::encrypt($userId[0]->user_id));
		}
	}

	public function deleteEventGallery($id) {
		$id = Secure::decrypt($id);
		$eventId = $this->dbRaw("SELECT event_id FROM event_picture WHERE id={$id}");
		$delete = $this->delete($id, 'event_picture');
		if($delete) {
			Session::set('success', 'Event has been successfully deleted');
			Redirect::to(URL .'admin/photographer/view_event_gallery.php?id='. Secure::encrypt($eventId[0]->event_id));
		}
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

	public function createGallery() {
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$userId = Secure::decrypt(Input::get('id'));
			$i = 0;
			$success = false;
			$Image = $this->dbRaw("SELECT id FROM gallery WHERE user_id='{$userId}'");
			if(count($Image) <= 9) {

				if(!empty($_FILES['event_image']['name'])) {
					$upload = [
					'max_size'  => '5242880',
					'location'  => ROOT . 'public_html/image/gallery/',
					'valid_ext' => 'jpg|jpeg|png|gif',
					];
					foreach ($_FILES['event_image']['name'] as $key => $file) {
						$uploadInfo['name'] = $file;
						$uploadInfo['error'] = $_FILES['event_image']['error'][$key];
						$uploadInfo['tmp_name'] = $_FILES['event_image']['tmp_name'][$key];
						$uploadInfo['size'] = $_FILES['event_image']['size'][$key];
						$caption = Input::post('caption')[$key];
						$type = Input::post('type')[$key];
						Upload::initialize($upload);
						$gallery = Upload::doUpload($uploadInfo);
						if($gallery) {
							$data = array(
								'user_id' => $userId,
								'caption' => $caption,
								'photo' => $gallery,
								'type'	  => $type,
								);
							if($this->create($data, 'gallery')) {
								$i++;
								Session::set('success', $i . 'Portfolio Image Added Successfully');
								$success = true;
							}
						}else{
							Session::set('uploadErrors', Upload::getUploadErrors());					
						}
					}
					if($success == true){
						Redirect::to(URL . 'admin/photographer/view_portfolio.php?id='. Input::get('id'));
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



	public function editGallery() {
		$this->_validate->validate($this->rule);
		$id = Secure::decrypt(Input::get('id'));
		$userId = $this->dbRaw("SELECT user_id FROM gallery WHERE id='{$id}'");
		if($this->_validate->isValid()) {
			if(empty($_FILES['event_image']['name'])) {
				$data = array(
					'caption' => Input::post('caption'),
					);
			}else{
				$upload = [
				'max_size'  => '5242880',
				'location'  => ROOT . 'public_html/image/gallery/',
				'valid_ext' => 'jpg|jpeg|png|gif',
				];
				Upload::initialize($upload);
				$gallery = Upload::doUpload($_FILES['event_image']);
				if(!empty($this->getGalleryById()->photo)) {
					Upload::deleteFiles(ROOT . 'public_html/image/gallery/' . $this->getGalleryById()->photo);
				}
				if($gallery) {
					$data = array(
					'caption' => Input::post('caption'),
					'photo' => $gallery,
					'type' => Input::post('type'),
					);
				}else {
					Session::set('uploadErrors', upload::getUploadErrors());	
				}
			}

			if($this->update($data, $id, 'gallery')) {
				Session::set('success', 'Gallery has been updated successfully');
				Redirect::to(URL . 'admin/photographer/view_portfolio.php?id='.Secure::encrypt($userId[0]->user_id));	
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteGallery($id) {
		$id = Secure::decrypt($id);
		$user_id = $this->dbRaw("SELECT user_id FROM gallery WHERE id='{$id}'");
		$delete = $this->delete($id, 'gallery');

		if($delete) {
			Session::set('success', 'Portfolio has been successfully deleted');
			Redirect::to(URL .'admin/photographer/view_portfolio.php?id='.Secure::encrypt($user_id[0]->user_id));
		}
	}

	public function deleteAbout($id) {
		$id = Secure::decrypt($id);
		$delete = $this->delete($id, 'about');

		if($delete) {
			Session::set('success', 'About has been successfully deleted');
			Redirect::to(URL .'admin/photographer/view_photographer.php');
		}
	}
	public function getAllTopTen() {
		$obj = $this->dbRaw('SELECT A.id, A.order_by, A.created_at, B.first_name, B.last_name FROM top_ten A JOIN user_detail B ON (B.id = A.photographer_id)'.' LIMIT' .' '. 5);
		if(count($obj)) {
			return $obj;
		}else {
			return [];
		}
	}
	public function TopTenPhotographer($id) {
		$id = Secure::decrypt($id);
		$this->_validate->validate($this->rule);	
		if($this->_validate->isValid()) {
			$data = [
				'photographer_id' => $id,
				'order_by'		  => Input::post('top'),
			];
			$top = $this->dbRaw("SELECT * FROM top_ten WHERE photographer_id = '{$id}'");
			
			$count = $this->rowCount('top_ten');
			if($count <= 10) {
				if(count($top) == 0) {
					$create = $this->create($data, 'top_ten');
					Session::set('success', 'Successfully added to top 10');
					Redirect::to(URL . 'admin/photographer/view_photographer.php');
				}elseif(count($top) == 1){
					Session::set('warning', 'Already added to top 10');
					Redirect::to(URL . 'admin/photographer/view_photographer.php');
				}
			}else{
				Session::set('warning', 'Cannot assign more than 10 photographer to top 10');
				Redirect::to(URL . 'admin/photographer/view_photographer.php');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function getTopTenById() {
		$id = Secure::decrypt(Input::get('id'));
		$top_ten = $this->dbRaw("SELECT * FROM top_ten where id='{$id}'");
		if(count($top_ten)) {
			return $top_ten[0];
		}else {
			return [];
		}
	}

	public function editTopTenPhotographer() {
		$id = Secure::decrypt(Input::get('id'));
		unset($this->rule['top']['unique']);
		$this->_validate->validate($this->rule);	
		if($this->_validate->isValid()) {
			$data = [
				'order_by' => Input::post('top'),
			];
			$top = $this->dbRaw("SELECT * FROM top_ten WHERE photographer_id = '{$id}'");
			
			$count = $this->rowCount('top_ten');
			if($count <= 10) {
				$create = $this->update($data, $id, 'top_ten');
				Session::set('success', 'Successfully added to top 10');
				Redirect::to(URL . 'admin/photographer/view_photographer.php');
			}else{
				Session::set('warning', 'Cannot assign more than 10 photographer to top 10');
				Redirect::to(URL . 'admin/photographer/view_photographer.php');
			}
		}else{
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteTopTen($id) {
		$id = Secure::decrypt($id);
	
		$delete = $this->delete($id, 'top_ten');

		if($delete) {
			Session::set('success', 'photographer has been removed from top ten list');
			Redirect::to(URL .'admin/photographer/view_photographer.php');
		}
	}

	public function createUserAccount() {
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
			$id = $this->create($data, 'users');
			$slug = strtolower(Input::post('f_name').Input::post('l_name')).'-'.$id;
			$user_info = [
				'first_name'     => Input::post('f_name'),
				'last_name'      => Input::post('l_name'),
				'subcategory_id' => Input::post('sub_cat'),
				'slug' 			 => $slug,
				'user_id' 	     => $id,
				'created_at' 	 => date('Y-m-d H:i:s'),
			];
			$save = $this->create($user_info, 'user_detail');
			if($id && $save) {
				Session::set('success', 'Successfully registered!');
				Redirect::to(URL .'admin/photographer/view_photographer.php');			}
		}else{
        	Session::set('validationErrors',$this->_validate->getErrors());
    	}
	}
}